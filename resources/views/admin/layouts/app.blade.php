<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- ::::::::: select2 CSS :::::::::: -->
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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.tasks') ? 'active text-dark font-weight-bold' : '' }}"
                        href="{{ route('admin.tasks') }}">
                        Tasks
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.booking.order') ? 'active text-dark font-weight-bold' : '' }}" href="#" id="bookingDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Booking <span id="cnt-new-booking"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="bookingDropdown">
                        <a class="dropdown-item" href="{{ route('admin.booking.order', 'new_order') }}">New order</a>
                        <a class="dropdown-item" href="{{ route('admin.booking.order', 'pending') }}">Pending Task</a>
                        <a class="dropdown-item" href="{{ route('admin.booking.order', 'completed') }}">Completed</a>
                        <a class="dropdown-item" href="{{ route('admin.booking.problem') }}">Report a Problem</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.host') ||  request()->routeIs('admin.host.approved') ||  request()->routeIs('admin.host.blocked') ? 'active text-dark font-weight-bold' : '' }}" href="#" id="bookingDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Manage Hosts
                    </a>
                    <div class="dropdown-menu" aria-labelledby="bookingDropdown">
                        <a class="dropdown-item" href="{{ route('admin.host') }}">Pending</a>
                        <a class="dropdown-item" href="{{ route('admin.host.approved') }}">Approved</a>
                        <a class="dropdown-item" href="{{ route('admin.host.blocked') }}">Blocked</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.user') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.user') }}">Manage users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.location') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.location') }}">Locations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.payment') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.payment') }}">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.support') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.support') }}">Support</a>
                </li>
                @php
                use App\Models\Token;
                $token_count = Token::where('awaiting_reply', 1)->get()->count();
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.problems') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('admin.problems') }}">Problems ({{ $token_count }})</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="jobsDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        My Jobs
                    </a>
                    <div class="dropdown-menu" aria-labelledby="jobsDropdown">
                        <a class="dropdown-item" href="{{ route('admin.job.pending') }}">Pending Job</a>
                        <a class="dropdown-item" href="{{ route('admin.job.completed') }}">Completed Job</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Wallet: $500.00</a>
                </li> --}}
            </ul>
            <div class="dropdown">
                <img src="{{ asset('backend/admin/images/unnamed-removebg-preview.png') }}" alt="Logout"
                    class="logout-img dropdown-toggle" id="profileDropdown" data-toggle="dropdown"
                    aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                        <img src="{{ asset('backend/admin/images/unnamed-removebg-preview.png') }}" alt="Admin"
                            class="admin-img">
                    </a>
                    <a href="javascript:;" class="dropdown-item">{{ ucfirst(auth()->user()->name) }}</a>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- Modal --}}
    @stack('scripts')

    <!-- ::::::::: slect2 js :::::::::: -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('backend/admin/assets/js/admin.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/get-locations.js') }}"></script>

</body>


</html>
