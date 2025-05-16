{{-- @extends('admin.layouts.app') --}}
@extends('admin.layout.layout')
@section('title', 'Hosts')
@section('content')
    <div class="content-wrapper">




        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blocked Host</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Blocked Host</li>
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
                    <table id="myTable" class="display table-responsive-md table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hosts as $host)
                                <tr>
                                    <th scope="row">{{ $host->name }}</th>
                                    <td>{{ $host->gender }}</td>
                                    <td>{{ optional($host->user)->email }}</td>
                                    <td>{{ $host->phone }}</td>
                                    <td>{{ optional($host->country)->name }} - {{ optional($host->state)->name }} -
                                        {{ optional($host->city)->name }} - {{ optional($host->zip)->code }}</td>
                                    <td>
                                        <select class="form-select"
                                            onchange="updateStatus(this, '{{ route('admin.host.status', ['host' => $host->id]) }}')"
                                            data-id="{{ $host->id }}">
                                            <option value="0" {{ $host->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $host->status == 1 ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="2" {{ $host->status == 2 ? 'selected' : '' }}>Blocked
                                            </option>
                                        </select>
                                    </td>
                                    <td class="action-td-width">
                                        <a href="{{ route('admin.host.edit', $host->id) }}">
                                            <button type="button" class="editbtn btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#exampleModal{{ $host['id'] }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $host['id'] }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want
                                                            to delete
                                                            this host </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        @csrf
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" host_id="{{ $host->user->id }}"
                                                            link="{{ route('admin.host.delete') }}"
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
                                {{-- {{ $hosts->links() }} --}}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('backend/admin/assets/js/hosts.js') }}"></script>
    @endpush
@endsection
