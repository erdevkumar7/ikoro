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
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.booking') ? 'active text-dark font-weight-bold' : '' }}" href="{{ route('user.booking') }}">My Bookings</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.support') }}">Support</a>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        My Jobs
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.job.pending') }}">Pending Job</a>
                        <a class="dropdown-item" href="{{ route('user.job.completed') }}">Completed Job</a>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.wallet') }}">My Wallet <span id="amount"></span></a>
                </li>
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
    <script src="{{ asset('frontend/assets/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- Modal --}}
    <script>
        // Get modal element
        var modal = document.getElementById('simpleModal');

        // Get open modal button
        var openModalBtn = document.getElementById('openModalBtn');

        // Get close button
        var closeBtn = document.querySelector('.close');

        // Open modal
        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'block';
        });

        // Close modal when clicking on close button
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Close modal when clicking anywhere outside the modal
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
    @stack('scripts')

</body>


</html>
