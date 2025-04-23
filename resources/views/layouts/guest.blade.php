<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset(config('app.favicon')) }}">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ::::::::: select2 CSS :::::::::: -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/select2/select2.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .dot {
            color: rgb(169 240 5);
            font-size: 40px;
            margin-top: 0px;
        }
        ul.navbar-nav a.nav-link {
    color: #fff !important;
}
i.fa-solid.fa-bars {
    color: #fff;
    font-size: 26px;
}
.navbar-light .navbar-nav .nav-link:hover {
    color: #a9f005 !important;
}

nav.navbar.navbar-expand-lg.navbar-light {
    padding-bottom: 20px;
}
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-light top-nav-header">
    <div class="container">
        <!-- Left Side (Logo) -->
        <x-application-logo />

        <!-- Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Collapsible Section -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                @if (!Auth::id())
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('host.register') }}">Become a host</a>                          
                </li>
                {{-- <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('user.register') }}">Sign Up</a>
                </li> --}}
            @endif
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav">
                @if (Auth::check() && Auth::user()->role == 'user')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('dashboard') }}">My Dashboard</a>
                    </li>
                @elseif (Auth::check() && Auth::user()->role == 'host')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('host.dashboard') }}">My Dashboard</a>
                    </li>
                @elseif (Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">My Dashboard</a>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('login') }}">Account</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


    {{ $slot }}

    <footer class="mt-5 text-white pt-5 footer-add-content">
        <!-- Top Section: Links and Social Icons -->
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Column 1: Company Information -->
                <div class="col-12 col-md-6 mb-4">
                    <h5 class="text-uppercase font-weight-bold"><x-application-logo /></h5>
                    <p class="small">iKORO is one-on-one interactive on-demand live video hailing application.
                        Enjoy culture, people, see places, and make that long trip from the
                        comfort of your home or office.
                    </p>
                    <div class="become-host-footer">
                      <a class="nav-link" href="https://votivelaravel.in/ikoro/host-register">Become a host</a>
                    </div>

                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-12 col-md-3 mb-4">
                    <h5 class="text-uppercase font-weight-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li>
                            @if (Auth::check())
                                <a href="{{ route('ikoro.support') }}"
                                    class="text-white text-decoration-none">Support</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white text-decoration-none">Support</a>
                            @endif
                        </li>
                        <li><a href="{{ route('aboutUs') }}" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Blog <br> <small></small></a></li>
                        <li><a href="#" class="text-white text-decoration-none">Announcements <br> <small></small>
                            </a></li>
                        <li><a href="{{ route('FAQ') }}" class="text-white text-decoration-none">FAQs</a></li>
                        <li><a href="{{ route('termAndCondition') }}" class="text-white text-decoration-none">Terms &
                                Conditions</a></li>
                        <li><a href="{{ route('privacyPolicy') }}" class="text-white text-decoration-none">Privacy
                                Policy</a></li>
                        <li><a href="{{ route('cookiePolicy') }}" class="text-white text-decoration-none">Cookie
                                Policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none d-none">Complaints Policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none d-none">Safeguarding Policy</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Us -->
                <div class="col-12 col-md-3 mb-4">
                    <h5 class="text-uppercase font-weight-bold">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-envelope"></i> <a href="mailto:support@ikoro.ng"
                                style="color: white;">mail@ikoro.co</a></li>
                    </ul>
                        <div class="social-icon d-flex justify-content-center gap-3">
                        <a href="https://www.facebook.com/ikoroHQ" target="_blank" class="text-white"
                            aria-label="Facebook"><i class="fa-brands fa-facebook fa-lg"></i></a>
                        <a href="https://x.com/ikoroHq" target="_blank" class="text-white" aria-label="Twitter"><i
                                class="fa-brands fa-twitter fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Section: Newsletter Subscription -->


        <!-- Bottom Section: Copyright -->
        <div class="py-2">
            <div class="container text-center">
                <p class="mb-0 small">©<?= date('Y') ?> iKORO INC. (iKORO.co). Business office; 30 N Gould St Ste 100
                    Sheridan, WY 82801 U.S.A.</p>
                <p class="mb-0 small terms-policy">
                    <a href="{{ route('termAndCondition') }}" class="text-white text-decoration-none">Terms</a> |
                    <a href="{{ route('FAQ') }}" class="text-white text-decoration-none">Sitemap</a> |
                    <a href="{{ route('privacyPolicy') }}" class="text-white text-decoration-none">Privacy</a>
                </p>
            </div>
        </div>
    </footer>

<!--     <div class="border-bottom border-light mt-4"></div>
 -->
    @stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- Full jQuery version -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ::::::::: select2 js :::::::::: -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('backend/admin/assets/js/get-locations.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/Custom/home.js') }}"></script>

    <script src="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.js') }}"></script>

</body>

</html>
