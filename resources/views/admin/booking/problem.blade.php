@extends('admin.layouts.app')
@section('title', 'Report a Problem')
@section('content')
  <div class="container">
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