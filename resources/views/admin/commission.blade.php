{{--    @extends('admin.layouts.app')   --}}
@extends('admin.layout.layout')
@section('title', 'Dashboard')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Commission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Commission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ $commission ? route('admin.updateCommission', $commission->id) : route('admin.storeCommission') }}"
            method="POST">
            @csrf
            @if ($commission)
                @method('PUT')
            @endif
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="commission_id" value="{{ $commission->id ?? '' }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                 <x-input-label for="percentage" :value="__('Percentage (%)')" />
                                <x-text-input type="text" class="form-control" id="percentage" name="percentage"
                                    :value="$commission->percentage ?? old('percentage')" required />
                                <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
                            </div>


                            {{-- <div class="form-group col-md-6">
                                <x-text-input type="text" class="form-control" id="account_number" name="account_number"
                                    :value="$bank->bank->account_number ?? old('account_number')" required />
                                <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                            </div> --}}
                        </div>


                    </div>
                    <div class="card-footer add-edit-content">
                        <button type="submit"
                            class="btn btn-primary float-right">{{ isset($commission->id) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
        </form>
    </div>
    </div>



@endsection
