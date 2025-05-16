<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/select-a-task.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.theme.default.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-owl.css?v=0.0001') }}" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
            rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css"
            rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

        <style>
            .select-host-click {
                cursor: pointer;
            }

            div#cityDropdown {
                top: 34% !important;
                left: 21%;
            }

            .custom-card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }

            .card-content {
                display: flex;
                align-items: center;
            }

            .card-content img {
                width: 80px;
                margin-right: 20px;
            }

            .input-group-text {
                background: transparent;
                border: 0px;
                margin-top: -10px;
            }

            .city-icon {
                font-size: 14px;
            }

            .mars-icon {
                font-size: 13px;
            }

            .envelope-icon {
                font-size: 18px;
            }
        </style>
    @endpush

    <!-- Modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog col-md-4">
            <div class="modal-content" style="background: rgb(0, 37, 2);">
                <div class="modal-header">
                    <h5 class="host-modal-title nav-link" id="exampleModalLabel">Login Please</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" id="loggedIn" value="{{ $loggedIn }}" />
                    <div class="modal-body">
                        <div class="form-group">
                            <x-input-label class="text-white" for="username" :value="__('Email')" />
                            <x-text-input type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <x-input-label class="text-white" for="password" :value="__('Password')" />
                            <x-text-input id="password" type="password" name="password" required
                                autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="login-a">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <br />
                        <p class="nav-link">Don't have an account?</p>
                        <a href="{{ route('user.register') }}" class="login-a">SignUp</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="attend-event-add">
        <div class="container">
            <div class="row attend-event-inner">
                <div class="col-md-7 attend-event-left">
                    <h3>Tour the world from the comfort of
                        your home or Office with iKORO.</h3>
                </div>

                <div class="col-md-5 attend-event-right">
                    <img src="./frontend/images/teacher-three.png">
                </div>


            </div>
        </div>
    </div>

    <div class="content flex-grow-1 comfort-your-home">
        <div class="container-fluid bg-3 text-center">
            <!--     <span class="text-white order-text"><b>Order, relax, and tour places with iKORO from the comfort of your home /
                    office.</b></span>
 -->

            {{-- <div class="content flex-grow-1 mb-5 mt-3 meet-top-section-owl">
                <div class="container bg-3 text-center">
                    <div class="owl-carousel menu" id="owl-carousel-top"
                        style="display: flex; justify-content: center;">
                        @foreach ($tasks as $task)
                            <form class="host-new-filter" action="{{ route('filter.host') }}" method="GET">
                                @csrf
                                <button class="filter-submit" type="submit">
                                    <div class="owl-css" id="task" data-id="{{ $task->id }}"
                                        data-url="{{ route('filter.gigs') }}" style="cursor: pointer;">
                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                        <i class="{{ $task->icon }}"></i>
                                        {{ $task->title }}
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div> --}}


            <div class="meet-top-section-owl">
                <div class="container">
                    <div class="row meet-top-section-inner">
                        @foreach ($tasks as $task)
                            <div class="col-sm-2">
                                <div class="card">
                                    <form class="host-new-filter" action="{{ route('filter.host') }}" method="GET">
                                        @csrf
                                        <button class="filter-submit" type="submit">
                                            <div class="card-block" id="task" data-id="{{ $task->id }}"
                                                data-url="{{ route('filter.gigs') }}" style="cursor: pointer;">
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <i class="{{ $task->icon }}"></i>
                                                <p class="card-title">{{ $task->title }}</p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-sm-2">
                            <div class="card">
                                <div class="card-block">
                                    <i class="fa-solid fa-city"></i>
                                    <p class="card-title">City Tours</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-block">
                                    <i class="fa-solid fa-handshake"></i>
                                    <p class="card-title">Meeting/Event</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-block">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                    <p class="card-title">Verify Places</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-block">
                                    <i class="fa-solid fa-face-surprise"></i>
                                    <p class="card-title">Surprise Someone</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>



            <form id="filter-form" action="{{ route('filter.host') }}" method="GET">
                @csrf
                <div class="container search-destinations">
                    <!-- Destination Section -->
                    @php
                        $locationName = '';

                        if (old('location_id') || request('location_id')) {
                            $id = old('location_id', request('location_id'));
                            $type = old('location_type', request('location_type'));

                            if ($type === 'City') {
                                $location = \App\Models\City::find($id);
                            } elseif ($type === 'State') {
                                $location = \App\Models\State::find($id);
                            } elseif ($type === 'Country') {
                                $location = \App\Models\Country::find($id);
                            }

                            if (isset($location)) {
                                $locationName = $location->name . '-' . $type;
                            }
                        }
                    @endphp

                    <div class="mobile-add-destination">
                    <div class="destination-section">
                        <input type="text" name="location_name" id="citySearchByInput" class="search-destination"
                            data-url="{{ route('search.cities') }}" placeholder="Search destinations" required
                            autocomplete="off" value="{{ $locationName }}" />

                        <input type="hidden" name="location_id" id="selectedCityId"
                            value="{{ old('location_id', request('location_id')) }}">
                        <input type="hidden" name="location_type" id="locationType"
                            value="{{ old('location_type', request('location_type')) }}">
                        {{-- <input type="text" name="location" id="locationSearchInput" class="search-destination"
                            data-url="{{ route('search.locations') }}" placeholder="Search destinations" required
                            autocomplete="off" /> --}}
                        <div id="cityDropdown" class="dropdown-menu"></div>

                     <i class="fa fa-location-arrow container location-add" aria-hidden="true"></i>


                    </div>

                    <!-- Service Section -->
                    <div class="service-section">
                        <select id="choose-service" name="task_id" class="choose-service">
                            <option value="" {{ old('task_id', request('task_id')) == '' ? 'selected' : '' }}>
                                Choose a service
                            </option>
                            @foreach ($tasks as $task)
                                <option value="{{ $task['id'] }}"
                                    {{ old('task_id', request('task_id')) == $task['id'] ? 'selected' : '' }}>
                                    {{ $task['title'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Tool Section -->
                     <div class="tool-services-add">
                    <div class="tool-section">
                        {{-- <select name="equipment_id" id="equipment_id" class="choose-tool">
                            <option value=""
                                {{ old('equipment_id', request('equipment_id')) == '' ? 'selected' : '' }}>Choose a
                                tool</option>
                            @foreach ($equipment_price_all as $row)
                                <option value="{{ $row->id }}"
                                    {{ old('equipment_id', request('equipment_id')) == $row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select> --}}

                        <select id="is_open" name="is_open" class="choose-tool">
                            <option value="" {{ old('is_open', request('is_open')) == '' ? 'selected' : '' }}>
                                Every Host
                            </option>
                            <option value="1" {{ old('is_open', request('is_open')) == '1' ? 'selected' : '' }}>
                                Host Online
                            </option>
                        </select>
                    </div>

                    <!-- Gender Section -->
                    <div class="gender-section">
                        <select id="gender" name="gender" class="choose-gender">
                            <option value="" {{ old('gender', request('gender')) == '' ? 'selected' : '' }}>
                                Any Host
                            </option>
                            <option value="male" {{ old('gender', request('gender')) == 'male' ? 'selected' : '' }}>
                                Male
                            </option>
                            <option value="female"
                                {{ old('gender', request('gender')) == 'female' ? 'selected' : '' }}>
                                Female
                            </option>
                        </select>
                    </div>
                    </div>


                  </div>
                    <!-- Search Button -->
                    <div class="search-button">
                        <button type="submit" aria-label="Search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!--      @if (Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif -->

            <div class="container">
                <!--    <div class="content flex-grow-1 mb-5 mt-3 meet-top-section-owl">
                    <div class="container-fluid bg-3 text-center">
                        <div class="owl-carousel menu" id="owl-carousel-top"
                            style="display: flex; justify-content: center;">
                            @foreach ($tasks as $task)
<form class="host-new-filter" action="{{ route('filter.host') }}" method="GET">
                                    @csrf
                                    <button class="filter-submit" type="submit">
                                        <div class="owl-css" id="task" data-id="{{ $task->id }}"
                                            data-url="{{ route('filter.gigs') }}" style="cursor: pointer;">
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            <i class="{{ $task->icon }}"></i><br />
                                            {{ $task->title }}
                                        </div>
                                    </button>
                                </form>
@endforeach
                        </div>
                    </div>
                </div> -->
                <!-- Main Page content -->
                @yield('page_conent')
                <!-- End Main Page content -->
            </div>



        </div>
    </div>

    @push('scripts')
        <script>
            function toggleDescription(gigId) {
                var shortDesc = document.getElementById("short-desc-" + gigId);
                var fullDesc = document.getElementById("full-desc-" + gigId);
                var loadMoreBtn = document.getElementById("load-more-btn-" + gigId);
                if (fullDesc.style.display === "none") {
                    fullDesc.style.display = "inline";
                    loadMoreBtn.innerText = "Show Less";
                } else {
                    fullDesc.style.display = "none";
                    loadMoreBtn.innerText = "Load More";
                }
            }
        </script>

        <script>
            let host = @json($where ?? []);
        </script>

        <script>
            $(document).ready(function() {
                $('#filter-form1').on('submit', function(e) {
                    e.preventDefault(); // Prevent page reload

                    $.ajax({
                        url: "{{ route('filter.gigs') }}",
                        type: "GET",
                        data: $(this).serialize(), // Send form data
                        success: function(response) {
                            $('#gigs-container').html(response.html);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
