{{-- @extends('host.layouts.app') --}}

@extends('host.layout.layout')

@section('title', 'My Tasks')
@section('content')
    <div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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


    
        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md ">
                    <h4>My Bookings</h4>
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <table class="table table-responsive-md table-responsive-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">Task</th>                   
                    <th scope="col">Tool</th>
                    <th scope="col">Locations</th>
                    <th scope="col">Time</th>
                    <th scope="col">User</th>
                    <th scope="col">Client Status</th>
                    <th scope="col">Admin Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $booking['title'] }}</th>                        
                        <td>{{ $booking->gig->equipment_name ?? '' }}</td>
                        <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} - {{ $booking['city_name'] }} - {{ $booking['zipcode'] }} </td>
                        <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td>
                        <th scope="row">{{ $booking->client->name }}</th>
                        <td>{{ $booking['client_status'] }}</td>
                        <td>{{ $booking['status'] }}</td>
                        <td>
                            @if ($booking['host_status'] == 'pending')
                                <a class=" btn btn-outline-success"
                                    href="{{ route('host.booking.action', [$booking['id'], $booking['host_id']]) }}?action=host_done">Mark Completed</a>
                            @else
                            <span class="badge badge-success">Done</span>
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
