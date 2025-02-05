<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Zipcode;
use App\Models\Task;
use App\Models\Country;
use App\Models\Booking;
use App\Models\Equipment;
use App\Models\EquipmentPrice;
use App\Models\Gig;
use App\Models\Host;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Facades\Paystack;

class HomeController extends Controller
{
    private function prepareData(Request $request)
    {
        $client = Auth::user()->id ?? "";
        $data = [
            'loggedIn' => "",
            'tasks' => [],
            'countries' => Country::all(),
            'user' => []
        ];

        if ($client != "") {
            $data['loggedIn'] = $client;
            $data['tasks'] = Task::all();
            $data['user'] = Auth::user();
        }

        $data['equipment_price_all'] = Equipment::get();
        $data['country'] = Country::where('name', 'Nigeria')->first();
        $data['state'] = State::where('name', 'Nigeria')->first();
        $data['cities'] = City::all();
        $data['gigs'] = collect([]);
        return $data;
    }

    public function getEquipmentPrices(Request $request)
    {
        $equipment_id = $request->input('equipment_id');
        $equipment_prices = EquipmentPrice::where('equipment_id', $equipment_id)->get();

        return response()->json($equipment_prices);
    }

    public function index(Request $request)
    {
        $data = $this->prepareData($request);
        $data['hosts'] = Host::with('gigs')->where('recommended_sequence', '>', 0)->get();
        $data['host_profile'] = Host::with('gigs')->where('recommended_sequence', '=', 2)->first();
        $data['tasks'] = Task::all();
        return view('home', $data);
    }

    public function searchCity(Request $request)
    {
        $query = $request->input('query');
        $cities = City::where('name', 'LIKE', "%{$query}%")->limit(10)->get();
        return response()->json($cities);
    }

    public function filterGigs(Request $request)
    {
        $where = [];

        if ($request->filled('city_id')) {
            $where['city_id'] = $request->input('city_id');
        }
        if ($request->filled('task_id')) {
            $where['task_id'] = $request->input('task_id');
        }
        if ($request->filled('equipment_id')) {
            $where['equipment_id'] = $request->input('equipment_id');
        }

        $gigs = Gig::where($where);
        if ($request->filled('gender')) {
            $gender = $request->input('gender');
            $gigs->whereHas('host', function ($query) use ($gender) {
                $query->where('gender', $gender);
            });
        }

        $gigs = $gigs->get();
        if ($gigs->isEmpty()) {
            return response()->json([
                'html' => '<span class="text-white"><b>No host found for the selected fields!</b></span>'
            ]);
        }
        $html = view('partials.gigs-list', compact('gigs'))->render();
        return response()->json(['html' => $html]);
    }

    public function getSelectedHost(Request $request)
    {
        $host_id = $request->input('host_id');
        $host_profile = Host::with('gigs')->where('id', $host_id)->first();  
        
        if (!$host_profile) {
            return response()->json(['error' => 'Host not found'], 404);
        }      
        $html = view('partials.selected-host', compact('host_profile'))->render();    
        return response()->json(['html' => $html]);
    }

    public function hostProfileById($host_id)
    {
        $data['host_profile']  = Host::with('gigs')->findOrFail($host_id);
        return view('pages.host-profile', $data);
    }


    public function gigSearchedOnTask(Request $request)
    {
        $data = [];
        if ($request->input('data') != '') {
            $id = $request->input('data');
            $data = Gig::where('task_id', $id)->inRandomOrder()->get();
        }
        if ($request->ajax()) {
            $html = view('pages.gig-search-task', compact('data'))->render();
            return response()->json([
                'status' => 'success',
                'data' => $html,
            ]);
        }
    }


    public function homeDashboard(Request $request)
    {
        $data = $this->prepareData($request);
        return view('pages.dashboard', $data);
    }

    public function storeBooking(Request $request)
    {
        try {
            $data = $request->all();
            $action = $request->input('action');
            $id = $data['action'] ?? "";
            unset($data['action']);
            unset($data['id']);
            unset($data['_token']);
            $data['client_id'] = Auth::user()->id;

            if ($id == "") {
                Booking::create($data);
            }
            if ($action == 'pay') {
                return $this->redirectToGateway($data["total_cost"]);
                exit;
            }

            Session::flash('message', 'Booking saved successfuly, please wait for admin to assign to host');
            Session::flash('alert-class', 'alert-success');

            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('message', 'Error while saving booking.' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');

            return redirect()->back();
        }
    }

    public function redirectToGateway($total_cost)
    {
        $data = array(
            "amount" => $total_cost * 100,
            "id" => Auth::user()->id,
            "email" => Auth::user()->email,
            "currency" => "ZAR",
            "callback_url" => route('callback'),
        );

        try {
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        } catch (\Exception $e) {
            Session::flash('message', 'The paystack token has expired. Please refresh the page and try again.' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }

    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }

    public function getZips($cityId)
    {
        $zips = Zipcode::where('city_id', $cityId)->get();
        return response()->json($zips);
    }
}
