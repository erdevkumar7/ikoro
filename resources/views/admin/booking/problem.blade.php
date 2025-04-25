{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout') 
@section('title', 'Report a Problem')
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
                    <li class="breadcrumb-item active">Report a Problem</li>
                    </ol>
                </div>
                </div>
            </div>
            </div>

      <div class="container-fluid">
          <div class="row align-items-center mb-3">
              <!-- Heading on the left -->
              <div class="col-md">
                  <h4>Report a Problem</h4>
              </div>
          </div>
      </div>
      <table class="table table-responsive-md table-responsive-sm table-bordered">
          <thead>
              <tr>
                  <th scope="col">Task Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <td colspan="5" class="text-center">Under Development</td>
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