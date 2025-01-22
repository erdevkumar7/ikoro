@extends('admin.layouts.app')
@section('title', 'Support')
@section('content')
  <div class="container">
      <div class="container-fluid mb-3">
          <div class="row align-items-center">
              <!-- Heading on the left -->
              <div class="col-md">
                  <h4>Tickets</h4>
              </div>
          </div>
      </div>
      <table class="table table-responsive-md table-responsive-sm table-bordered">
          <thead>
              <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Title</th>
                  <th scope="col">Staus</th>
                  <th scope="col">Action</th>
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