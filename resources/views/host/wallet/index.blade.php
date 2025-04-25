{{-- @extends('host.layouts.app') --}}

@extends('host.layout.layout')

@section('title', 'My Earnings')
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
                <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </div>
            </div>
        </div>
    </div>


        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>My Earnings ({{$wallet['balance'] ?? 0.00}}) {{ config('currency.default') }}</h4>
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <h4>Transactions</h4>

        <table class="table table-responsive-md table-responsive-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Reference</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($wallet['transactions']))
                @forelse ($wallet['transactions'] as $trx)
                    <tr>
                        <th scope="row">{{ date('d-M-Y g:ia', strtotime($trx['created_at'])) }}</th>
                        <td>{{ ($trx['type'] == 'credit') ? $trx['amount'] : '-' }}</td>
                        <td>{{ ($trx['type'] == 'debit') ? $trx['amount'] : '-' }}</td>
                        <td>{{ $trx['balance'] }}</td>
                        <td>{{ $trx['trxref'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Available</td>
                    </tr>
                @endforelse
                @else
                    <tr>
                        <td colspan="5" class="text-center">No Data Available</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                </li>
            </ul>
        </nav>


    </div>
@endsection
