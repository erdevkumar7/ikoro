{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', 'Payments')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaction View Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transaction View Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 ">
                            <h4>ID</h4>
                            <p>#{{ $payment->id }}</p>
                        </div>

                        <div class="col-sm-3 ">
                            <h4>User Name</h4>
                            <p>{{ $payment->userDetails->name }}</p>
                        </div>

                         <div class="col-sm-3 ">
                            <h4>Tnx ID</h4>
                            <p>{{ $payment->payment_intent_id }}</p>
                        </div>

                        <div class="col-sm-3 ">
                            <h4>Payment Method</h4>
                            <p>{{ $payment->payment_type }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-3 ">
                            <h4>Booking ID</h4>
                            <p>#{{ $payment->booking->id }}</p>
                        </div>

                        <div class="col-sm-3 ">
                            <h4>Tnx Amount</h4>
                            <p>USD ({{ $payment->amount }})</p>
                        </div>

                        <div class="col-sm-3 ">
                            <h4>Tnx Status</h4>
                            <p>{{ $payment->status }}</p>
                        </div>


                         <div class="col-sm-3 ">
                            <h4>Tnx Date</h4>
                            <p>{{ $payment->created_at }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
