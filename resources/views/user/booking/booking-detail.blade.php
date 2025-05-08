@extends('user.layout-new.app')
@section('title', 'Booking-detail')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Booking-detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Booking-detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (Session::has('payment_success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "{{ Session::get('payment_success') }}",
                        icon: "success",
                        draggable: true
                    });
                });
            </script>
        @endif
        @if (Session::has('payment_fail'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
            </script>
        @endif

        @if ($booking)
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">Booking Information</div>
                    <div class="card-body">
                        {{-- <p><strong>Booking ID:</strong> {{ $booking->id }}</p> --}}
                        <p><strong>Booking Task:</strong> {{ $booking->gig->task->title ?? 'N/A' }}</p>
                        <p><strong>Tool:</strong> {{ $booking->equipment_name ?? 'N/A' }}</p>
                        <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                        <p><strong>Operation Time:</strong> {{ $booking->operation_time }}</p>
                        {{-- <p><strong>Preferred Gender:</strong> {{ $booking->preferred_gender }}</p> --}}
                        <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
                        <p><strong>Host Notes:</strong> {{ $booking->host_notes ?? 'N/A' }}</p>
                        <p><strong>Feedback Tool:</strong> {{ $booking->feedback_tool ?? 'N/A' }}</p>
                        <p><strong>Feedback Tool Value:</strong> {{ $booking->feedback_tool_value ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            @if ($booking->payment)
                <div class="container">
                    <div class="card">
                        <div class="card-header">Payment Information</div>
                        <div class="card-body">
                            {{-- <p><strong>Payment ID:</strong> {{ $booking->payment->id }}</p> --}}
                            <p><strong>Transaction ID:</strong> {{ $booking->payment->payment_intent_id }}</p>
                            <p><strong>Amount Paid:</strong> ${{ number_format($booking->payment->amount, 2) }}</p>
                            <p><strong>Currency:</strong> {{ strtoupper($booking->payment->currency) }}</p>
                            <p><strong>Status:</strong>
                                <span
                                    class="badge bg-{{ $booking->payment->status == 'succeeded' ? 'success' : 'danger' }}">
                                    {{ ucfirst($booking->payment->status) }}
                                </span>
                            </p>
                            {{-- <p><strong>Payment Method:</strong> {{ $booking->payment->payment_method ?? 'N/A' }}</p>  --}}
                            <p><strong>Payment Type:</strong> {{ $booking->payment->payment_type ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-4">No payment information available for this booking.</div>
            @endif
        @else
            <div class="alert alert-danger">Booking not found or access denied.</div>
        @endif


    </div>
@endsection
