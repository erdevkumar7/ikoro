<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = Client::orderBy('id', 'desc')->get();
        return view('admin.users.index', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            Client::where("user_id", $id)->delete();
            User::where("id", $id)->delete();

            Session::flash('message', 'User deleted successfully.');
            Session::flash('alert-class', 'alert-success');

            return response()->json(['success' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            Session::flash('message', 'Error while deleting host.');
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while deleting host'], 400);
        }
    }
}
