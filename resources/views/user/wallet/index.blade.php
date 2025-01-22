@extends('user.layouts.app')
@section('title', 'My Wallet')
@section('content')
    <div class="container">
        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>My Wallet ({{$wallet['balance'] ?? 0.00}}) {{ config('currency.default') }}</h4>
                </div>
                <div class="col-md">
                    <form method="post" action="{{ route('pay') }}">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" name="amount" placeholder="Topup Amount" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block shadow">
                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       @if (Session::has('message'))
            @if (is_array(Session::get('message')))
                @foreach (Session::get('message') as $msg)
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ $msg }}</p>
                @endforeach
            @endif
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
