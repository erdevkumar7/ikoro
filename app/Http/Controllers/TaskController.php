<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $tasks = Task::paginate(config('app.pagination'));

        return view(
            'admin.tasks.index',
            compact(
                'tasks',
            )
        );
    }

    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            unset($data['_token']);
    
            if($id == ""){
                Task::create($data);
            }
            else{
                Task::where("id", $id)->update($data);
            }

            Session::flash('message', 'Task saved successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['success' => 'Task saved successfuly'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while saving task.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while saving task'], 400);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            Task::where("id", $id)->delete();

            Session::flash('message', 'Task deleted successfully.'); 
            Session::flash('alert-class', 'alert-success'); 

            return response()->json(['success' => 'Task deleted successfully'], 200);
        }
        catch(\Exception $e){
            Session::flash('message', 'Error while deleting task.'); 
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while deleting task'], 400);
        }

    }
}
