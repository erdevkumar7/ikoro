@extends('user.layouts.app')
@section('title', 'Payments')
@section('content')
<div class="container">
    <div class="container-fluid mb-3">
        <div class="row align-items-center">
            <!-- Heading on the left -->
            <div class="col-md">
                <h4>Available Balance</h4>
            </div>

        </div>
    </div>
    <table class="table table-responsive-md table-responsive-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Description</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="text-center">Under Development</td>
            </tr>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item"></li>
        </ul>
    </nav>


</div>
@endsection
