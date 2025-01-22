@extends('admin.layouts.app')
@section('title', $status . ' Booking Task')
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>Manage Bookings ({{ $status }})</h4>
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
                    <th scope="col">Client</th>
                    <th scope="col">Host</th>
                    <th scope="col">Description</th>
                    <th scope="col">Locations</th>
                    <th scope="col">Time</th>
                    <th scope="col">Client Status</th>
                    <th scope="col">Host Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $booking['title'] }}</th>
                        <th scope="row">{{ optional($booking)->client->name ?? 'N/A' }}</th>
                        <th scope="row">{{ optional($booking)->host->name ?? 'N/A' }}</th>                        <td>{{ $booking['briefing'] }}</td>
                        <td>{{ $booking['country_name'] }} - {{ $booking['state_name'] }} - {{ $booking['city_name'] }} -
                            {{ $booking['zipcode'] }} </td>
                        <td>{{ date('d-M-Y g:ia', strtotime($booking['operation_time'])) }}</td>
                        <td>
                            @if($booking['client_status'] == "done")
                            <i class="fa-solid fa-check" style="color:green"></i> 
                            @else
                            <i class="fa-solid fa-xmark" style="color:red"></i> 
                            @endif
                        </td>
                        <td>
                            @if($booking['host_status'] == "done")
                            <i class="fa-solid fa-check" style="color:green"></i> 
                            @else
                            <i class="fa-solid fa-xmark" style="color:red"></i> 
                            @endif
                        </td>
                        <td>
                            @if ($status == 'new_order')
                                <a class=" btn btn-outline-success"
                                    href="{{ route('admin.booking.match', $booking['id']) }}">Match</a>
                            @elseif($status == 'pending' && $booking['client_status'] == 'done' && $booking['host_status'] == 'done')
                                <a booking_id="{{$booking['id']}}" host_id="{{$booking['host_id']}}" class="mark-completed btn btn-outline-success">Mark Completed</a>
                            @elseif($status == 'completed')
                                <span class="badge badge-success">Completed</span>
                            @else
                            <span class="badge badge-dark">waiting...</span>
                            @endif
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
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    {{ $bookings->links() }}
                </li>
            </ul>
        </nav>
    </div>

    <div class="modal fade" id="PricingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="host-modal-title" id="exampleModalLabel">Project Pricing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.booking.pricing')}}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="" />

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Task Price</label>
                            <input type="number" name="price" id="price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Commission (%)</label>
                            <input name="commission" id="commission" class="form-control" required  />
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
    </div>

    @push('scripts')
    <script>
        $("#commission").on('input', function(e){
            let price = $("#price").val();
            let commission = $("#commission").val();
            let admin_credit = price * commission / 100;
            let credit = price * commission / 100;

            $("#client_debit").val(price);
            $("#host_credit").val(price - admin_credit);
            $("#admin_credit").val(admin_credit);
        });
        
        $(".mark-completed").click(function(e){
            e.preventDefault();
            $('#booking_id').val($(this).attr("booking_id"));
            $('#PricingModal').modal('show');
        });
    </script>
    @endpush
@endsection
