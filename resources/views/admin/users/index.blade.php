@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')
    <div class="container">
        <div class="container-fluid mb-3">
            <div class="row align-items-center">
                <!-- Heading on the left -->
                <div class="col-md">
                    <h4>Manage Users</h4>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <table class="table table-responsive-md table-responsive-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->name }}</th>
                        <td>{{ $user->gender }}</td>
                        <td>{{ optional($user->user)->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ optional($user->country)->name }} - {{ optional($user->state)->name }} - {{ optional($user->city)->name }} - {{ optional($user->zip)->code }}</td>
                        <td class="action-td-width">
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{ $user['id'] }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $user['id'] }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
                                                this user </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                            
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" host_id="{{ $user->user->id }}"
                                                link="{{ route('admin.user.delete') }}"
                                                class="delete_host btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                   {{ $users->links() }}
                </li>
            </ul>
        </nav>
    </div>
    @push('scripts')
        <script src="{{ asset('backend/admin/assets/js/hosts.js') }}"></script>
    @endpush
@endsection
