@extends('user.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid bg-3 text-center">
  <h4>Hi, welcome back!</h4>
  <p>{{ ucfirst(auth()->user()->name) }}</p>
</div>
@endsection