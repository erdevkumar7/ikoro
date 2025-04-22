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
    <style>
        .dot {
            color: rgb(169 240 5);
            font-size: 40px;
            margin-top: 0px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Left Side (Logo) -->
            <x-application-logo />
            <button style="margin-right: 15px;" class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                {{-- <span class="navbar-toggler-icon"></span> --}}
                <i class="fa-solid fa-ellipsis dot"></i>
            </button>


            <!-- Collapse section -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <!-- Middle (Login and Sign Up) -->
                    @if (!Auth::id())
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('host.register') }}">BECOME A HOST</a>                          
                        </li>
                        {{-- <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('user.register') }}">Sign Up</a>
                        </li> --}}
                    @endif
                </ul>
                <!-- Right Side (Become a Host) -->
                <ul class="navbar-nav">
                    @if (@Auth::user()->role == 'user')
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('dashboard') }}">My Dashboard</a>
                        </li>
                    @elseif(@Auth::user()->role == 'host')
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('host.dashboard') }}">My Dashboard</a>
                        </li>
                    @elseif(@Auth::user()->role == 'admin')
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">My Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('login') }}">Account</a>
                        </li>
                    @endif

                    <!-- Dashboard in the collapse for small screen -->

                </ul>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="mt-5 text-white pt-5">
        <!-- Top Section: Links and Social Icons -->
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Column 1: Company Information -->
                <div class="col-12 col-md-4 mb-4">
                    <h5 class="text-uppercase font-weight-bold"><x-application-logo /></h5>
                    <p class="small">iKORO is one-on-one interactive on-demand live video hailing application.
                        Enjoy culture, people, see places, and make that long trip from the
                        comfort of your home or office.
                    </p>
                    <div class="social-icon d-flex justify-content-center gap-3">
                        <a href="https://www.facebook.com/ikoroHQ" target="_blank" class="text-white"
                            aria-label="Facebook"><i class="fa-brands fa-facebook fa-lg"></i></a>
                        <a href="https://x.com/ikoroHq" target="_blank" class="text-white" aria-label="Twitter"><i
                                class="fa-brands fa-twitter fa-lg"></i></a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-12 col-md-4 mb-4">
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
                <div class="col-12 col-md-4 mb-4">
                    <h5 class="text-uppercase font-weight-bold">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-envelope"></i> <a href="mailto:support@ikoro.ng"
                                style="color: white;">mail@ikoro.co</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Middle Section: Newsletter Subscription -->
        <div class="py-3 subscribe-news">
            <div class="container text-center">
                <h5 class="mb-3">Subscribe to Our Newsletter</h5>
                <form class="d-flex justify-content-center align-items-center gap-2 subscribe-news-input">
                    <input type="email" class="form-control w-50" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Bottom Section: Copyright -->
        <div class="py-2">
            <div class="container text-center">
                <p class="mb-0 small">©<?= date('Y') ?> iKORO INC. (iKORO.co). Business office; 30 N Gould St Ste 100
                    Sheridan, WY 82801 U.S.A.</p>
                <p class="mb-0 small">
                    <a href="{{ route('termAndCondition') }}" class="text-white text-decoration-none">Terms</a> |
                    <a href="{{ route('FAQ') }}" class="text-white text-decoration-none">Sitemap</a> |
                    <a href="{{ route('privacyPolicy') }}" class="text-white text-decoration-none">Privacy</a>
                </p>
            </div>
        </div>
    </footer>

    <div class="border-bottom border-light mt-4"></div>

    @stack('scripts')
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
