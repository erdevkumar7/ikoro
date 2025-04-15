@extends('host.layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
                            </p>
                        @endif
                        <h5 class="card-title text-center mt-2">Update Your Profile</h5>
                        <form method="POST" action="{{ route('host.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mt-2">
                                <!-- Name -->
                                <div class="form-group col-md-6">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input type="text" class="form-control" id="name" name="name"
                                        :value="isset($data) ? $data->name : old('name')" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div class="form-group col-md-6">
                                    <label for="sex">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" disabled selected>Select your gender</option>
                                        <option value="male"
                                            {{ isset($data) && $data->gender == 'male' ? 'selected' : old('male') }}>Male
                                        </option>
                                        <option value="female"
                                            {{ isset($data) && $data->gender == 'female' ? 'selected' : old('female') }}>
                                            Female</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Email -->
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <x-text-input type="email" class="form-control" id="email" name="email"
                                        :value="isset($data) ? $data->user->email : old('email')" required readonly />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone -->
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <x-text-input type="tel" class="form-control" id="phone" name="phone"
                                        :value="isset($data) ? $data->phone : old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-row">
                                <!-- Password -->
                                <div class="form-group col-md-6">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group col-md-6">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation" autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>


                            <div class="form-row">

                                <!-- DOB -->
                                <div class="form-group col-md-6">
                                    <label for="dob">Date of birth</label>
                                    <x-text-input type="date" class="form-control" id="dob" name="dob"
                                        :value="isset($data) ? $data->dob : old('dob')" />
                                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                                </div>
                                <!-- Available Hours -->
                                <div class="form-group col-md-6">
                                    <label for="available_hours">Available Hours</label>
                                    <x-text-input type="text" class="form-control" id="available_hours"
                                        name="available_hours" :value="isset($data) ? $data->available_hours : old('available_hours')" required />
                                    <x-input-error :messages="$errors->get('available_hours')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- WhatsApp No. -->
                                <div class="form-group col-md-6">
                                    <label for="whatsapp_no">WhatsApp No.</label>
                                    <x-text-input type="tel" class="form-control" id="whatsapp_no" name="whatsapp_no"
                                        :value="isset($data) ? $data->whatsapp_no : old('whatsapp_no')" />
                                    <x-input-error :messages="$errors->get('whatsapp_no')" class="mt-2" />
                                </div>

                                <!-- Skype Id -->
                                <div class="form-group col-md-6">
                                    <label for="skype_id">Skype Id</label>
                                    <x-text-input type="text" class="form-control" id="skype_id" name="skype_id"
                                        :value="isset($data) ? $data->skype_id : old('skype_id')" />
                                    <x-input-error :messages="$errors->get('skype_id')" class="mt-2" />
                                </div>
                            </div>
                            <!-- image -->
                            <div class="form-group" style="padding-bottom: 30px;">
                                <label for="image">Upload Image</label>
                                <x-text-input type="file" class="form-control" id="image" name="image"
                                    :value="isset($data) ? $data->image : old('image')"  />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                <img src="{{ asset(isset($data) ? $data->image : '') }}" class="img-fluid" width="40"
                                    alt="no-image">
                            </div>

                            <!-- Enrollment Briefing Date/Time -->
                            <div class="form-group" style="padding-bottom: 30px;">
                                <label for="enrolement_datetime">Enrolment Briefing Date / Time</label>
                                <x-text-input type="datetime-local" class="form-control" id="enrolement_datetime"
                                    name="enrolement_datetime" :value="isset($data) ? $data->enrolement_datetime : old('enrolement_datetime')" required />
                                <x-input-error :messages="$errors->get('enrolement_datetime')" class="mt-2" />
                            </div>

                            <div class="form-group" style="padding-bottom: 30px;">
                                <label for="biography">Biography</label>
                                <textarea name="biography" id="biography" rows="3" class="form-control" required>{{ isset($data) ? $data->biography : old('biography') }}</textarea>
                                <x-input-error :messages="$errors->get('biography')" class="mt-2" />
                            </div>


                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
