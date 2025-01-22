@extends('admin.layouts.app')
@section('title', 'Support')
@section('content')
  <div class="container">
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
