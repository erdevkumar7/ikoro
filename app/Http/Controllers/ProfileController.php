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
            'biography' => ['nullable', 'max:255'],
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
                $oldImagePath = public_path() . '/' . $host->image;               
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }        
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->move(public_path('uploads/host'), $imageName);
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
