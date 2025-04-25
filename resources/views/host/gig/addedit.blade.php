{{-- @extends('host.layouts.app') --}}

@extends('host.layout.layout')

@section('title', isset($gig['id']) ? 'Edit Gigs' : 'Create Gigs')
@section('content')


<div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('host/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ isset($gig['id']) ? 'Edit Gigs' : 'Create Gigs' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



    <div class="container-fluid" style="margin-bottom: 10px;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>{{ isset($gig['id']) ? 'Edit Gigs' : 'Create Gigs' }}</h4>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <form id="gigForm" method="POST" action="{{ route('host.gig.store') }}">
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="gig_id" value="{{ $gig['id'] ?? '' }}">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="task_id">Type</label>
                            <select class="form-control" id="task_id" name="task_id" required>
                                <option value="" disabled selected>Select type</option>
                                @foreach ($tasks as $row)
                                    <option value="{{ $row->id }}"
                                        {{ ($gig['task_id'] ?? '') == $row->id ? 'selected' : '' }}>
                                        {{ $row->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input type="text" class="form-control" id="title" name="title"
                                :value="$gig['title'] ?? old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="equipment_price_id">Equipment Used</label>
                            <select name="equipment_price_id" id="equipment_price_id" class="form-control">
                                <option value="">Select Equipment Used</option>
                                @foreach ($equipment_price_all as $row)
                                    <option value="{{ $row->id }}" 
                                        price="{{ $row->price }}"
                                        minutes="{{ $row->duration_minutes }}"
                                        equipment_id="{{$row->equipment_id}}"
                                        equipment_name = "{{ $row->equipment->name }}"
                                        {{ ($gig['equipment_price_id'] ?? '') == $row->id ? 'selected' : '' }}>
                                        {{ $row->equipment->name }} 
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('equipment_price_id')" class="mt-2" />
                        </div>






<!-- remove it if you want to uncomment the below one  -->
                        <input type="hidden" id="price" name="price" value="{{ $gig['price'] ?? '' }}" />
                        <input type="hidden" id="minutes" name="minutes" value="{{ $gig['minutes'] ?? '' }}" />
                        <input type="hidden" id="eq_id" name="equipment_id" value="{{ $gig['equipment_id'] ?? '' }}" />
<!-- remove it if you want to uncomment the below one  -->

                        <!--/*
                        <div class="form-group col-md-3">
                            <label for="price">Price Details </label>                           

                            @php
                                $price_str = '';

                                if (
                                    isset($gig->price) &&
                                    isset($gig->minutes)
                                ) {
                                    $price_str = $gig->price . ' per ' . $gig->minutes . ' minutes';
                                }
                            @endphp

                          



                            <input readonly type="text" class="form-control" id="pricing"
                                value="{{ $price_str }}" />
                            <input type="hidden" id="equipment_name" name="equipment_name"
                                value="{{ $gig['equipment_name'] ?? '' }}" />
                            <input type="hidden" id="price" name="price" value="{{ $gig['price'] ?? '' }}" />
                            <input type="hidden" id="minutes" name="minutes" value="{{ $gig['minutes'] ?? '' }}" />
                            <input type="hidden" id="eq_id" name="equipment_id" value="{{ $gig['equipment_id'] ?? '' }}" />
                        </div>
                        */-->





                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control select2">
                                <option value="">Select Country</option>
                                @foreach ($country as $val)
                                    <option value="{{ $val->id }}"
                                        {{ ($gig['country_id'] ?? '') == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control select2">
                                <option value="">Select State</option>
                            </select>
                            <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control select2">
                                <option value="">Select City</option>
                            </select>
                            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="zip_id">ZIP CODE</label>
                            <select name="zip_id" id="zip_id" class="form-control select2">
                                <option value="">Select ZipCode</option>
                            </select>
                            <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                        </div>
                    </div>





                    <div class="form-row">                        
                        <div class="form-group col-md-3">
                            <x-input-label for="price30min" :value="__('Enter Price for 30 Mins :')" />
                            <x-text-input type="number" step="1" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="price30min" name="price30min"
                                :value="$gig['price30min'] ?? old('price30min')" required />
                            <x-input-error :messages="$errors->get('price30min')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                            <x-input-label for="price60min" :value="__('Enter Price for 60 Mins :')" />
                            <x-text-input type="number" step="1" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="price60min" name="price60min"
                                :value="$gig['price60min'] ?? old('price60min')" required />
                            <x-input-error :messages="$errors->get('price60min')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                        <x-input-label for="price90min" :value="__('Enter Price for 90 Mins :')" />
                            <x-text-input type="number" step="1" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="price90min" name="price90min"
                                :value="$gig['price90min'] ?? old('price90min')" required />
                            <x-input-error :messages="$errors->get('price90min')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-3">
                        <x-input-label for="price120min" :value="__('Enter Price for 120 Mins :')" />
                            <x-text-input type="number" step="1" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="price120min" name="price120min"
                                :value="$gig['price120min'] ?? old('price120min')" required />
                            <x-input-error :messages="$errors->get('price120min')" class="mt-2" />
                        </div>
                    </div>







                    <div class="form-row">
                        <div class="form-group col-md">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea name="description" id="description" rows="3" class="form-control">{{ $gig['description'] ?? old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-3" style="margin-left: 90px;">
                        <h4>Features</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="add_more btn btn-sm btn-primary">
                                Add Features
                            </button>
                        </div>
                        <div class="col-md-8">
                            @if (isset($gig['features']))
                                @foreach ($gig['features'] as $feature)
                                    <div class="form-row row">
                                        <div class="form-group col-md-5">
                                            <label>Label</label>
                                            <input type="text" class="form-control" name="features[label][]"
                                                value="{{ $feature['label'] }}" required />
                                            <x-input-error :messages="$errors->get('feat')" class="mt-2" />
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Value</label>
                                            <input type="text" class="form-control" name="features[value][]"
                                                value="{{ $feature['value'] }}" required />
                                            <x-input-error :messages="$errors->get('val')" class="mt-2" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <br />
                                            <button type="button" class="remove btn btn-sm btn-danger"
                                                feature_id="{{ $feature['id'] }}" data-toggle="modal" feature_id="">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div id="html_to">

                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-primary float-right">{{ isset($gig['id']) ? 'Update' : 'Create' }}</button>
                </div>
            </div>
    </form>

    </div>
    </div>
    <script>
        let host = @json($gig ?? []);
        console.log("==========", host.country.name);
        console.log("==========", host.state.name);
        console.log("==========", host.city.name);
        console.log("==========", host.zip.code);
    </script>
@include('host.layout.header_country_state')
@endsection
