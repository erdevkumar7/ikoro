<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Gig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\WalletService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index($status="new_order")
    {
        $bookings = Booking::select(
            'bookings.*', 
            'tasks.title AS title', 
            'countries.name AS country_name', 
            'states.name AS state_name', 
            'cities.name AS city_name', 
            'zipcodes.code AS zipcode'
        )
        ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        ->join('countries', 'bookings.country_id', '=', 'countries.id')
        ->join('states', 'bookings.state_id', '=', 'states.id')
        ->join('cities', 'bookings.city_id', '=', 'cities.id')
        ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id')
        ->where('bookings.status', $status)
        ->paginate(config('app.pagination'));
    
        return view(
            'admin.booking.index',
            compact(
                'bookings',
                'status',
            )
        );
    }

    public function newBookingsCnt()
    {
        $cnt = Booking::where('status', 'new_order')->count();
        return response()->json(['new_bookings_cnt' => $cnt]);
    }

    public function hostIndex($status="pending")
    {
        $bookings = Booking::select(
            'bookings.*', 
            'tasks.title AS title', 
            'countries.name AS country_name', 
            'states.name AS state_name', 
            'cities.name AS city_name', 
            'zipcodes.code AS zipcode'
        )
        ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        ->join('countries', 'bookings.country_id', '=', 'countries.id')
        ->join('states', 'bookings.state_id', '=', 'states.id')
        ->join('cities', 'bookings.city_id', '=', 'cities.id')
        ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id')
        // ->whereIn('bookings.status', [$status, 'completed'])
        ->where('bookings.host_id', Auth::user()->id)
        ->paginate(config('app.pagination'));
    
        return view(
            'host.contract.booking',
            compact(
                'bookings',
                'status',
            )
        );
    }

    public function clientIndex($status="new_order")
    {
        $bookings = Booking::select(
            'bookings.*', 
            'tasks.title AS title', 
            'countries.name AS country_name', 
            'states.name AS state_name', 
            'cities.name AS city_name', 
            'zipcodes.code AS zipcode',
        )
        ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        ->join('countries', 'bookings.country_id', '=', 'countries.id')
        ->join('states', 'bookings.state_id', '=', 'states.id')
        ->join('cities', 'bookings.city_id', '=', 'cities.id')
        ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id')
        // ->whereIn('bookings.status', [$status, 'pending', 'completed'])
        ->where('bookings.client_id', Auth::user()->id)
        ->paginate(config('app.pagination'));
    
        return view(
            'user.booking.index',
            compact(
                'bookings',
                'status',
            )
        );
    }

    public function match($booking_id)
    {
        $booking = Booking::select(
            'bookings.*', 
            'clients.name',
            'tasks.title AS title', 
            'countries.name AS country_name', 
            'states.name AS state_name', 
            'cities.name AS city_name', 
            'zipcodes.code AS zipcode'
        )
        ->join('clients', 'bookings.client_id', '=', 'clients.user_id')
        ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        ->join('countries', 'bookings.country_id', '=', 'countries.id')
        ->join('states', 'bookings.state_id', '=', 'states.id')
        ->join('cities', 'bookings.city_id', '=', 'cities.id')
        ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id')
        ->where('bookings.id', $booking_id)
        ->first()->toArray();
    
        $gigs = Gig::with(['host', 'task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])
        ->where('task_id', $booking['task_id'])
        ->where('country_id', $booking['country_id'])
        ->where('state_id', $booking['state_id'])
        ->where('city_id', $booking['city_id'])
        ->whereHas('host', function ($query) use ($booking) {
            $query->where('gender', $booking['preferred_gender']); // Add the condition on the host table
        })
        ->get()->toArray();

        return view(
            'admin.booking.match',
            compact(
                'booking',
                'gigs',
            )
        );
    }

    public function action($booking_id, $host_id="", Request $request)
    {
        $action = $request->input("action");

        try{
            $data = [];

            if($action == "assign"){
                $data = [
                    'host_id' => $host_id, 
                    'status' => 'pending', 
                    'admin_id' => Auth::user()->id
                ];
            }
            if($action == "host_done"){
                $data = [
                    'host_status' => 'done',
                ];
            }
            if($action == "client_done"){
                $data = [
                    'client_status' => 'done',
                ];
            }

            if($action == "admin_done"){
                $data = [
                    'status' => 'completed',
                ];
            }

            Booking::where("id", $booking_id)->update($data);
            
            Session::flash('message', 'Booking Status changed successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

        }
        catch(\Exception $e){
            Session::flash('message', 'Error while assigning to host.'); 
            Session::flash('alert-class', 'alert-warning');

        }
        return redirect()->back();
    }

    public function savePricing(Request $request)
    {
        $data = $request->all();
        $booking = Booking::where('id', $data['booking_id'])->first();
        unset($data['booking_id']);

        try{
            $clientWallet = $booking->client->wallet;
            $hostWallet = $booking->host->wallet;
            $adminWallet = $booking->admin->wallet;

            DB::beginTransaction();
            $this->walletService->debit($clientWallet, $data['client_debit'], 'internal', null, json_encode($booking));
            $this->walletService->credit($hostWallet, $data['host_credit'], 'internal', null, json_encode($booking));
            $this->walletService->credit($adminWallet, $data['admin_credit'], 'internal', null, json_encode($booking));

            $data['status'] = 'completed';
            $booking->update($data);
            DB::commit();

            Session::flash('message', 'Credits transfered saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

        }
        catch(\Exception $e){

            DB::rollBack();
            Session::flash('message', 'Error saving pricing.'. json_encode($e->getMessage())); 
            Session::flash('alert-class', 'alert-warning');
        }

        return redirect()->back();
    }
}
