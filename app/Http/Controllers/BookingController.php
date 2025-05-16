<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Commission;
use App\Models\Gig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\WalletService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;


class BookingController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index($status = null)
    {
        // $query = Booking::select(
        //     'bookings.*',
        //     'tasks.title AS title',
        //     'countries.name AS country_name',
        //     'states.name AS state_name',
        //     'cities.name AS city_name',
        //     'zipcodes.code AS zipcode'
        // )
        //     ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        //     ->join('countries', 'bookings.country_id', '=', 'countries.id')
        //     ->join('states', 'bookings.state_id', '=', 'states.id')
        //     ->join('cities', 'bookings.city_id', '=', 'cities.id')
        //     ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id');

        $query = Booking::with(['client', 'clientDetails', 'host', 'gig', 'feature', 'payment'])
            ->orderBy('created_at', 'desc');

        // Apply status filter if provided and not 'all-booking'
        if ($status && $status !== 'all-booking') {
            $query->where('status', $status); // No need to prefix 'bookings.' here when using Eloquent
        }

        $bookings = $query->get();

        return view('admin.booking.index', compact('bookings', 'status'));
    }




    public function getMatchingBookings(Request $request)
    {
        $date = $request->input('date'); // e.g. '2025-04-30'
        //$gig_id = $request->input('gig_id');
        $bookings = DB::table('bookings')
            ->where('operation_time', 'like', $date . 'T%')
            //->where('gig_id', $gig_id)
            ->get();



        return response()->json($bookings);
    }


    public function newBookingsCnt()
    {
        $cnt = Booking::where('status', 'new_order')->count();
        return response()->json(['new_bookings_cnt' => $cnt]);
    }

    public function hostIndex()
    {
        $bookings = Booking::with(['client', 'clientDetails', 'host', 'hostDetails', 'gig', 'feature', 'payment'])
            ->where('host_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('host.contract.booking', compact('bookings'));
    }

    public function clientIndex($status = "new_order")
    {
        // $bookings = Booking::select(
        //     'bookings.*',
        //     'tasks.title AS title',
        //     'countries.name AS country_name',
        //     'states.name AS state_name',
        //     'cities.name AS city_name',
        //     'zipcodes.code AS zipcode',
        // )
        //     ->join('tasks', 'bookings.task_id', '=', 'tasks.id')
        //     ->join('countries', 'bookings.country_id', '=', 'countries.id')
        //     ->join('states', 'bookings.state_id', '=', 'states.id')
        //     ->join('cities', 'bookings.city_id', '=', 'cities.id')
        //     ->join('zipcodes', 'bookings.zip_id', '=', 'zipcodes.id')
        //     // ->whereIn('bookings.status', [$status, 'pending', 'completed'])
        //     ->where('bookings.client_id', Auth::user()->id)
        //     ->paginate(config('app.pagination'));

        $query = Booking::with(['client', 'clientDetails', 'host', 'hostDetails', 'gig', 'feature', 'payment']);
        $query->where('client_id', Auth::user()->id);
        $bookings = $query->get();

        return view('user.booking.index', compact('bookings', 'status',));
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

    public function action($booking_id, $host_id = "", Request $request)
    {
        $action = $request->input("action");

        try {
            $data = [];

            if ($action == "assign") {
                $data = [
                    'host_id' => $host_id,
                    'status' => 'pending',
                    'admin_id' => Auth::user()->id
                ];
            }
            if ($action == "host_done") {
                $data = [
                    'host_status' => 'done',
                ];
            }
            if ($action == "client_done") {
                $data = [
                    'client_status' => 'done',
                ];
            }

            if ($action == "admin_done") {
                $data = [
                    'status' => 'completed',
                ];
            }

            if ($action == "host_accepted") {
                $data = [
                    'is_accepted' => 'accepted',
                ];
            }

            if ($action == "host_rejected") {
                $data = [
                    'is_accepted' => 'rejected',
                ];
            }

            Booking::where("id", $booking_id)->update($data);

            Session::flash('message', 'Booking Status changed successfuly.');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            Session::flash('message', 'Error while assigning to host.');
            Session::flash('alert-class', 'alert-warning');
        }
        return redirect()->back();
    }

    public function doingHostbookingPayment($booking_id, Request $request)
    {
        try {
            $data = [];
            $data = ['payment_status' => 1,];

            Booking::where("id", $booking_id)->update($data);

            Session::flash('message', 'Payment released successfuly.');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
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

        try {
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
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('message', 'Error saving pricing.' . json_encode($e->getMessage()));
            Session::flash('alert-class', 'alert-warning');
        }

        return redirect()->back();
    }

    public function storeBookingData(Request $request)
    {
        session([
            'booking.gig_id' => $request->gig_id,
            'booking.price' => $request->price,
            'booking.duration' => $request->duration,
            'booking.operation_time' => $request->operation_time,
            'booking.feature_ids' => $request->feature_ids,
            'booking.feedback_tool' => $request->feedback_tool,
            'booking.feedback_tool_value' => $request->feedback_tool_value,
            'booking.host_notes' => $request->host_notes,
        ]);

        return response()->json(['status' => 'success']);
    }

    public function bookingDetailByBookingId(Request $request, $booking_id)
    {
        $clientId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : ''; // cleaner way
        $data = [
            'loggedIn' => $clientId ?? '',
        ];
        $data['booking'] = Booking::with('payment')->where(['id' => $booking_id, 'client_id' => $clientId])->first();
        return view('user.booking.booking-detail', $data);
    }

    public function hostBookingDetailByBookingId(Request $request, $booking_id)
    {
        $hostId = (Auth::check() && Auth::user()->role === 'host') ? Auth::id() : ''; // cleaner way

        $data['booking'] = Booking::with('payment')->where(['id' => $booking_id, 'host_id' => $hostId])->first();
        $data['commission'] = Commission::first();
        return view('host.booking-detail', $data);
    }


    public function adminBookingDetailByBookingId($booking_id)
    {
        $adminId = (Auth::check() && Auth::user()->role === 'admin') ? Auth::id() : '';
        $data['booking'] = Booking::with('clientDetails', 'hostDetails', 'payment')->where(['id' => $booking_id])->first();
        $data['commission'] = Commission::first();

        return view('admin.booking.booking-detail', $data);
    }

    public function downloadInvoice($booking_id)
    {
        $booking = Booking::with(['payment', 'gig.task'])->findOrFail($booking_id);
        // Optional: check if user is authorized
        // if (Auth::id() !== $booking->client_id) {
        //     abort(403);
        // }

        $pdf = Pdf::loadView('user.booking-invoice', compact('booking'));
        return $pdf->download('invoice-booking-' . $booking->id . '.pdf');
    }

    public function hostDownloadInvoice($booking_id)
    {
        $booking = Booking::with(['payment', 'gig.task'])->findOrFail($booking_id);
        $commission = Commission::first();
        $pdf = Pdf::loadView('host.booking-invoice', compact('booking', 'commission'));
        return $pdf->download('invoice-booking-' . $booking->id . '.pdf');
    }

    public function adminDownloadInvoice($booking_id)
    {
        $booking = Booking::with(['payment', 'gig.task'])->findOrFail($booking_id);
        $commission = Commission::first();
        $pdf = Pdf::loadView('admin.booking.booking-invoice', compact('booking', 'commission'));
        return $pdf->download('invoice-booking-' . $booking->id . '.pdf');
    }
}
