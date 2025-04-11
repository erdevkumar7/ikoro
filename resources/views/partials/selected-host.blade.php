<div>
    @if ($host_profile)
        <div class="host-main-profile">
            <h1>Host main profile/booking page</h1>
            <div class="booking-page">
                <div class="row booking-mark-sdv">
                    <div class="col-md-3 select-service-left">
                        @if ($host_profile->image)
                            <img class="img-fluid" src="{{ asset('public/' . $host_profile->image) }}"
                                alt="" />
                        @else
                            <img class="img-fluid" src="{{ asset('frontend/images/host.jpg') }}" alt="" />
                        @endif
                    </div>

                    <div class="col-md-7 select-service-right">
                        <h1>{{ $host_profile->name }}</h1>
                        <div class="select-a-service">
                            <h3>Select a Service /</h3>
                            @if ($host_profile->gigs->isNotEmpty())
                                @foreach ($host_profile->gigs->unique('task_id') as $gig)
                                    <div class="host-booking-inner">
                                        <label for="city-tours-checkbox">
                                            <i class="fa-solid fa-city"></i>
                                            <p>{{ $gig->task->title }}</p>
                                        </label>
                                        <input type="checkbox" id="city-tours-checkbox" />
                                    </div>
                                @endforeach
                            @else
                                <div class="host-booking-inner">
                                    <label for="city-tours-checkbox">
                                        <i class="fa-solid fa-city"></i>
                                        <p>No gigs available.</p>
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="select-a-tool">
                            <h3>Select Tools /</h3>
                            @if ($host_profile->gigs->isNotEmpty())
                                @foreach ($host_profile->gigs->unique('equipment_id') as $gig)
                                    <div class="select-booking-inner">
                                        <label for="city-tours-checkbox">
                                            <p>{{ $gig->equipmentPrice->equipment->name }}</p>
                                        </label>
                                        <input type="checkbox" id="city-tours-checkbox" />
                                    </div>
                                @endforeach
                            @else
                                <div class="select-booking-inner">
                                    <label for="city-tours-checkbox">
                                        <p>No tools available</p>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-2 available-time">
                        <p>Available Hours form 10.30am to 06.30pm</p>
                    </div>

                    <div class="biography-sec">
                        <h4>Biography</h4>
                        <p>Lorem ipsum is typically a corrupted version of De finibus bonorum et
                            malorum, a
                            1st-century BC text by the Roman statesman and philosopher Cicero.</p>
                        <h3>Languages</h3>
                        <a href="#" class="eng-text">English</a>
                        <h2>Location</h2>
                        @if ($host_profile->gigs->isNotEmpty())
                            @foreach ($host_profile->gigs->unique('city_id') as $gig)
                                <h1>{{ $gig->city->name }}</h1>
                            @endforeach
                        @else
                            <h1>N/A</h1>
                        @endif
                        <a href="#" class="book-now-btn">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="lists-maximum-offers">
                <div class="container">
                    <h1 class="text-white text-center">My Offers</h1>
                    <div class="row maximum-offers-service">
                        <div class="col-md-4">
                            <p>Hill View Mountains Has Monkeys</p>
                            <img src="https://votivelaravel.in/ikoro/public/uploads/host/snowy-winter.jpeg" />
                            <i class="fa-solid fa-heart"></i>
                        </div>
                        <div class="col-md-4">
                            <p>Lakeside Forest With Lions</p>
                            <img src="https://votivelaravel.in/ikoro/public/uploads/host/pexels-photo-1658967.jpeg" />
                            <i class="fa-solid fa-heart"></i>
                        </div>

                        <div class="col-md-4">
                            <p>Achia Forest Beautiful Sites</p>
                            <img src="https://votivelaravel.in/ikoro/public/uploads/host/snowy-winter.jpeg" />
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container select-duration">
            <div class="row select-duration-inner">
                <div class="col-md-8 select-duration-left">
                    <button class="accordion">
                        <div class="accordion-list">
                            <p class="number-list">1</p>
                            <span>Select Duration</span>
                        </div>
                        <div class="angle-icons">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </button>
                    <div class="panel time-zone-sct">
                        <ul>
                            <li class="time-zone-mark">30 Mins: <span>$40</span></li>
                            <li class="time-zone-mark">60 Mins: <span>$60</span></li>
                            <li>90 Minutes: <span>$90</span></li>
                            <li>120 Minutes: <span>$120</span></li>
                        </ul>
                    </div>

                    <button class="accordion">
                        <div class="accordion-list">
                            <p class="number-list">2</p>
                            <span>Select Date & Time*</span>
                        </div>
                        <div class="angle-icons">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </button>
                    <div class="panel time-zone-sct">
                        <ul>
                            <li class="time-zone-mark">30 Mins: <span>$40</span></li>
                            <li class="time-zone-mark">60 Mins: <span>$60</span></li>
                            <li>90 Minutes: <span>$90</span></li>
                            <li>120 Minutes: <span>$120</span></li>
                        </ul>
                    </div>

                    <button class="accordion">
                        <div class="accordion-list">
                            <p class="number-list">3</p>
                            <span>Notes for the Host</span>
                        </div>
                        <div class="angle-icons">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </button>
                    <div class="panel time-zone-sct">
                        <ul>
                            <li>30 Mins: <span>$40</span></li>
                            <li class="time-zone-mark">60 Mins: <span>$60</span></li>
                            <li>90 Minutes: <span>$90</span></li>
                            <li>120 Minutes: <span>$120</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 select-duration-right">
                    <div class="music-audio">
                        @if ($host_profile->image)
                            <img src="{{ asset('public/' . $host_profile->image) }}" alt="" />
                        @else
                            <img src="{{ asset('frontend/images/host.jpg') }}" alt="" />
                        @endif
                        <div class="music-list-text">
                            <h5>{{ $host_profile->name }}</h5>
                            <p>Music & Audio</p>
                            <p>Production</p>
                        </div>
                        <div class="rating-review-point">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <p>(3)</p>
                        </div>
                    </div>
                    <div class="duration-text">
                        <div class="duration-first">
                            <p>Duration</p>
                            <p>Amount Payable</p>
                        </div>
                        <div class="duration-second">
                            <p>Not Selected</p>
                            <p>-</p>
                        </div>

                    </div>
                    <div class="Proceed-to-checkout go-to-checkout">
                        <a href="#">PROCEED TO CHECKOUT<i class="fa fa-credit-card" aria-hidden="true"></i>
                        </a>
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
