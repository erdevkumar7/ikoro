<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function host_profile()
    {
        $data['data'] = Host::where("user_id", Auth::id())->first();
        return view('host.profile', $data);
    }

    public function host_profile_update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class . ',email,' . Auth::id()],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'gender' => ['nullable', 'string'],
            'dob' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:15'],
            'whatsapp_no' => ['nullable', 'string', 'max:15'],
            'available_hours' => ['nullable', 'integer'],
            'skype_id' => ['nullable', 'string', 'max:255'],
            'enrolement_datetime' => ['nullable', 'date'],
            // 'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'image' => ['nullable', 'max:2048'],
            'biography' => ['nullable','min:50', 'max:255'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        User::where('id', Auth::id())->update($data);
        $user = User::where('id', Auth::id())->first();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $host = Host::where("user_id", Auth::id())->first();            
            if ($host->image) {
                  // $oldImagePath = '/' . $host->image;  
                  $oldImagePath = 'public' . '/' . $host->image;               
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }        
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->move('public/uploads/host', $imageName);
            // $imagePath = $image->move(public_path('uploads/host'), $imageName);
            $imagePath = 'uploads/host/' . $imageName;
        }

        $hostUpdateData = [
            'name' => $user->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'whatsapp_no' => $request->whatsapp_no,
            'available_hours' => $request->available_hours,
            'skype_id' => $request->skype_id,

            'mon_is_open' => $request->mon_is_open,

            'mon_open_time' =>  isset($request->mon_open_time) && $request->mon_open_time !== null ? $request->mon_open_time : '',
            'mon_close_time' => isset($request->mon_close_time) && $request->mon_close_time !== null ? $request->mon_close_time : '',

            'mon_check' => $request->mon_check,

            'tue_is_open' => $request->tue_is_open,
            
            'tue_open_time' => isset($request->tue_open_time) && $request->tue_open_time !== null ? $request->tue_open_time : '',
            'tue_close_time' => isset($request->tue_close_time) && $request->tue_close_time !== null ? $request->tue_close_time : '',

            'tue_check' => $request->tue_check,

            'wed_is_open' => $request->wed_is_open,
            'wed_open_time' => isset($request->wed_open_time) && $request->wed_open_time !== null ? $request->wed_open_time : '',
            'wed_close_time' => isset($request->wed_close_time) && $request->wed_close_time !== null ? $request->wed_close_time : '',

            'wed_check' => $request->wed_check,

            'thu_is_open' => $request->thu_is_open,
            'thu_open_time' => isset($request->thu_open_time) && $request->thu_open_time !== null ? $request->thu_open_time : '',
            'thu_close_time' => isset($request->thu_close_time) && $request->thu_close_time !== null ? $request->thu_close_time : '',

            'thu_check' => $request->thu_check,

            'fri_is_open' => $request->fri_is_open,
            'fri_open_time' => isset($request->fri_open_time) && $request->fri_open_time !== null ? $request->fri_open_time : '',
            'fri_close_time' => isset($request->fri_close_time) && $request->fri_close_time !== null ? $request->fri_close_time : '',

            'fri_check' => $request->fri_check,

            'sat_is_open' => $request->sat_is_open,
            'sat_open_time' => isset($request->sat_open_time) && $request->sat_open_time !== null ? $request->sat_open_time : '',
            'sat_close_time' => isset($request->sat_close_time) && $request->sat_close_time !== null ? $request->sat_close_time : '',

            'sat_check' => $request->sat_check,

            'sun_is_open' => $request->sun_is_open,
            'sun_open_time' => isset($request->sun_open_time) && $request->sun_open_time !== null ? $request->sun_open_time : '',
            'sun_close_time' => isset($request->sun_close_time) && $request->sun_close_time !== null ? $request->sun_close_time : '',
            'sun_check' => $request->sun_check,

            'enrolement_datetime' => $request->enrolement_datetime,
            'biography' => $request->biography,
        ];

        if ($imagePath !== null) {
            $hostUpdateData['image'] = $imagePath;
        }

        Host::where('user_id', $user->id)->update($hostUpdateData);

        return redirect()->route('host.profile')->with('message', 'Your Profile Updated Successfully');
    }
}
