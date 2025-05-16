{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', 'Users')
@section('content')

@section('current_page_css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .slow .toggle-group {
            transition: left 0.7s;
            -webkit-transition: left 0.7s;
        }
    </style>
@endsection

@section('current_page_js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('resources/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('resources/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
                <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
                <table id="myTable" class="display table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SNo.</th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Location</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php $i = ($users->currentPage() - 1) * $users->perPage(); @endphp --}}
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</th>
                                <td>{{ $user->id }}</th>
                                <td>{{ $user->name }}</th>
                                <td>{{ $user->gender }}</td>
                                <td>{{ optional($user->user)->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ optional($user->country)->name }} - {{ optional($user->state)->name }} -
                                    {{ optional($user->city)->name }} - {{ optional($user->zip)->code }}</td>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want
                                                        to
                                                        delete
                                                        this user </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                <script>
                    let table = new DataTable('#myTable', {
                        responsive: true
                    });
                </script>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            {{-- {{ $users->links() }} --}}
                        </li>
                    </ul>
                </nav>



            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->


</div>
@push('scripts')
    <script src="{{ asset('backend/admin/assets/js/hosts.js') }}"></script>
@endpush
@endsection
