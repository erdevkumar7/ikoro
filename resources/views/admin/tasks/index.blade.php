{{-- @extends('admin.layouts.app') --}}

@extends('admin.layout.layout')

@section('title', 'Tasks')

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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Services</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <!-- Heading on the left -->
                <div class="col-md-4 text-md-left">
                    <h4>Manage Services</h4>
                </div>
                <!-- Form on the right -->
                <div class="col-md-8 text-md-right">
                    {{-- <button id="add_task_btn" type="button" class="btn btn-outline-success my-2 my-sm-0">
                        Add New Task
                    </button> --}}
                </div>
                <!-- Modal -->
                <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">

                    <div class="modal-dialog">

                        <form id="taskForm" method="POST" action="{{ route('admin.task.store') }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="task-modal-title" id="exampleModalLabel">Add New Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="">
                                    <div class="form-group">
                                        <label for="title">Task Title</label>
                                        <input type="text" id="title" name="title" placeholder="Enter task title"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Task Icon</label>
                                        <input type="text" id="icon" name="icon" placeholder="Icon code"
                                            required>
                                        <small><a class="text text-danger font-weight-bold"
                                                href="https://fontawesome.com/search" target="__blank">Please add fontawsome
                                                icon like fa-solid fa-house</a></small>

                                    </div>

                                    <div class="form-group">

                                        <label for="description">Description</label>

                                        <textarea id="description" name="description" rows="3" placeholder="Enter task description" required></textarea>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button id="save_task" type="submit"
                                        class="submit-btn btn btn-outline-success text-right">Save Task</button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        <table class="table table-responsive-md table-responsive-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">Service Title</th>
                    <th scope="col">Service Icon</th>
                    <th scope="col" colspan="2">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $task['title'] }}</th>
                        <td><i class="fas {{ $task['icon'] }}"></i></td>
                        <td colspan="2">{{ $task['description'] }}</td>
                        <td class="action-td-width">
                            <button type="button" class="editbtn btn btn-sm btn-primary" task="{{ json_encode($task) }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{ $task['id'] }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->

                            <div class="modal fade" id="exampleModal{{ $task['id'] }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
                                                this task </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-footer">
                                            @csrf
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" task_id="{{ $task['id'] }}"
                                                link="{{ route('admin.task.delete') }}"
                                                class="delete_task btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    {{ $tasks->links() }}
                </li>
            </ul>
        </nav>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/admin/assets/js/tasks.js') }}"></script>
@endpush
