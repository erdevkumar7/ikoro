{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout') 
@section('title', 'Support')

@section('content')

  <div class="content-wrapper">


  
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Support Problems</li>
                </ol>
            </div>
            </div>
        </div>
    </div>


      <div class="container-fluid mb-3">

          <div class="row align-items-center">

              <!-- Heading on the left -->

              <div class="col-md">

                  <h4>Support Problems</h4>

              </div>

          </div>

      </div>

      <table class="table table-responsive-md table-responsive-sm table-bordered">

          <thead>

              <tr>

                  <th scope="col">Date</th>

                  <th scope="col">Title</th>

                  <th scope="col">Status</th>

                  <th scope="col">User</th>

                  <th scope="col">Action</th>

              </tr>

          </thead>

          <tbody>

            @foreach ($tokens as $token)

                <tr>

                    <td>{{ $token->created_at->format('d M Y, h:i A') }}</td>

                    <td>{{ $token->title }}</td>

                    <td>{{ $token->status == 0 ? 'Open' : 'Closed' }}</td>

                    <td>{{ $token->user->name }}</td>

                    <td>

                        <!-- Action buttons (Edit, Delete, etc.) can go here -->

                        <a href="{{ route('admin.support.view', $token->id) }}" class="btn btn-sm btn-primary">View</a>



                    </td>

                </tr>

            @endforeach

          </tbody>

      </table>

      <nav aria-label="Page navigation example">

          <ul class="pagination justify-content-end">

              <li class="page-item"></li>

          </ul>

      </nav>

  </div>

@endsection

