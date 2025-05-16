{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', $status . ' Booking Task')
<style>
    .table td,
    .table th {
        padding: .50rem !important;
    }

    .release-btn {
        padding: .200rem .150rem !important;
        line-height: 1 !important;
    }
</style>

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Bookings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Bookings </li>
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
                                <th>S.No</th>
                                <th scope="col">Booking Id</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Contact Info</th>

                                {{-- <th scope="col">Host Name</th> --}}
                                {{-- <th scope="col">Description</th> --}}
                                {{-- <th scope="col">Locations</th> --}}
                                {{-- <th scope="col">Time</th> --}}
                                <th scope="col">Booking Status</th>
                                <th scope="col">Payment Status</th>
                                {{-- <th scope="col">Host Status</th> --}}
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td scope="row"> {{ $booking->id }}</td>
                                    <td scope="row">{{ $booking->gig->task->title }}</td>
                                    <td scope="row">{{ optional($booking)->client->name ?? 'N/A' }}</td>
                                    <td scope="row"><strong>Email: </strong>{{ $booking->client->email }}<br>
                                        @if ($booking->clientDetails->feedback_tool == 'Skype')
                                            <strong>Skype: </strong> {{ $booking->clientDetails->skype }}
                                        @elseif($booking->clientDetails->feedback_tool == 'WhatsApp')
                                            <strong>WhatsApp: </strong> {{ $booking->clientDetails->whatsapp }}
                                        @endif
                                    </td>

                                    {{-- <td scope="row">{{ optional($booking)->host->name ?? 'N/A' }}</td> --}}
                                    {{-- <td>{{ $booking['briefing'] }}</td> --}}
                                    {{-- <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} - {{ $booking['city_name'] }} -
                            {{ $booking['zipcode'] }} </td> --}}
                                    {{-- <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td> --}}
                                    <td scope="row">
                                        @if ($booking['is_accepted'] == 'accepted')
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($booking['is_accepted'] == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($booking['is_accepted'] == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking['client_status'] == 'done' && $booking['host_status'] == 'done' && $booking['payment_status'] == 1)
                                            <span class="badge badge-success">Released</span>
                                        @elseif ($booking['client_status'] == 'done' && $booking['host_status'] == 'done')
                                            <a href="{{ route('admin.booking.payment', $booking['id']) }}"
                                                class=" btn btn-outline-success release-btn">Ready to Release</a>
                                        @elseif($booking['client_status'] == 'pending' || $booking['host_status'] == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class=" btn btn-outline-primary"
                                            href="{{ route('admin.booking.byBookingId', $booking['id']) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Data Available</td>
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

    {{-- <div class="modal fade" id="PricingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="host-modal-title" id="exampleModalLabel">Project Pricing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.booking.pricing') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="" />

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Task Price</label>
                            <input type="number" name="price" id="price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Commission (%)</label>
                            <input name="commission" id="commission" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Amount debitted from client</label>
                            <input id="client_debit" name="client_debit" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Amount Credit to host</label>
                            <input id="host_credit" name="host_credit" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Amount Credit to admin</label>
                            <input id="admin_credit" name="admin_credit" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block shadow">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
    @push('scripts')
        <script>
            $("#commission").on('input', function(e) {
                let price = $("#price").val();
                let commission = $("#commission").val();
                let admin_credit = price * commission / 100;
                let credit = price * commission / 100;

                $("#client_debit").val(price);
                $("#host_credit").val(price - admin_credit);
                $("#admin_credit").val(admin_credit);
            });

            $(".mark-completed").click(function(e) {
                e.preventDefault();
                $('#booking_id').val($(this).attr("booking_id"));
                $('#PricingModal').modal('show');
            });
        </script>
    @endpush
@endsection
