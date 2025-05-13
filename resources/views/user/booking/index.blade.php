@extends('user.layout-new.app')
@section('title', 'Bookings')
@section('content')
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
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive-md table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Tool</th>
                                {{-- <th scope="col">Locations</th> --}}
                                <th scope="col">Time</th>
                                <th scope="col">Host</th>
                                {{-- <th scope="col">Host Status</th> --}}
                                {{-- <th scope="col">Admin Status</th> --}}
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <th scope="row"><a
                                            href="{{ route('user.booking.byBookingId', $booking['id']) }}">{{ $booking['title'] }}</a>
                                    </th>
                                    <td>{{ $booking->gig->equipment_name ?? '' }}</td>

                                    {{-- <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} -
                                        {{ $booking['city_name'] }} -
                                        {{ $booking['zipcode'] }} </td> --}}
                                    <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td>
                                    <td scope="row">{{ $booking->host->name ?? 'Not Assigned' }}</td>
                                    {{-- <td>{{ $booking['host_status'] }}</td> --}}
                                    {{-- <td>{{ $booking['status'] }}</td> --}}

                                    <td>
                                        @if ($booking['client_status'] == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @else
                                            @if ($booking['client_status'] == 'pending' && $booking['host_id'] == '')
                                                <span class="badge badge-success">Pending</span>
                                            @else
                                                <a class=" btn btn-outline-success"
                                                    href="{{ route('user.booking.action', [$booking['id'], $booking['host_id'] ?? '']) }}?action=client_done">Mark
                                                    Completed</a>
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
                        <ul class="pagination justify-content-end">
                            <li class="page-item">
                                {{ $bookings->links() }}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
