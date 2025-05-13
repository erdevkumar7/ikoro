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
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">Booking Information</div>
                            <div class="card-body">
                                <p><strong>Booking Task:</strong> {{ $booking->gig->task->title ?? 'N/A' }}</p>
                                <p><strong>Host Name:</strong> {{ $booking->host->name ?? 'N/A' }}</p>
                                <p><strong>Tool:</strong> {{ $booking->equipment_name ?? 'N/A' }}</p>
                                   <p><strong>Location:</strong> {{ $booking->gig->state->name }} -
                                        {{ $booking->gig->city->name }} -
                                        {{ $booking->gig->zip->code }}</p>
                                <p><strong>Duration:</strong> {{ $booking->duration }}</p>                             
                                <p><strong>Operation Time:</strong> {{ $booking->operation_time }}</p>
                                @if (!empty($booking->feedback_tool))
                                    <p><strong>Feedback Tool:</strong> {{ $booking->feedback_tool ?? 'N/A' }}</p>
                                @endif
                                @if (!empty($booking->feedback_tool_value))
                                    <p><strong>Feedback Id/Number :</strong> {{ $booking->feedback_tool_value ?? 'N/A' }}
                                    </p>
                                @endif
                                @if (!empty($booking->feature->label))
                                    <p><strong>Selected Offer:</strong> {{ $booking->feature->label ?? 'N/A' }}</p>
                                @endif
                                @if (!empty($booking->host_notes))
                                    <p><strong>Host Notes:</strong> {{ $booking->host_notes ?? 'N/A' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if ($booking->payment)
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">Payment Information</div>
                                <div class="card-body">
                                    <p><strong>Transaction ID:</strong>
                                        {{ $booking->payment->payment_intent_id ? $booking->payment->payment_intent_id : 'N/A' }}
                                    </p>
                                    <p><strong>Amount Paid:</strong>
                                        ${{ $booking->payment->amount ? number_format($booking->payment->amount, 2) : 'N/A' }}
                                    </p>
                                    <p><strong>Currency:</strong>
                                        {{ $booking->payment->currency ? strtoupper($booking->payment->currency) : 'N/A' }}
                                    </p>
                                    <p><strong>Status:</strong>
                                        <span
                                            class="badge bg-{{ $booking->payment->status == 'succeeded' ? 'success' : 'danger' }}">
                                            {{ ucfirst($booking->payment->status) }}
                                        </span>
                                    </p>
                                    <p><strong>Payment Type:</strong> {{ $booking->payment->payment_type ?? 'N/A' }}</p>
                                    <a href="{{ route('booking.invoice.download', $booking->id) }}"
                                        class="btn btn-sm btn-outline-primary mt-3">
                                        <i class="fas fa-file-download"></i> Download Invoice
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">No payment information available for this booking.</div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="container mt-4">
                <div class="alert alert-danger">Booking not found or access denied.</div>
            </div>
        @endif


    </div>
@endsection
