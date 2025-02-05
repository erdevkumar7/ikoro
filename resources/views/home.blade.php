<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/select-a-task.css') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" /> --}}
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

    <div class="content flex-grow-1">
        <div class="container-fluid bg-3 text-center">
            <span class="text-white"><b>Order, relax, and tour places with iKORO from the comfort of your home /
                    office.</b></span>

            <form id="filter-form">
                <div class="container search-destinations">
                    <!-- Destination Section -->
                    <div class="destination-section">
                        <label for="search-destination">Where</label>
                        <input type="text" name="city_id" id="citySearchByInput" class="search-destination"
                            data-url="{{ route('search.cities') }}" placeholder="Search destinations" required
                            autocomplete="off" />
                        <div id="cityDropdown" class="dropdown-menu"></div>
                    </div>

                    <!-- Service Section -->
                    <div class="service-section">
                        <label for="choose-service">Choose a service</label>
                        <select id="choose-service" name="task_id" class="choose-service">
                            <option value="" {{ old('task_id', request('task_id')) == '' ? 'selected' : '' }}>
                                -- All services --
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
                    <div class="tool-section">
                        <label for="choose-tool">Choose a tool</label>
                        <select name="equipment_id" id="equipment_id" class="choose-tool">
                            <option value=""
                                {{ old('equipment_id', request('equipment_id')) == '' ? 'selected' : '' }}>--All
                                tools--</option>
                            @foreach ($equipment_price_all as $row)
                                <option value="{{ $row->id }}"
                                    {{ old('equipment_id', request('equipment_id')) == $row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gender Section -->
                    <div class="gender-section">
                        <label for="choose-gender">Host gender</label>
                        <select id="gender" name="gender" class="choose-gender">
                            <option value="" {{ old('gender', request('gender')) == '' ? 'selected' : '' }}>
                                --All gender--
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

                    <!-- Search Button -->
                    <div class="search-button">
                        <button type="submit" aria-label="Search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>

            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="container">
                <div class="content flex-grow-1 mb-5 mt-3 meet-top-section-owl">
                    <div class="container-fluid bg-3 text-center">
                        <div class="owl-carousel menu" id="owl-carousel-top"
                            style="display: flex; justify-content: center;">
                            @foreach ($tasks as $task)
                                <div class="owl-css" id="task" data-id="{{ $task->id }}"
                                    data-url="{{ route('filter.gigs') }}" style="cursor: pointer;">
                                    <i class="{{ $task->icon }}"></i> <br />
                                    {{ $task->title }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="gigs-container">
                    @include('partials.gigs-list', ['gigs' => $gigs])
                </div>

                <div class="meet-our-top">
                    <h1 class="text-center mb-4">Meet Our Top Hosts</h1>
                    <section class="testimonial">
                        <div class="container">
                            <div class="row">
                                <div class="clients-carousel owl-carousel">
                                    @foreach ($hosts as $host)
                                        <div class="single-box select-host-click" data-id="{{ $host->id }}"
                                            data-url="{{ route('get.selectedhost') }}">
                                            <div class="img-area">
                                                {{-- <img alt="" class="img-fluid" src="https://votivelaravel.in/ikoro/frontend/images/host.jpg" /> --}}
                                                @if ($host->image)
                                                    <img class="img-fluid"
                                                        src="{{ asset('public/' . $host->image) }}"
                                                        alt="{{ $host->name }}" />
                                                @else
                                                    <img class="img-fluid"
                                                        src="{{ asset('frontend/images/host.jpg') }}"
                                                        alt="" />
                                                @endif
                                            </div>
                                            <div class="detils-inner">
                                                <p>Name: {{ $host->name }}</p>
                                                <p>City:
                                                    @php
                                                        $uniqueCities = $host->gigs
                                                            ->unique('city_id')
                                                            ->pluck('city.name')
                                                            ->filter()
                                                            ->first();
                                                    @endphp

                                                    {{ $uniqueCities ?? 'N/A' }}
                                                </p>
                                                <p>Services offered:
                                                    @if ($host->gigs->isNotEmpty())
                                                        {{ $host->gigs->unique('task_id')->first()->task->title }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>

                                                <p class="rating-review-point">Rating :
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </p>
                                                <p>Tool used:
                                                    @if ($host->gigs->isNotEmpty())
                                                        {{ $host->gigs->unique('equipment_id')->first()->equipmentPrice->equipment->name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
                    <script>
                        $(".clients-carousel").owlCarousel({
                            loop: true,
                            nav: true, // Enable navigation arrows
                            navText: [
                                '<i class="fa fa-chevron-left"></i>', // Left arrow icon
                                '<i class="fa fa-chevron-right"></i>', // Right arrow icon
                            ],
                            dots: true, // Enable dots
                            autoplay: true,
                            autoplayTimeout: 5000,
                            animateOut: "fadeOut",
                            animateIn: "fadeIn",
                            smartSpeed: 450,
                            margin: 30,
                            dotsData: false, // Optional: Use custom dots
                            responsive: {
                                0: {
                                    items: 1,
                                },
                                768: {
                                    items: 2,
                                },
                                991: {
                                    items: 3,
                                },
                                1200: {
                                    items: 4,
                                },
                                1920: {
                                    items: 4,
                                },
                            },
                            onInitialized: function() {
                                // Limit dots to 3
                                let $dots = $(".clients-carousel .owl-dots");
                                $dots.children().slice(3).hide(); // Hide extra dots
                            },
                        });
                    </script>
                </div>

                <div id="selected-host-profile">
                    @include('partials.selected-host', ['host_profile' => $host_profile])
                </div>


                <div class="container how-it-work">
                    <h1 class="text-center text-white">How It Work</h1>
                    <div class="row work-destination">
                        <div class="col-md-4 how-work-one">
                            <p class="text-white">Book a Tour Guide in your Destination</p>
                            <div class="column">
                                <div class="card">
                                    <img src="./frontend/images/find.png">
                                    <h3>Find an expert</h3>
                                    <p>Discover and choose form our list of the world's most in-demand exerts</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 how-work-two">
                            <p class="text-white">Select Date & Time</p>
                            <div class="column">
                                <div class="card">
                                    <img src="./frontend/images/e-book.png">
                                    <h3>Book a video call</h3>
                                    <p>Select a time works for both you and your expert's schedule</p>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 how-work-three">
                            <p class="text-white">Enjoy an Interactive Live Video Session</p>
                            <div class="column">
                                <div class="card">
                                    <img src="./frontend/images/virtual-assistant.png">
                                    <h3>Virtual consultation</h3>
                                    <p>Join the 1-on-1 video call, ask questions, and get expert advice</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <script>
                    var acc = document.getElementsByClassName("accordion");
                    var i;

                    for (i = 0; i < acc.length; i++) {
                        acc[i].addEventListener("click", function() {
                            this.classList.toggle("active");
                            var panel = this.nextElementSibling;
                            if (panel.style.display === "block") {
                                panel.style.display = "none";
                            } else {
                                panel.style.display = "block";
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>

    <!-- TESTIMONIALS -->

    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="nav-link mt-5">Testimonials</h3>

                    <div id="feedback-testimonials" class="owl-carousel">
                        <!--TESTIMONIAL 1 -->

                        <div class="item">
                            <div class="shadow-effect">
                                <p>
                                    I was scouting to buy a property in Lagos. Flying from Kano to Lagos for inspection
                                    was a huge problem until I got introduced to iKORO. With iKORO, I inspected a lot of
                                    properties and finally made a
                                    successful purchase. I think they are Uber for interactive live videos.
                                </p>
                            </div>

                            <div class="testimonial-name">Ahmed Yusuf.</div>

                            <div class="testimonial-name">Kano.</div>
                        </div>

                        <div class="item">
                            <div class="shadow-effect">
                                <p>Developing a property in Asaba from the United States was easy. I used iKORO to
                                    monitor live progress of the project. It felt like I was present on site always.</p>
                            </div>

                            <div class="testimonial-name">Jonathan Osadebe.</div>

                            <div class="testimonial-name">Houston Texas.</div>
                        </div>

                        <div class="item">
                            <div class="shadow-effect">
                                <p>iKORO made my house hunting in Abuja seamless. From the streets to markets and every
                                    corner of the apartment I inspected them via iKORO interactive virtual live video.
                                </p>
                            </div>

                            <div class="testimonial-name">Helen Uzor.</div>

                            <div class="testimonial-name">Abuja.</div>
                        </div>

                        <div class="item">
                            <div class="shadow-effect">
                                <p>
                                    I was going to travel from London to Nigeria for a meeting. The cost was
                                    discouraging until someone referred me to iKORO. iKORO connected me to the meeting
                                    and it was interactive for me. I give them 5
                                    stars for this innovation.
                                </p>
                            </div>

                            <div class="testimonial-name">Fred Wood.</div>

                            <div class="testimonial-name">London.</div>
                        </div>

                        <!--END OF TESTIMONIAL 1 -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->

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
                $('#filter-form').on('submit', function(e) {
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
