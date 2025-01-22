<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset(config('app.favicon')) }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap-reboot.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/manage-tasks.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Menu Items -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="{{ asset('frontend/images/logo.jpg') }}" style="width: 100px;" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto text-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('host.dashboard') ? 'active text-dark font-weight-bold' : '' }}"
                        href="{{ route('host.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('host.contract.booking') ? 'active text-dark font-weight-bold' : '' }}"
                        href="{{ route('host.contract.booking') }}">My Tasks</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('host.gig.index') || request()->routeIs('host.gig.addedit') ? 'active text-dark font-weight-bold' : '' }}" href="#" id="bookingDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        My Gigs
                    </a>
                    <div class="dropdown-menu" aria-labelledby="bookingDropdown">
                        <a class="dropdown-item" href="{{ route('host.gig.index') }}">My Gigs</a>
                        <a class="dropdown-item" href="{{ route('host.gig.addedit') }}">Add New</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('host.wallet') ? 'active text-dark font-weight-bold' : '' }}"
                        href="{{ route('host.wallet') }}">My Earnings</a>
                </li>
            </ul>
            <div class="dropdown">
                @if (Auth::id() && Auth::user()->host->image)
                    <img src="{{ asset('public/'.Auth::user()->host->image) }}" class="rounded-circle"
                        alt="Logout" id="profileDropdown" data-toggle="dropdown" aria-expanded="false"
                        style="width: 50px; height: 50px;">
                @else
                    <img src="{{ asset('backend/admin/images/unnamed-removebg-preview.png') }}" alt="Logout"
                        class="logout-img dropdown-toggle" id="profileDropdown" data-toggle="dropdown"
                        aria-expanded="false">
                @endif

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" style="text-align: center;" href="#">
                        @if (Auth::id() && Auth::user()->host->image)
                            <img src="{{ asset('public/'.Auth::user()->host->image) }}" class="admin-img rounded-circle" style="width: 50px; height: 50px;" alt="Admin">
                        @else
                            <img src="{{ asset('backend/admin/images/unnamed-removebg-preview.png') }}" alt="Admin"
                                class="admin-img">
                        @endif
                    </a>
                    <a href="javascript:;" class="dropdown-item">{{ ucfirst(auth()->user()->name) }}</a>
                    <a href="{{ route('host.profile') }}" class="dropdown-item">Profile</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


    @yield('content')


    <footer class="text-center">
        <p>Copyright © {{ date('Y') }} www.website.com</p>
    </footer>
    @stack('scripts')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- Full jQuery version -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ::::::::: select2 js :::::::::: -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('backend/admin/assets/js/get-locations.js') }}"></script>

    <script type="text/javascript" src="{{ asset('backend/admin/assets/js/gigs.js') }}"></script>
</body>


</html>
