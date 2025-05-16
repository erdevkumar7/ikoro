{{-- @extends('host.layouts.app') --}}

@extends('host.layout.layout')
<style>
    .accept-disable-cursr {
        color: #fff !important;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    .accept-disable-cursr:hover {
        cursor: not-allowed !important;
    }
    .table td,
    .table th {
        padding: .50rem !important;
    }

    .btn {
        line-height: 0.5 !important;
    }

    .mark-complete-btn {
        padding: .200rem .150rem !important;
        line-height: 1 !important;
    }
</style>
@section('title', 'My Tasks')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Bookings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('host/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Bookings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="display table-responsive-md table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                {{-- <th scope="col">Booking</th> --}}
                                <th scope="col">Booking Id</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Contact Info</th>

                                <th scope="col">Booking Status</th>
                                <th scope="col">Service Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td scope="row">{{ $booking->id }}</td>
                                    <td scope="row">{{ $booking->gig->task->title }}</td>
                                    <td scope="row">{{ optional($booking)->client->name ?? 'N/A' }}</td>
                                    <td scope="row"><strong>Email: </strong>{{ $booking->client->email }}<br>
                                        @if ($booking->clientDetails->feedback_tool == 'Skype')
                                            <strong>Skype: </strong> {{ $booking->clientDetails->skype }}
                                        @elseif($booking->clientDetails->feedback_tool == 'WhatsApp')
                                            <strong>WhatsApp: </strong> {{ $booking->clientDetails->whatsapp }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($booking['is_accepted'] === 'pending')
                                            <a class="btn btn-outline-success"
                                                href="{{ route('host.booking.action', [$booking['id'], $booking['host_id']]) }}?action=host_accepted">Accept</a>
                                            @if ($booking['host_status'] === 'pending')
                                                <a class="btn btn-outline-danger"
                                                    href="{{ route('host.booking.action', [$booking['id'], $booking['host_id']]) }}?action=host_rejected">Reject</a>
                                            @endif
                                        @elseif ($booking['is_accepted'] === 'accepted')
                                            <span class="btn btn-outline-success accept-disable-cursr">Accepted</span>
                                        @elseif ($booking['is_accepted'] === 'rejected')
                                            <span class="btn btn-outline-danger disabled">Rejected</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($booking['host_status'] == 'pending')
                                            @if ($booking['is_accepted'] === 'accepted')
                                                <a class=" btn btn-outline-success mark-complete-btn"
                                                    href="{{ route('host.booking.action', [$booking['id'], $booking['host_id']]) }}?action=host_done">Mark
                                                    Completed</a>
                                            @else
                                                <span class="btn btn-warning">Pending</span>
                                            @endif
                                        @else
                                             <span class="btn btn-outline-success accept-disable-cursr">done</span>
                                        @endif
                                    </td>
                                    <th scope="row"><a class=" btn btn-outline-primary"
                                            href="{{ route('host.booking.byBookingId', $booking['id']) }}"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item">
                                {{-- {{ $bookings->links() }} --}}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


    </div>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endsection
