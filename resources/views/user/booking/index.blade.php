@extends('user.layouts.app')
@section('title', 'Bookings')
@section('content')
    <div class="container">
        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>My Bookings</h4>
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
        <table class="table table-responsive-md table-responsive-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">Task</th>
                    <th scope="col">Host</th>
                    <th scope="col">Description</th>
                    <th scope="col">Locations</th>
                    <th scope="col">Time</th>
                    <th scope="col">Host Status</th>
                    <th scope="col">Admin Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $booking['title'] }}</th>
                        <th scope="row">{{ $booking->host->name ?? 'Not Assigned' }}</th>
                        <td>{{ $booking->gig->title ?? '' }}</td>
                        <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} - {{ $booking['city_name'] }} -
                            {{ $booking['zipcode'] }} </td>
                        <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td>
                        <td>{{ $booking['host_status'] }}</td>
                        <td>{{ $booking['status'] }}</td>
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
@endsection
