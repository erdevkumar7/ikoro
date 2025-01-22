<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zipcode;

use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $countries = Country::select('id', 'name')->get()->toArray();
        return view(
            'admin.locations.index',
            compact(
                'countries',
            )
        );
    }

    public function getStates(Request $request)
    {
        $country_id = $request->input("country_id");
        
        $states = State::select()->where('country_id', $country_id)->get()->toArray();

        return response()->json($states, 200);
    }

    public function getCities(Request $request)
    {
        $state_id = $request->input("state_id");

        $cities = City::select()->where('state_id', $state_id)->get()->toArray();

        return response()->json($cities, 200);
    }
    
    public function getZipCodes(Request $request)
    {
        $city_id = $request->input("city_id");

        $zipcodes = Zipcode::select()->where('city_id', $city_id)->get()->toArray();

        return response()->json($zipcodes, 200);
    }
    
    public function storeCountry(Request $request)
    {
        try{
            $name = ucfirst($request->input('country') ?? "");

            $country = Country::where(["name" => $name])->first();
            if(!isset($row->id)){
                $country = Country::create(['name' => $name]);
            }

            Session::flash('message', 'Country saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['country' => $country, 'success' => 'Country saved successfuly'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while saving country.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while saving country'], 400);
        } 
    }

    public function storeState(Request $request)
    {
        try{
            $data = $request->all();
            
            $state_data = [
                "country_id" => $data['country_id'],
                "name" => ucfirst($data['state']),
            ];

            $state = State::where($state_data)->first();
    
            if(!isset($state->id)){
                $state = State::create($state_data);
            }

            Session::flash('message', 'State saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['state' => $state, 'success' => 'State saved successfuly'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while saving state.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while saving state'], 400);
        } 
    }

    public function storeCity(Request $request)
    {
        try{
            $data = $request->all();
            
            $state_data = [
                "country_id" => $data['country_id'],
                "state_id" => $data['state_id'],
                "name" => ucfirst($data['city']),
            ];

            $city = City::where($state_data)->first();
    
            if(!isset($city->id)){
                $city = City::create($state_data);
            }
            Session::flash('message', 'City saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['city' => $city, 'success' => 'City saved successfuly'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while saving city.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while saving city'], 400);
        } 
    }

    public function storeZipCode(Request $request)
    {
        try{
            $data = $request->all();
            
            $data = [
                "country_id" => $data['country_id'],
                "state_id" => $data['state_id'],
                "city_id" => $data['city_id'],
                "code" => $data['zipcode'],
            ];

            $zipcode = Zipcode::where($data)->first();
    
            if(!isset($zipcode->id)){
                $zipcode = Zipcode::create($data);
            }

            Session::flash('message', 'Location saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['zipcode' => $zipcode, 'success' => 'Location saved successfuly'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while saving location.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while saving location'], 400);
        } 
    }

    public function destroy(Request $request)
    {
        try{
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            Location::where("id", $id)->delete();

            Session::flash('message', 'Location deleted successfully.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['success' => 'Location deleted successfully'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while deleting location.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while deleting location'], 400);
        }

    }
}
