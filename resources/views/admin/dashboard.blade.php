{{--    @extends('admin.layouts.app')   --}}
@extends('admin.layout.layout')
@section('title', 'Dashboard')
@section('content')


<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

<!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        </div>
    </div>
    </div>

<!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <h4>Hi, <b> {{ ucfirst(auth()->user()->name) }} </b> welcome back!</h4>
        
    </div>
    </section>
</div>



@endsection
