<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyZrQ3kL3MZq5NfX5KFWPi7n6ghB0C2kQf" crossorigin="anonymous">
        </script>
    @endpush

    <style>
        .host-profile-by-id .host-main-profile {
            padding-top: 0px;
            padding-bottom: 40px;
            padding-left: 0px;
            padding-right: 0px;
        }

        .booking-select-add {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 8px;
            border-radius: 10px;
            background-color: #2a7d76;
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
            gap: 8px;
            padding: 8px;
            background-color: #2a7d76;
            border-radius: 8px;
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
            color: #fff;
            flex-shrink: 0;
            padding-right: 0;
            margin: initial;
            background-color: #2a7d76;
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
            padding-top: 15px;
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
                padding-bottom: 2px;
                padding: 6px;
                padding-bottom: 1px;
            }

            .booking-select-add {
                display: block;
                width: 92%;
                margin: auto;
                margin-top: 15px;
                padding-bottom: 8px;
                padding: 6px !important;
                padding-bottom: 2px !important;
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
                margin-bottom: 5px;
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
                padding-bottom: 5px;
                text-align: center;
            }

            .biography-sec h2 {
                padding-top: 5px;
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
                                    {{ isset($host_profile->$today_is_chk_open) && $host_profile->$today_is_chk_open == 1 ? '' : '' }}
                                    {!! isset($host_profile->$today_is_open) && $host_profile->$today_is_open == 1
                                        ? 'Online <i class="fas fa-circle" style="color: green;"></i>'
                                        : 'Offline <i class="fas fa-circle" style="color: red;"></i>' !!}
                                </p>
                            </div>

                            <div class="select-a-service">
                                <h3>Select a Service </h3>
                                <div class="host-select-add">
                                    @if ($host_profile->gigs->isNotEmpty())
                                        @foreach ($host_profile->gigs->unique('task_id') as $gig)
                                            <div class="host-booking-inner">
                                                <label for="task-checkbox-{{ $gig->task->id }}">
                                                    <i class="{{ $gig->task->icon }}"></i>
                                                    <p>{{ $gig->task->title }}</p>
                                                </label>
                                                <input type="checkbox" class="task-checkbox" name="task"
                                                    data-task-id="{{ $gig->task->id }}"
                                                    id="task-checkbox-{{ $gig->task->id }}"
                                                    value="{{ $gig->task->id }}" />
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="host-booking-inner">
                                            <label for="city-tours-checkbox">
                                                <i class="fa-solid fa-city"></i>
                                                <p>No Sevice available.</p>
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="select-a-tool" style="display: none;">
                                <h3>Select Tools </h3>
                                <div class="booking-select-add">
                                    @foreach ($host_profile->gigs as $gig)
                                        <div class="select-booking-inner equipment-item"
                                            data-task-id="{{ $gig->task_id }}" style="display: none;">
                                            <label for="equipment-checkbox-{{ $gig->id }}">
                                                <p>{{ $gig->equipment_name}}</p>
                                                <input type="checkbox" class="equipment-checkbox"
                                                    id="equipment-checkbox-{{ $gig->id }}"
                                                    value="{{ $gig->id }}" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- <div class="biography-right-content" style="display: none;">
                                <div class="lists-maximum-offers">
                                    <div class="container">
                                        <h1 class="text-white text-center">My Offers</h1>
                                        <div class="row maximum-offers-service all-media">
                                            @foreach ($host_profile->gigs as $gig)
                                                @foreach ($gig->features as $feature)
                                                    <div class="col-md-4 gig-box">
                                                        <p class="my-offer-text">
                                                            {{ Str::limit($feature->label, 25) }}</p>
                                                        <img src="{{ asset('/' . $feature->value) }}"
                                                            alt="{{ $feature->name }}" />
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div id="features-section" class="biography-right-content" style="display: none;">
                                <div class="lists-maximum-offers">
                                    <div class="container">
                                        <h1 class="text-white text-center">My Offers</h1>
                                        <div class="row maximum-offers-service all-media" id="features-container">
                                            @foreach ($host_profile->gigs as $gig)
                                                @foreach ($gig->features as $feature)
                                                    <div class="col-md-4 gig-box" data-task-id="{{ $gig->task_id }}">
                                                        <p class="my-offer-text">{{ Str::limit($feature->label, 25) }}
                                                        </p>
                                                        <img src="{{ asset('/' . $feature->value) }}"
                                                            alt="{{ $feature->name }}" />
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="booking0now-btn">
                                <button id="booking-button" disabled class="book-now-btn continue-booking">Book
                                    Now</button>
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

    <script>
        let selectedGigId = null;

        // Only one task selectable
        $(document).on('change', '.task-checkbox', function() {
            $('.task-checkbox').not(this).prop('checked', false);

            const taskId = $(this).val();

            if ($(this).is(':checked')) {
                // Show tools
                $('.select-a-tool').show();
                $('.equipment-item').hide();
                $('.equipment-checkbox').prop('checked', false);
                $('#booking-button').prop('disabled', true).removeClass('active-booking-btn');
                selectedGigId = null;
                $(`.equipment-item[data-task-id="${taskId}"]`).show();

                // Show features
                $('#features-container .gig-box').hide(); // hide all first
                const relatedFeatures = $(`#features-container .gig-box[data-task-id="${taskId}"]`);
                if (relatedFeatures.length > 0) {
                    $('#features-section').show();
                    relatedFeatures.show();
                } else {
                    $('#features-section').hide();
                }

            } else {
                // Hide all if unselected
                $('.select-a-tool').hide();
                $('.equipment-item').hide();
                $('.equipment-checkbox').prop('checked', false);
                $('#booking-button').prop('disabled', true).removeClass('active-booking-btn');
                selectedGigId = null;

                $('#features-section').hide(); // also hide features
            }
        });

        // Only one equipment selectable + enable booking button
        $(document).on('change', '.equipment-checkbox', function() {
            $('.equipment-checkbox').not(this).prop('checked', false);

            if ($(this).is(':checked')) {
                selectedGigId = $(this).val();
                $('#booking-button')
                    .prop('disabled', false)
                    .addClass('active-booking-btn');
            } else {
                selectedGigId = null;
                $('#booking-button')
                    .prop('disabled', true)
                    .removeClass('active-booking-btn');
            }
        });

        // Redirect on button click
        $('#booking-button').on('click', function() {
            if (selectedGigId) {
                window.location.href = `/ikoro/booking/gig-id-${selectedGigId}/detail`;
            }
        });
    </script>


</x-guest-layout>
