@extends('user.layout-new.app')
@section('title', 'Bookings')
<style>
    .table td,
    .table th {
        padding: .50rem !important;
    }

    .mark-complete-btn {
        padding: .200rem .150rem !important;
        line-height: 1 !important;
    }
</style>
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Bookings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
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
                    <table id="myTable" class="display table table-responsive-md table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No </th>
                                <th scope="col">Booking Id</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Host Name</th>
                                <th scope="col">Host Contact Info</th>
                                <th scope="col">Booking Status</th>
                                {{-- <th scope="col">Locations</th> --}}
                                {{-- <th scope="col">Time</th> --}}

                                {{-- <th scope="col">Host Status</th> --}}
                                {{-- <th scope="col">Admin Status</th> --}}
                                <th scope="col">Service Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td scope="row">{{ $booking['id'] }}</td>
                                    <td scope="row">{{ $booking->gig->task->title }}</td>
                                    <td scope="row">{{ $booking->host->name ?? 'Not Assigned' }}</td>
                                    <td scope="row">
                                        <strong>Email: </strong>{{ $booking->host->email }}<br>
                                        @if ($booking->hostDetails->phone)
                                            <strong>Contact: </strong> {{ $booking->hostDetails->phone }}
                                        @endif
                                    </td>
                                    <td scope="row">
                                        @if ($booking['is_accepted'] == 'accepted')
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($booking['is_accepted'] == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($booking['is_accepted'] == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>

                                    {{-- <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} -
                                        {{ $booking['city_name'] }} -
                                        {{ $booking['zipcode'] }} </td> --}}
                                    {{-- <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td> --}}

                                    {{-- <td>{{ $booking['host_status'] }}</td> --}}
                                    {{-- <td>{{ $booking['status'] }}</td> --}}

                                    <td>

                                        @if ($booking['client_status'] == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @else
                                            @if ($booking['is_accepted'] == 'accepted')
                                                <a class=" btn btn-outline-success mark-complete-btn"
                                                    href="{{ route('user.booking.action', [$booking['id'], $booking['host_id'] ?? '']) }}?action=client_done">Mark
                                                    Completed</a>
                                            @elseif($booking['is_accepted'] == 'rejected')
                                                <span class="badge badge-warning">Host rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td scope="row"> <a class=" btn btn-outline-primary"
                                            href="{{ route('user.booking.byBookingId', $booking['id']) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{-- <ul class="pagination justify-content-end">
                            <li class="page-item">
                                {{ $bookings->links() }}
                            </li>
                        </ul> --}}
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
