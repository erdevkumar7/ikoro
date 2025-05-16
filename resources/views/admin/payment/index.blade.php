{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', 'Payments')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transactions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="display table-responsive-md table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SNo.</th>
                                <th scope="col">Booking Id</th>
                                <th scope="col">Txn Amount </th>
                                <th scope="col">Tnx Status </th>
                                <th scope="col">Tnx Id </th>
                                <th scope="col">Tnx Method</th>
                                <th scope="col">Tnx Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td scope="row"><a
                                            href="{{ route('admin.booking.byBookingId', $payment->booking->id) }}">{{ $payment->booking->id }}</a>
                                    </td>
                                    <td scope="row">{{ $payment->amount }}</td>
                                    <td scope="row">{{ $payment->status }}</td>
                                    <td scope="row">{{ $payment->payment_intent_id }}</td>
                                    <td scope="row">{{ $payment->payment_type }}</td>
                                    <td scope="row">{{ $payment->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item"></li>
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
