<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/select-a-task.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-owl.css?v=0.0001') }}">

        <style>
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
                        <br>
                        <p class="nav-link"> Don't have an account?</p>
                        <a href="{{ route('user.register') }}" class="login-a">SignUp</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content flex-grow-1">
        <div class="container-fluid bg-3 text-center">
            <span class="text-white"><b>Order, relax, and tour places with iKORO from the comfort of your home / office.</b></span>

            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="container">

                <div class="content flex-grow-1 mb-5 mt-3">
                    <div class="container-fluid bg-3 text-center">
                        <div class="owl-carousel menu" id="owl-carousel-top" style="display: flex; justify-content: center;">
                            @foreach ($tasks as $task)
                                <div class="owl-css" id="task" data-id="{{ $task->id }}"
                                    data-url="{{ route('home.task') }}" style="cursor: pointer;">
                                    <i class="{{ $task->icon }}"></i> <br> {{ $task->title }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 col-lg-6 col-sm-12 book-a-task">
                        <form method="post" id="home-booking-form" action="{{ route('booking.store') }}"
                            class="p-3 rounded task-form shadow-lg">
                            <h4 class="font-weight-bold mb-4">Book a Task</h4>
                            @csrf
                            <!-- Task Selection -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                        <select id="task_id" name="task_id" class="form-control" required>
                                            <option value="" disabled selected>Select a task</option>
                                            @foreach ($tasks as $task)
                                                <option value="{{ $task['id'] }}">{{ $task['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Selection -->
                            <input type="hidden" name="country_id" value="{{ $country->id }}">
                            <input type="hidden" name="state_id" value="{{ $state->id }}">

                            <div class="row">
                                <!-- City -->
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-city city-icon"></i></span>
                                        <select id="city_id" name="city_id" class="form-control" required>
                                            <option value="" selected>Select City</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Zip -->
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i
                                                class="fas fa-envelope envelope-icon"></i></span>
                                        <select id="zip_id" name="zip_id" class="form-control" required>
                                            <option value="" disabled selected>Select ZipCode</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Equipment -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-gear"></i></span>
                                        <select name="equipment_id" data-url="{{ route('get_equipment_prices') }}" id="equipment_id" class="form-control">
                                        <option value="">Select Equipment</option>
                                            @foreach ($equipment_price_all as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                                        <select name="hours" id="hours" class="form-control">
                                            <option value="">Select Hours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender and Feedback -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i
                                                class="fa-solid fa-venus-mars mars-icon"></i></span>
                                        <select id="preferred_gender" name="preferred_gender" class="form-control"
                                            required>
                                            <option value="" disabled selected>Preferred Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Operation Time -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="datetime-local" name="operation_time" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Briefing -->

                            <div class="row align-items-center mb-3">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-info"></i></span>
                                        <textarea name="briefing" class="form-control" style="height: 100px; margin-left: 10px;" placeholder="Give us further instructions" required></textarea>
                                    </div>
                                </div>
                            </div>
                            @php
                                $price_str = '';
                                if (
                                    isset($gig['equipmentPrice']['price']) &&
                                    isset($gig['equipmentPrice']['minutes'])
                                ) {
                                    $price_str =
                                        $gig['equipmentPrice']['price'] .
                                        "$ per " .
                                        $gig['equipmentPrice']['minutes'] .
                                        ' minutes';
                                }
                            @endphp
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="{{ asset('frontend/images/nigeria-currency-symbol.png') }}" style="width: 15px; margin-top: 13px;" alt="">
                                        </span>
                                        <input readonly type="text" class="form-control" id="total_cost" name="total_cost" value="0.00" />
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" id="pay-btn" name="action" value="pay" class="btn shadow">Pay Now</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <iframe id="map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15944676.57257612!2d3.324235407115051!3d9.05785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bca3e74d50a1b%3A0xd7755f5954b9088d!2sNigeria!5e0!3m2!1sen!2sin!4v1611287579370!5m2!1sen!2sin"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>

                </div>

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
                                <p>I was scouting to buy a property in Lagos. Flying from Kano to Lagos for inspection was a huge problem until I got introduced to iKORO. With iKORO, 
                                    I inspected a lot of properties and finally made a successful purchase. 
                                    I think they are Uber for interactive live videos.</p>
                            </div>
                            <div class="testimonial-name">Ahmed Yusuf.</div>
                            <div class="testimonial-name">Kano.</div>

                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <p>Developing a property in Asaba from the United States was easy. I used iKORO to monitor live progress 
                                    of the project. It felt like I was present on site always.</p>
                            </div>
                            <div class="testimonial-name">Jonathan Osadebe.</div>
                            <div class="testimonial-name">Houston Texas.</div>
                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <p>iKORO made my house hunting in Abuja seamless. From the streets to markets and every corner of the apartment 
                                    I inspected them via iKORO interactive virtual live video.</p>
                            </div>
                            <div class="testimonial-name">Helen Uzor.</div>
                            <div class="testimonial-name">Abuja.</div>
                        </div>

                        <div class="item">
                            <div class="shadow-effect">
                                <p>I was going to travel from London to Nigeria for a meeting. The cost was discouraging until someone referred 
                                    me to iKORO. iKORO connected me to the meeting and it was interactive for me. I give them 5 stars for this innovation.</p>
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
    <section class="testimonials">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h3 class="nav-link mt-5">Meet Our Star Hosts</h3>
                    <div id="customers-testimonials" class="owl-carousel">
                        <!--TESTIMONIAL 1 -->
                        @foreach ($hosts as $host)
                            <div class="item">
                                <div class="shadow-effect">
                                    @if ($host->image)
                                        <img class="img-circle" src="{{ asset('public/'.$host->image) }}"
                                            alt="{{ $host->name }}">
                                    @else
                                        <img class="img-circle" src="{{ asset('frontend/images/host.jpg') }}"
                                            alt="">
                                    @endif
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-light">
                                            Location: <br>
                                            {{ optional($host->country)->name }} - {{ optional($host->state)->name }} - {{ optional($host->city)->name }} - {{ optional($host->zip)->code }}</li>
                                        <li class="list-group-item list-group-item-light">
                                            Services: <br> 
                                            @foreach ($host->gigs as $gig)
                                            {{ $gig->title }}<br>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <div class="testimonial-name">{{ $host->name }}</div>
                            </div>
                        @endforeach
                        <!--END OF TESTIMONIAL 1 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF TESTIMONIALS -->

    <div class="container container-input-fields">
        <h2 class="ml-5 nav-link">View and Hire Our Host By</h2>
        <input type="hidden" id="filter_flag" value="{{ $where['country_id'] ?? '' }}" />
        <form method="get" action="{{ route('home') }}" id="search-form">
            <div class="row" id="search-filter">
                <!-- Country Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="country_id" class="country_id search-from" required>
                            <option value="" disabled selected>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- State Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="state_id" class="state_id search-from" required>
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>
                </div>
                <!-- City Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="city_id" class="city_id search-from" required>
                            <option value="" disabled selected>Select City</option>
                        </select>
                    </div>
                </div>
                <!-- Zip Code Search -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="zip_id" class="zip_id search-from" required>
                            <option value="" disabled selected>Select Zip</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="col-12 col-sm-2 col-md-1 col-lg-1 mt-3">
                    <button class="btn btn-block" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Reset Button -->
                <div class="col-12 col-sm-2 col-md-1 col-lg-1 mt-3">
                    <a href="{{ route('home') }}">
                        <button type="button" class="btn btn-block">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap container for grid system -->
    <div class="container mt-4">
        <!-- Bootstrap row for creating a horizontal group of columns -->
        <div class="row g-4" id="gigs">
            <!-- Card 1 -->
            @foreach ($gigs as $gig)
                <div class="col-md-4 mt-3">
                    <div class="card custom-card" style="background: rgb(173, 239, 41);">
                        <div class="card-content">
                            <div>
                                <h5 class="card-title">{{ $gig->title }}</h5>
                                <p class="card-text">
                                    <span class="short-description" id="short-desc-{{ $gig->id }}">
                                        {{ Str::limit($gig->description, 70) }}
                                    </span>
                                    <span class="full-description" id="full-desc-{{ $gig->id }}">
                                        {{ $gig->description }}
                                    </span>
                                    <a href="javascript:;" onclick="toggleDescription({{ $gig->id }})"
                                        id="load-more-btn-{{ $gig->id }}">
                                        Load More
                                    </a>
                                </p>
                                <a href="{{ route('home.dashboard.details', $gig->id) }}"
                                    class="btn btn-outline-secondary">Details</a>
                            </div>
                            @if ($gig->media && $gig->media->isNotEmpty())
                                <img class="d-block w-30" src="{{ asset('storage/' . $gig->media->first()->path) }}"
                                    alt="Image">
                            @else
                                <img src="{{ asset('frontend/images/logo.jpg') }}" alt="Image">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    
    @push('scripts')
        <script>
            function toggleDescription(gigId) {
                var shortDesc = document.getElementById('short-desc-' + gigId);
                var fullDesc = document.getElementById('full-desc-' + gigId);
                var loadMoreBtn = document.getElementById('load-more-btn-' + gigId);

                if (fullDesc.style.display === 'none') {
                    fullDesc.style.display = 'inline';
                    loadMoreBtn.innerText = 'Show Less';
                } else {
                    fullDesc.style.display = 'none';
                    loadMoreBtn.innerText = 'Load More';
                }
            }
        </script>
        <script>
            let host = @json($where ?? []);
        </script>
    @endpush
</x-guest-layout>
