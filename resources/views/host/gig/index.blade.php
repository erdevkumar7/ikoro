{{-- @extends('host.layouts.app') --}}

@extends('host.layout.layout')

@section('title', 'My Gigs')
@section('content')
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Services
                            <a class="btn btn-info" href="{{ url('/host/gig/addedit') }}" class="nav-link">Add New</a>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('host/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Services </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('gig_id'))
            <input id="has_gig_id" type="hidden" value="{{ Session::get('gig_id') }}">
        @endif

        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Name</th> --}}
                                <th scope="col">Type</th>
                                <th scope="col">Tool</th>
                                <th scope="col">Locations</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gigs as $gig)
                                <tr>
                                    {{-- <th scope="row">{{ $gig['title']  }}</th> --}}
                                    <td>{{ $gig['task']['title'] }}</td>
                                    <td>{{ $gig['equipment_name'] }}</td>
                                    <td>{{ $gig['country']['name'] ?? '' }} - {{ $gig['state']['name'] ?? '' }} -
                                        {{ $gig['city']['name'] ?? '' }} -
                                        {{ $gig['zip']['code'] ?? '' }} </td>
                                    <td>{{ $gig['status'] ?? '' }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('host.gig.addedit', $gig['id']) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-primary" data-toggle="modal"
                                            data-target="#gigFile{{ $gig['id'] }}">
                                            <i class="fa-solid fa-image"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#gigView{{ $gig['id'] }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item">
                                {{ $gigs->links() }}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


        <!-- Modal -->
        @foreach ($gigs as $gig)
            <div class="modal fade" id="gigFile{{ $gig['id'] }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Media Upload for {{ $gig['title'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}</p>
                            @endif
                            @if (isset($gig['media']))
                                <div class="row mb-4 mt-2">
                                    @foreach ($gig['media'] as $media)
                                        <div class="col-md-3 mt-2 text-center position-relative">
                                            <a href="{{ url('storage/' . $media->path) }}" target="_blank"
                                                class="position-relative d-inline-block">
                                                <img src="{{ url('storage/app/public/' . $media->path) }}"
                                                    alt="Media Image: {{ $media->name ?? 'No Name' }}" width="50">
                                            </a>
                                            <button type="button" route="{{ route('host.gig.deleteMedia', $media->id) }}"
                                                class="remove_gig_media btn badge badge-sm badge-danger position-absolute"
                                                style="top: 0; right: 0; transform: translate(50%, -50%);">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <form method="POST" action="{{ route('host.gig.storeMedia', $gig['id'] ?? '') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row row">
                                            <div class="form-group">
                                                <label for="myfile">Images/Videos:</label>
                                                <input type="file" class="form-control" name="files[]" id="files"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($gigs as $gig)
            <div class="modal fade" id="gigView{{ $gig['id'] }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Details {{ $gig['title'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-responsive-md table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $gig['description'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Equiment Used</th>
                                        {{-- <td>{{ $gig['equipmentPrice']['equipment_name'] }}</td> --}}
                                    </tr>
                                    <tr>
                                        <th>Pricing ($/mins)</th>
                                        <td>{{ $gig['price'] }}$/{{ $gig['minutes'] }}mins </td>
                                    </tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td>{{ date('d-M-Y g:ia', strtotime($gig['created_at'])) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center" style="font-size: 25px;">Features</th>
                                    </tr>
                                    <tr>
                                        <th>Label</th>
                                        <th>value</th>
                                    </tr>
                                    @foreach ($gig['features'] as $feature)
                                        <tr>
                                            <td>{{ $feature['label'] }}</td>
                                            <td>{{ $feature['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
