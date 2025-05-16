<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Host;
use App\Models\HostTask;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HostController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $data['hosts'] = Host::where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.hosts.index', $data);
    }

    public function approved()
    {
        $data['hosts'] = Host::with(['user'])->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.hosts.approved', $data);
    }

    public function blocked()
    {
        $data['hosts'] = Host::where('status', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.hosts.blocked', $data);
    }

    public function add()
    {
        $data['country'] = DB::table('countries')->get();
        $data['tasks'] = Task::all();

        return view('admin.hosts.add', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],  // Password can be nullable for update case
            'gender' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'whatsapp_no' => ['nullable', 'string'],
            'available_hours' => ['nullable', 'integer'],
            'skype_id' => ['nullable', 'string', 'max:255'],
            'enrolement_datetime' => ['nullable', 'date'],
            'dob' => ['nullable', 'date'],
            'country_id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'zip_id' => ['nullable', 'integer'],
            'task_id.*' => ['integer'],
        ]);

        try {
            $id = $request->id;

            if (isset($id) && !empty($id)) {
                // Update logic
                $user = User::find($id);
                if (!$user) {
                    throw new \Exception('User not found.');
                }

                // Update user data
                $user->name = $request->name;
                $user->email = $request->email;

                // If password is provided, update it
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->role = $request->role ?? $user->role;
                $user->save();

                // Update Host data
                $host = Host::where('user_id', $user->id)->firstOrFail();
                $host->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'phone' => $request->phone,
                    'whatsapp_no' => $request->whatsapp_no,
                    'available_hours' => $request->available_hours,
                    'skype_id' => $request->skype_id,
                    'enrolement_datetime' => $request->enrolement_datetime,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'zip_id' => $request->zip_id,
                ]);

                // Sync tasks for the host
                HostTask::where('host_id', $host->id)->delete();  // Clear old tasks
                foreach ($request->task_id as $task) {
                    HostTask::create([
                        'host_id' => $host->id,
                        'task_id' => $task
                    ]);
                }

                Session::flash('message', 'Host updated successfully.');
            } else {
                // Create new user and host
                $role = $request->role ?? 'user';

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $role,
                ]);

                $host = Host::create([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'phone' => $request->phone,
                    'whatsapp_no' => $request->whatsapp_no,
                    'available_hours' => $request->available_hours,
                    'skype_id' => $request->skype_id,
                    'enrolement_datetime' => $request->enrolement_datetime,
                    'user_id' => $user->id,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'zip_id' => $request->zip_id,
                ]);

                foreach ($request->task_id as $task) {
                    HostTask::create([
                        'host_id' => $host->id,
                        'task_id' => $task
                    ]);
                }

                Session::flash('message', 'Host saved successfully.');
            }

            Session::flash('alert-class', 'alert-success');
            return redirect()->route('admin.host');
        } catch (\Exception $e) {
            Session::flash('message', 'Error while saving/updating host: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->route('admin.host.add');
        }
    }


    public function edit($host)
    {
        $data['host'] = Host::with(['country', 'state', 'city', 'zip','bank'])->findOrFail($host);  
        $data['country'] = DB::table('countries')->get();
        $data['tasks'] = Task::all();
        $data['selectedTask'] = HostTask::where('host_id', $host)
            ->pluck('task_id')
            ->toArray();

        return view('admin.hosts.add', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            Host::where("user_id", $id)->delete();
            User::where("id", $id)->delete();

            Session::flash('message', 'Host deleted successfully.');
            Session::flash('alert-class', 'alert-success');

            return response()->json(['success' => 'Host deleted successfully'], 200);
        } catch (Exception $e) {
            Session::flash('message', 'Error while deleting host.');
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while deleting host'], 400);
        }
    }

    public function status(Request $request, Host $host)
    {
        $status = $request->query('status');

        if (in_array($status, [0, 1, 2])) {
            $host->update(['status' => $status]);
        } else {
            return response()->json(['error' => 'Invalid status value'], 400);
        }
        Session::flash('message', 'Host status updated successfully');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'Host status updated successfully'], 200);
    }

    public function setRecommendedSequence(Request $request, $host_id)
    {
        $newSequence = $request->input('seq');
        try{
            Host::where('id', $host_id)->update(['recommended_sequence' => $newSequence]);            
            Session::flash('message', 'Recommended Host sequence updated successfully');
            Session::flash('alert-class', 'alert-success');
        } catch (Exception $e) {
            Session::flash('message', 'Error while updating recommended host sequence.');
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while updating recommended host sequence'], 400);
        }
        return response()->json(['success' => 'Recommended Host sequence updated successfully'], 200);

    }
}

