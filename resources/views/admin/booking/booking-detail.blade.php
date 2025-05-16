@extends('admin.layout.layout')
@section('title', 'Booking-detail')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Booking-detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Booking-detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        @if ($booking)
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">Booking Information</div>
                            <div class="card-body">
                                <p><strong>Booking Id:</strong> {{ $booking->id }}</p>
                                <p><strong>Booking Task:</strong> {{ $booking->gig->task->title }}</p>
                                <p><strong>User Name:</strong> {{ $booking->client->name ?? 'N/A' }}</p>
                                <p><strong>User Email:</strong> {{ $booking->client->email }}</p>
                                <p>
                                    @if ($booking->clientDetails->feedback_tool == 'Skype')
                                        <strong>User Skype: </strong> {{ $booking->clientDetails->skype }}
                                    @elseif($booking->clientDetails->feedback_tool == 'WhatsApp')
                                        <strong>User WhatsApp: </strong> {{ $booking->clientDetails->whatsapp }}
                                    @endif
                                </p>
                                <p><strong>Host Name:</strong> {{ $booking->host->name ?? 'N/A' }}</p>
                                {{-- <p><strong>Host Email: </strong> {{ $booking->host->email }}</p> --}}
                                <p><strong>Host-Contact: </strong> {{ $booking->hostDetails->phone }}</p>
                                <p><strong>Booking Status:</strong>
                                    @if ($booking['is_accepted'] == 'accepted')
                                        <span class="badge badge-success">Accepted</span>
                                    @elseif($booking['is_accepted'] == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($booking['is_accepted'] == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </p>
                                <p><strong>Tool Used:</strong> {{ $booking->equipment_name ?? 'N/A' }}</p>
                                <p><strong>Location:</strong> {{ $booking->gig->state->name }} -
                                    {{ $booking->gig->city->name }} -
                                    {{ $booking->gig->zip->code }}</p>
                                <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                                <p><strong>Operation Time:</strong> {{ $booking->operation_time }}</p>
                                <p><strong>Payment Release: </strong>
                                    @if ($booking['client_status'] == 'done' && $booking['host_status'] == 'done' && $booking['payment_status'] == 1)
                                        <span class="badge badge-success"> Released </span>
                                    @elseif ($booking['client_status'] == 'done' && $booking['host_status'] == 'done')
                                        <span class="badge badge-success"> Ready to Release </span>
                                    @elseif($booking['client_status'] == 'pending' || $booking['host_status'] == 'pending')
                                        <span class="badge badge-warning"> Pending </span>
                                    @endif
                                </p>
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
                                    <a href="{{ route('admin.booking.invoice.download', $booking->id) }}"
                                        class="btn btn-sm btn-outline-primary mt-3">
                                        <i class="fas fa-file-download"></i> Download Invoice
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">Payment Amount</div>                             
                                <div class="card-body">
                                    <p class="d-flex justify-content-between">
                                        <strong>Total Amount:</strong>
                                        <span>${{ $booking->payment->amount ? number_format($booking->payment->amount, 2) : 'N/A' }}</span>
                                    </p>

                                    <p class="d-flex justify-content-between">
                                        <strong>Commission:</strong>
                                        <span>{{ $commission->percentage }}%</span>
                                    </p>

                                    @php
                                        $total = $booking->payment->amount;
                                        $percentage = $commission->percentage;
                                        $commissionAmount = ($total * $percentage) / 100;
                                        $hostAmount = $total - $commissionAmount;
                                    @endphp

                                    <p class="d-flex justify-content-between">
                                        <strong>Host Payment:</strong>
                                        <span>${{ number_format($hostAmount, 2) }}</span>
                                    </p>

                                    <p class="d-flex justify-content-between">
                                        <strong>Admin Payment:</strong>
                                        <span>${{ number_format($commissionAmount, 2) }}</span>
                                    </p>
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
