@extends('host.layouts.app')
@section('title', 'My Earnings')
@section('content')
    <div class="container">
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
