@extends('admin.layouts.app')
@section('title', 'My Earnings')
@section('content')
    <div class="container">
        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>Host {{$host->name}}: ({{$wallet['balance'] ?? 0.00}}) {{ config('currency.default') }}
                        <a class="btn btn-primary" data-toggle="modal" data-target="#payToHostModal">Transfer to host </a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payToHostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="host-modal-title" id="exampleModalLabel">Amount paid to host</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.host.transfer', $wallet['id'])}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Price($)</label>
                                <input type="number" name="amount" id="amount" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Proof</label>
                                <input type="file" name="image" id="image" class="form-control" required  />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block shadow">Submit</button>
                        </div>
                    </form>
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
                    <th scope="col">Proof</th>
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
                        <td>
                            @if($trx['image'] != "")
                            <a target="_blank" href="{{url('storage/' . $trx['image']) }}">image</a>
                            @endif
                        </td>
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
