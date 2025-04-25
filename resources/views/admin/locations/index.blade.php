{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout') 
@section('title', 'Tasks')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/manage-locations.css') }}">
    @endpush


    <div class="content-wrapper">



<!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        </div>
    </div>
    </div>



    <div class="container-fluid text-center mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row location-block">
                    <div class="col-sm-3 ">
                        <p class="manage-locations-paragraph">Countries</p>
                        <div class="input-group rounded manage-locations-searchbox">
                            <input type="search" id="country-text" store="{{ route('admin.location.storeCountry') }}"
                                class="form-control rounded" placeholder="Country Name" aria-label="Search"
                                aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="add_country">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                        <select class="form-select datarecord" get_states_action="{{ route('admin.location.getstates') }}"
                            id="country-select" size="10" aria-label="select">
                            <option value="" selected>Select Country</option>
                            @foreach ($countries as $row)
                                <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <p class="manage-locations-paragraph">State</p>
                        <div class="input-group rounded manage-locations-searchbox">
                            <input type="search" id="state-text" store="{{ route('admin.location.storeState') }}"
                                class="form-control rounded" placeholder="State Name" aria-label="Search"
                                aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="add_state">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                        <select class="form-select datarecord" get_city_action="{{ route('admin.location.getcities') }}"
                            id="state-select" size="10" aria-label="select">
                            <option selected>Select State</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <p class="manage-locations-paragraph">City</p>
                        <div class="input-group rounded manage-locations-searchbox">
                            <input type="search" id="city-text" store="{{ route('admin.location.storeCity') }}"
                                class="form-control rounded" placeholder="City Name" aria-label="Search"
                                aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="add_city">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                        <select class="form-select datarecord" get_zipcodes_action="{{ route('admin.location.getzipcodes') }}"
                            id="city-select" size="10" aria-label="select">
                            <option selected>Select City</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <p class="manage-locations-paragraph">ZipCode</p>
                        <div class="input-group rounded manage-locations-searchbox">
                            <input type="search" id="zipcode-text" store="{{ route('admin.location.storeZipCode') }}"
                                class="form-control rounded" placeholder="Zipcode" aria-label="Search"
                                aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="add_zipcode">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                        <select class="form-select datarecord" id="zipcode-select" size="10" aria-label="select">
                            <option selected>Open this select menu</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/admin/assets/js/locations.js') }}"></script>
@endpush
