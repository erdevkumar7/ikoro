{{--  @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', isset($host) ? 'Edit Hosts' : 'Create Hosts')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/admin/assets/js/get-locations.js') }}"></script>
    {{-- <div class="container-fluid" style="margin-bottom: 10px;">
        <div class="row align-items-center">
            <div class="col-md">
                <h4>{{ isset($host) ? 'Edit Hosts' : 'Create Hosts' }}</h4>
            </div>
        </div>
    </div> --}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($host) ? 'Update Host' : 'Create Host' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset($host) ? 'Update Host' : 'Create Host' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>




        <div class="card">
            <div class="card-body">
                @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <form id="hostForm" method="POST" action="{{ route('admin.host.store') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($host) ? $host->user_id : '' }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input type="text" class="form-control" id="name" name="name"
                                :value="isset($host) ? $host->name : old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sex">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male" {{ isset($host) && $host->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ isset($host) && $host->gender == 'female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-4">
                            <x-input-label for="dob" :value="__('Date of birth')" />
                            <x-text-input type="date" class="form-control" id="dob" name="dob"
                                :value="isset($host) ? $host->dob : old('dob')" required />
                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <x-text-input type="email" class="form-control" id="email" name="email"
                                :value="isset($host) ? $host->user->email : old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <x-text-input type="tel" class="form-control" id="phone" name="phone"
                                :value="isset($host) ? $host->phone : old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control" type="password" name="password"
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control select2">
                                <option value="">Select Country</option>
                                @foreach ($country as $val)
                                    <option value="{{ $val->id }}"
                                        {{ isset($host) && $host->country_id == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control select2">
                                <option value="">Select State</option>
                            </select>
                            <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control select2">
                                <option value="">Select City</option>
                            </select>
                            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zip_id">ZIP CODE</label>
                            <select name="zip_id" id="zip_id" class="form-control select2">
                                <option value="">Select ZipCode</option>
                            </select>
                            <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="task_id">Best Task Offered</label>
                            <select name="task_id[]" class="form-control select2" multiple="multiple">
                                <option value="">Select Tasks</option>
                                @foreach ($tasks as $val)
                                    <option value="{{ $val->id }}"
                                        {{ isset($host) && in_array($val->id, $selectedTask) ? 'selected' : '' }}>
                                        {{ $val->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('task_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="available_hours">Available Hours</label>
                            <x-text-input type="text" class="form-control" id="available_hours"
                                name="available_hours" :value="isset($host) ? $host->available_hours : old('available_hours')" required />
                            <x-input-error :messages="$errors->get('available_hours')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="whatsapp_no">WhatsApp No.</label>
                            <x-text-input type="tel" class="form-control" id="whatsapp_no" name="whatsapp_no"
                                :value="isset($host) ? $host->whatsapp_no : old('whatsapp_no')" />
                            <x-input-error :messages="$errors->get('whatsapp_no')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="skype_id">Skype Id</label>
                            <x-text-input type="text" class="form-control" id="skype_id" name="skype_id"
                                :value="isset($host) ? $host->skype_id : old('skype_id')" />
                            <x-input-error :messages="$errors->get('skype_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank_name">Bank Name</label>
                            <x-text-input type="text" class="form-control" id="bank_name" name="bank_name"
                                :value="isset($host->bank->name) ? $host->bank->name : old('bank_name')" disabled />
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="account_number">Bank Account Number</label>
                            <x-text-input type="text" class="form-control" id="account_number" name="account_number"
                                :value="isset($host->bank->account_number) ? $host->bank->account_number : old('account_number')" disabled />
                            <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="branch_code">Bank Branch Code</label>
                            <x-text-input type="text" class="form-control" id="branch_code" name="branch_code"
                                :value="isset($host->bank->branch_code) ? $host->bank->branch_code : old('branch_code')" disabled />
                            <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="swift_code">Bank Swift Code</label>
                            <x-text-input type="text" class="form-control" id="swift_code" name="swift_code"
                                :value="isset($host->bank->swift_code) ? $host->bank->swift_code : old('swift_code')" disabled />
                            <x-input-error :messages="$errors->get('swift_code')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="enrolement_datetime">Enrolment Briefing Date / Time</label>
                        <x-text-input type="datetime-local" class="form-control" id="enrolement_datetime"
                            name="enrolement_datetime" :value="isset($host) ? $host->enrolement_datetime : old('enrolement_datetime')" required />
                        <x-input-error :messages="$errors->get('enrolement_datetime')" class="mt-2" />
                    </div>
                    <input type="hidden" name="role" value="host">
                    <button type="submit"
                        class="btn btn-primary float-right">{{ isset($host) ? 'Update' : 'Create' }}</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let host = @json($host ?? []);
        console.log("==========", host.country.name);
        console.log("==========", host.state.name);
        console.log("==========", host.city.name);
        console.log("==========", host.zip.code);
    </script>
@endsection
