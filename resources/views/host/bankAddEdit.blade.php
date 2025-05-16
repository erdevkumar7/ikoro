@extends('host.layout.layout')

@section('title', isset($bank['id']) ? 'Edit Bank' : 'Create Bank')
@section('content')


    <style>
        .add-edit-content .add_more {
            width: 85%;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            font-weight: bold;
        }

        button.btn.btn-primary.float-right {
            width: 13%;
            border-radius: 5px;
        }

        button.remove_gig_media_offer.btn.btn-sm.btn-danger {
            width: 40%;
            padding: 8px;
            border-radius: 5px;
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease;
            margin-top: -27px;
        }

        button.remove.btn.btn-sm.btn-danger {
            width: 40%;
            padding: 8px;
            border-radius: 5px;
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease;
            margin-top: -27px;
        }

        button.remove_gig_media_offer.btn.btn-sm.btn-danger:hover {
            background-color: #ff1c32;
        }

        .add-edit-content h4.features-text {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .add-edit-content .remove:hover {
            background-color: #c82333;
        }

        .add-edit-content .form-control {
            border-radius: 6px;
            font-size: 14px;
            height: 41px;
        }

        .add-edit-content label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 5px;
        }

        aside.main-sidebar.sidebar-dark-primary.elevation-4 img.brand-image.img-circle.elevation-3 {
            float: left;
            line-height: .8;
            margin-left: .8rem;
            margin-right: .5rem;
            margin-top: -3px;
            width: 40px !important;
            max-height: 40px !important;
            height: 40px !important;
            object-fit: cover !important;
        }

        .add-edit-content .mt-2 img {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 4px;
            background: #fff;
            width: 65%;
            height: 135px;
            object-fit: cover;
        }

        .add-edit-content .form-row {
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #f9f9f9;
            width: 100%;
            padding-bottom: 10px;
        }

        .add-edit-content .form-group.col-md-2.remove-add-btn {
            margin-top: 24px;
        }

        .add-edit-content .features-show-img {
            padding-bottom: 25px;
        }

        .add-edit-content button.remove.btn.btn-sm.btn-danger {
            margin-top: 0;
        }

        div#html_to button.remove.btn.btn-sm.btn-danger {
            margin-top: -3px;
        }

        p.alert.alert-success {
            text-align: center;
            width: 1080px;
            margin: auto;
            margin-bottom: 15px;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($bank->bank->id) ? 'Update Bank' : 'Add Bank' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('host/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset($bank->bank->id) ? 'Update Bank' : 'Add Bank' }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="container" style="margin-bottom: 10px;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Heading on the left -->
                    {{-- <div class="col-md">
                        <h4>{{ isset($bank['id']) ? 'Edit Bank' : 'Add Bank' }}</h4>
                    </div> --}}
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <form id="gigForm" method="POST" action="{{ route('host.save.bank') }}">
            @csrf
             <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="bank_id" value="{{ $bank->bank->id ?? '' }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <x-input-label for="name" :value="__('Bank Name')" />
                                <x-text-input type="text" class="form-control" id="name" name="name"
                                :value="$bank->bank->name ?? old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>


                            <div class="form-group col-md-6">
                                <x-input-label for="account_number" :value="__('Account Number')" />
                                <x-text-input type="text" class="form-control" id="account_number" name="account_number"
                                    :value="$bank->bank->account_number ?? old('account_number')" required />
                                <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <x-input-label for="branch_code" :value="__('Branch Code')" />
                                <x-text-input type="text" class="form-control" id="branch_code" name="branch_code"
                                    :value="$bank->bank->branch_code ?? old('branch_code')" required />
                                <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                            </div>


                            <div class="form-group col-md-6">
                                <x-input-label for="swift_code" :value="__('Swift Code')" />
                                <x-text-input type="text" class="form-control" id="swift_code" name="swift_code"
                                    :value="$bank->bank->swift_code ?? old('swift_code')" required />
                                <x-input-error :messages="$errors->get('swift_code')" class="mt-2" />
                            </div>
                        </div>


                    </div>
                    <div class="card-footer add-edit-content">
                        <button type="submit"
                            class="btn btn-primary float-right">{{ isset($bank->bank->id) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
        </form>
    </div>
    </div>

@endsection
