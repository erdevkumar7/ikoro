<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush

    <style>
        .host-profile-by-id .host-main-profile {
            padding-top: 15px;
            padding-bottom: 40px;
            padding-left: 0px;
            padding-right: 0px;
        }

        .booking-select-add {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 18px;
            border-radius: 10px;
            background-color: #d2ff9991;
        }

        .host-booking-inner label {
            display: flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            cursor: pointer;
        }

        .select-booking-inner {
            flex: 1 1 calc(50% - 1rem);
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 13px 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .select-booking-inner:hover {
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.1);
        }

        .select-booking-inner label {
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 0.75rem;
        }

        .host-profile-by-id .biography-sec {
            color: #fff;
            text-align: left;
            padding-top: 10px;
        }

        .select-booking-inner input[type="checkbox"] {
            width: 13px;
            height: 13px;
            accent-color: #007bff;
        }

        .select-booking-inner p {
            margin: 0;
            font-weight: 500;
            font-size: 1rem;
            color: #000;
        }

        .booking-select-add .select-booking-inner label {
            margin-bottom: 0;
            display: flex;
            gap: 3px;
            justify-content: space-between;
        }

        .host-select-add {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 18px;
            background-color: #d2ff9991;
            border-radius: 10px;
            justify-content: space-between;
        }

        .host-booking-inner {
            flex: 1 1 calc(50% - 1rem);
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 5px 15px;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            cursor: pointer;
        }

        .host-booking-inner:hover {
            box-shadow: 0 6px 16px rgba(0, 123, 255, 0.1);
        }

        .host-booking-inner label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            cursor: pointer;
        }

        .host-booking-inner i {
            font-size: 1.5rem;
            color: #002502;
            flex-shrink: 0;
            padding-right: 0;
            margin: initial;
            background-color: #77a158;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .host-booking-inner p {
            margin: 0;
            color: #000;
        }

        .host-booking-inner input[type="checkbox"] {
            position: absolute;
            top: 20px;
            right: 1rem;
            width: 13px;
            height: 13px;
            accent-color: #007bff;
            cursor: pointer;
        }

        .maximum-offers-service img {
            width: 100% !important;
            border-radius: 10px;
            height: 280px;
            object-fit: cover;
            margin-bottom: 0;
        }

        .col-md-9.biography-right-content {
            padding: 0;
        }

        .lists-maximum-offers .container {
            padding-right: 0;
        }

        .host-profile-by-id .row.booking-mark-sdv {
            width: 100%;
            margin: auto;
            padding-left: 0px;
            align-items: flex-start;
        }

        .row.booking-mark-sdv {
            align-items: center;
            padding-top: 0px !important;
            padding-bottom: 30px;
            border-radius: 20px;
        }

        .row.maximum-offers-service {
            padding-top: 20px;
            position: relative;
            row-gap: 25px;
        }

        .select-service-left img {
            width: 220px;
            height: 220px;
            border-radius: 100%;
            border: solid 2px #fff;
            object-fit: cover;
            margin-top: 0px !important;
        }

        p.my-offer-text {
            display: flex;
            justify-content: center;
            gap: 8px;
        }


        @media only screen and (max-width: 767px) {
            .host-select-add {
                display: block;
                align-items: center;
                gap: 20px;
                margin: 15px;
                margin-top: 5px;
                padding-top: 5px;
            }

            .booking-select-add {
                display: block;
                width: 92%;
                margin: auto;
                margin-top: 15px;
                padding-bottom: 8px;
            }

            .host-name-text-add p {
                margin-bottom: 0;
                padding-top: 10px;
            }

            .host-profile-by-id .row.booking-mark-sdv {
                width: 100%;
                padding-bottom: 0px;
            }

            .select-booking-inner {
                margin-bottom: 10px;
            }

            .biography-sec h4 {
                text-align: center !important;
                width: 100%;
            }

            .biography-sec p {
                width: 89%;
                margin: auto;
                padding: 0;
                padding-right: 0;
                text-align: center;
            }

            .biography-sec h3 {
                padding-top: 15px;
                padding-bottom: 15px;
                text-align: center;
            }

        }
    </style>

    <div class="host-profile-by-id">
        @if ($host_profile)
            <div class="container host-main-profile">
                <div class="booking-page">
                    <div class="row booking-mark-sdv">
                        <div class="col-md-3 select-service-left">
                            @if ($host_profile->image)
                                <img class="img-fluid" src="{{ asset('public/' . $host_profile->image) }}"
                                    alt="" />
                            @else
                                <img class="img-fluid" src="{{ asset('frontend/images/host.jpg') }}" alt="" />
                            @endif

                            <div class="biography-sec">
                                <h1 class="mobile-view-host-name">{{ $host_profile->name }}</h1>
                                <h4>Biography</h4>
                                @if ($host_profile->biography)
                                    <p>{{ $host_profile->biography }}</p>
                                @else
                                    <p>Lorem ipsum is typically a corrupted version of De finibus bonorum et
                                        malorum, a
                                        1st-century BC text by the Roman statesman and philosopher Cicero.</p>
                                @endif
                                <div class="english-tad-add">
                                    <h3>Languages</h3>
                                    <a href="#" class="eng-text">English</a>
                                </div>
                                <h2>Location</h2>
                                <div class="location-tab-add">
                                    @if ($host_profile->gigs->isNotEmpty())
                                        @foreach ($host_profile->gigs->unique('city_id') as $gig)
                                            <h1>{{ $gig->city->name }}</h1>
                                        @endforeach
                                    @else
                                        <h1>N/A</h1>
                                    @endif
                                </div>
                                {{-- <a href="#" class="book-now-btn">Book Now</a> --}}
                                <button id="booking-button" disabled class="book-now-btn continue-booking">Book
                                    Now</button>
                            </div>

                        </div>

                        <div class="col-md-9 select-service-right">
                            <div class="host-name-text-add">
                                <h1 class="web-view-host-name">{{ $host_profile->name }}</h1>
                                <p>Available Hours
                                    {{ $host_profile->available_hours ? $host_profile->available_hours . ' hr' : 'N/a' }}
                                </p>
                                
                                @php
                                    $today_is_open = strtolower(date('D')) . '_is_open';
                                    $today_is_chk_open = strtolower(date('D')) . '_check';
                                @endphp

                                <p>
                                    Today  
                                    {{ isset($host_profile->$today_is_chk_open) && $host_profile->$today_is_chk_open == 1 ? 'Open' : 'Close' }}

                                    {!! isset($host_profile->$today_is_open) && $host_profile->$today_is_open == 1 
                                        ? 'Online <i class="fas fa-circle" style="color: green;"></i>' 
                                        : 'Offline <i class="fas fa-circle" style="color: red;"></i>' 
                                    !!}
                                </p>
                            </div>

                            <div class="select-a-service">
                                <h3>Select a Service </h3>
                                <div class="host-select-add">
                                    @foreach ($tasks as $task)
                                        <div class="host-booking-inner">
                                            <label for="task-checkbox-{{ $task->id }}">
                                                <i class="{{ $task->icon }}"></i>
                                                <p>{{ $task->title }}</p>
                                            </label>
                                            <input type="checkbox" class="task-checkbox"
                                                id="task-checkbox-{{ $task->id }}" value="{{ $task->id }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="select-a-tool">
                                <h3>Select Tools </h3>
                                <div class="booking-select-add">
                                    @foreach ($equipments as $equipment)
                                        <div class="select-booking-inner">
                                            <label for="equipment-checkbox-{{ $equipment->id }}">
                                                <p>{{ $equipment->name }}</p>
                                                <input type="checkbox" class="equipment-checkbox"
                                                    id="equipment-checkbox-{{ $equipment->id }}"
                                                    value="{{ $equipment->id }}" disabled />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="biography-finibus">
                                <div class="biography-left-content">

                                </div>

                                <div class="biography-right-content">
                                    <div class="lists-maximum-offers">
                                        <div class="container">
                                            <h1 class="text-white text-center">My Offers</h1>
                                            @if ($host_profile->gigs->isNotEmpty())
                                                <div class="row maximum-offers-service all-media">
                                                    @foreach ($host_profile->gigs as $gig)
                                                        <div class="col-md-4 gig-box"
                                                            data-task-id="{{ $gig->task_id }}"
                                                            data-equipments="{{ $gig->equipmentPrice->equipment->id }}">

                                                            <p class="my-offer-text">
                                                                <input type="checkbox" class="gig-select-checkbox"
                                                                    data-gig-id="{{ $gig->id }}" disabled>
                                                                {{ Str::limit($gig->title, 25) }}
                                                            </p>

                                                            @if ($gig->media->count())
                                                                <div id="gigCarousel-{{ $gig->id }}"
                                                                    class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        @foreach ($gig->media as $index => $media)
                                                                            <div
                                                                                class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                <img src="{{ asset('storage/app/public/' . $media->path) }}"
                                                                                    class="d-block w-100"
                                                                                    alt="Gig Image">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    @if ($gig->media->count() > 1)
                                                                        <button class="carousel-control-prev"
                                                                            type="button"
                                                                            data-bs-target="#gigCarousel-{{ $gig->id }}"
                                                                            data-bs-slide="prev">
                                                                            <span
                                                                                class="carousel-control-prev-icon"></span>
                                                                        </button>
                                                                        <button class="carousel-control-next"
                                                                            type="button"
                                                                            data-bs-target="#gigCarousel-{{ $gig->id }}"
                                                                            data-bs-slide="next">
                                                                            <span
                                                                                class="carousel-control-next-icon"></span>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <img
                                                                    src="https://votivelaravel.in/ikoro/public/uploads/host/snowy-winter.jpeg" />
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    <div id="no-gigs-message" style="display: none;"
                                                        class="text-center w-100">
                                                        <p>No offer available for the selected field.</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row maximum-offers-service">
                                                    <div class="col-md-4">
                                                        <p>Hill View Mountains Has Monkeys</p>
                                                        <img
                                                            src="https://votivelaravel.in/ikoro/public/uploads/host/snowy-winter.jpeg" />
                                                        <i class="fa-solid fa-heart"></i>
                                                        <h6 class="guest-fav-text">Guest favorite</h6>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>Lakeside Forest With Lions</p>
                                                        <img
                                                            src="https://votivelaravel.in/ikoro/public/uploads/host/pexels-photo-1658967.jpeg" />
                                                        <i class="fa-solid fa-heart"></i>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <p>Achia Forest Beautiful Sites</p>
                                                        <img
                                                            src="https://votivelaravel.in/ikoro/public/uploads/host/snowy-winter.jpeg" />
                                                        <i class="fa-solid fa-heart"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="host-main-profile">
                <p class="text-white">No recommended hosts found.</p>
            </div>
        @endif
    </div>

    <!-- Login Modal -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".accordion").click(function() {
                // Toggle active class
                $(this).toggleClass("active");

                // Open/close the panel
                var panel = $(this).next(".panel");
                if (panel.css("display") === "block") {
                    panel.slideUp();
                } else {
                    $(".panel").slideUp(); // Close other panels
                    panel.slideDown(); // Open clicked panel
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const taskCheckboxes = document.querySelectorAll('.task-checkbox');
            const equipmentCheckboxes = document.querySelectorAll('.equipment-checkbox');
            const gigCheckboxes = document.querySelectorAll('.gig-select-checkbox');
            const gigs = document.querySelectorAll('.gig-box');
            const noGigsMessage = document.getElementById('no-gigs-message');

            function filterGigs() {
                const selectedTask = Array.from(taskCheckboxes).find(cb => cb.checked);
                //enable Tools(equipment) checkbox
                equipmentCheckboxes.forEach(eq => {
                    eq.disabled = !selectedTask;
                });

                const selectedEquipments = Array.from(equipmentCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                // Enable or disable gig checkboxes based on equipment selection
                const anyEquipmentSelected = selectedEquipments.length > 0;
                gigCheckboxes.forEach(cb => {
                    cb.disabled = !anyEquipmentSelected;
                    if (!anyEquipmentSelected) {
                        cb.checked = false;
                    }
                });

                gigs.forEach(gig => {
                    const gigTaskId = gig.getAttribute('data-task-id');
                    const gigEquipments = gig.getAttribute('data-equipments');
                    console.log(gigEquipments)

                    const matchTask = selectedTask ? gigTaskId === selectedTask.value : true;
                    const matchEquipment = selectedEquipments.length === 0 || selectedEquipments.some(eq =>
                        gigEquipments.includes(eq));

                    if (matchTask && matchEquipment) {
                        gig.style.display = 'block';
                    } else {
                        gig.style.display = 'none';
                    }
                });

                // 🔍 Check if any gigs are visible
                const anyVisible = Array.from(gigs).some(gig => gig.style.display === 'block');
                noGigsMessage.style.display = anyVisible ? 'none' : 'block';
            }

            taskCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Only allow one task checkbox
                    taskCheckboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });

                    // Reset all equipment checkboxes to unchecked and disabled
                    equipmentCheckboxes.forEach(eq => {
                        eq.checked = false;
                        eq.disabled = !this.checked;
                    });
                    filterGigs();
                });
            });

            equipmentCheckboxes.forEach(cb => {
                cb.addEventListener('change', filterGigs);
            });
        });
    </script>

    <!-- script for book now button -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.gig-select-checkbox');
            const bookingButton = document.getElementById('booking-button');
            let selectedGigId = null;

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    // Only allow one gig to be selected
                    checkboxes.forEach(other => {
                        if (other !== this) other.checked = false;
                    });

                    if (this.checked) {
                        selectedGigId = this.dataset.gigId;
                        bookingButton.disabled = false;
                        bookingButton.classList.add('active-booking-btn');
                    } else {
                        selectedGigId = null;
                        bookingButton.disabled = true;
                        bookingButton.classList.remove('active-booking-btn');
                    }
                });
            });

            bookingButton.addEventListener('click', function() {
                if (selectedGigId) {
                    // Redirect to booking page (adjust route as needed)
                    window.location.href = `/ikoro/booking/${selectedGigId}/detail`;
                }
            });
        });
    </script>

</x-guest-layout>
