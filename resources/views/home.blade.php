@extends('layouts.home-layout')
@section('page_conent')
    <div>
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
                                {{-- <div class="single-box select-host-click" data-id="{{ $host->id }}"
                                data-url="{{ route('get.selectedhost') }}"> --}}
                                <div class="single-box">
                                    <div class="img-area">
                                        {{-- <img alt="" class="img-fluid" src="https://votivelaravel.in/ikoro/frontend/images/host.jpg" /> --}}
                                        @if ($host->image)
                                            <img class="img-fluid" src="{{ asset('public/' . $host->image) }}"
                                                alt="{{ $host->name }}" />
                                        @else
                                            <img class="img-fluid" src="{{ asset('frontend/images/host.jpg') }}"
                                                alt="" />
                                        @endif
                                        <div class="star-count">
                                            <a href="{{ route('get.host.profile', $host->id) }}">View More</a>
                                        </div>
                                    </div>
                                    <div class="detils-inner">
                                        <p> <i class="fa fa-user" aria-hidden="true"></i>
                                            Hosted by: {{ $host->name }}
                                        </p>
                                        @php
                                            $firstValidGig = $host->gigs->first();
                                            // $uniqueCities = $host->gigs
                                            //     ->unique('city_id')
                                            //     ->pluck('city.name')
                                            //     ->filter()
                                            //     ->first();
                                        @endphp

                                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            @if ($firstValidGig)
                                                {{ $firstValidGig->city->name ?? 'N/A' }},
                                                {{ $firstValidGig->city->state->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                        {{-- <p><i class="fa fa-cogs" aria-hidden="true"></i>
                                            @if ($firstValidGig)
                                                {{ $firstValidGig->task->title }}
                                            @else
                                                N/A
                                            @endif
                                        </p> --}}

                                        <p> <i class="fa fa-camera-retro" aria-hidden="true"></i>
                                            @if ($firstValidGig)
                                                {{ $firstValidGig->equipment_name }}
                                            @else
                                                N/A
                                            @endif
                                        </p>

                                        <p> <i class="fa fa-money" aria-hidden="true"></i>
                                            @if ($firstValidGig)
                                                From ${{ $firstValidGig->price30min }} Per 30 minutes
                                            @else
                                                N/A
                                            @endif
                                        </p>

                                        <p class="rating-review-point">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
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
                    loop: false,
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
                            items: 3,
                        },
                        1920: {
                            items: 3,
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

        {{-- <div id="selected-host-profile">
        @include('partials.selected-host', ['host_profile' => $host_profile])
      </div> --}}


        <div class="container how-it-work">
            <h1 class="text-center text-white">How it work</h1>
            <div class="row work-destination">
                <div class="col-md-3 how-work-one">
                    <div class="column">
                        <div class="card"> <i class="fa-solid fa-city"></i>
                            <h3>Chose a destination (Eg) Dakar Senegal.</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 how-work-one">
                    <div class="column">
                        <div class="card"><i class="fa-solid fa-gears"></i>
                            <h3>Chose your preferred host gender. (Male, Female or Any gender).</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 how-work-two">
                    <div class="column">
                        <div class="card"> <i class="fa-solid fa-dollar-sign"></i>
                            <h3>Select a task, date, and time convenient for you. Remember to make payment to complete your
                                schedule.</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 how-work-three">
                    <div class="column">
                        <div class="card"> <i class="fa fa-check"></i>
                            <h3>Relax and enjoy 1on1 interactive live video tour of your destination.</h3>
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


        <div class="new-testimonials-develop">
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
                                            I live in Australia, and developing a property in Nigeria was easy. I used iKORO
                                            to monitor
                                            progress of the project until it was completed.
                                        </p>
                                    </div>
                                    <div class="testimonial-name">Obinna Onyema.</div>
                                    <div class="testimonial-location-add">Sydney Australia.</div>
                                </div>

                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>I often miss home, the culture, ceremonies, city view, and my city attractions
                                            since I relocated abroad. I longer miss those beautiful memories in Nigeria. I
                                            use iKORO to enjoy them anytime I want.
                                        </p>
                                    </div>
                                    <div class="testimonial-name">Brenda.</div>

                                    <div class="testimonial-location-add">New York.</div>
                                </div>

                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>iKORO saved me from a heartbreak. My online partner gave me an address, I used
                                            iKORO to pay
                                            him a surprise visit with flowers, and it turned out to be a fake address.
                                        </p>
                                    </div>

                                    <div class="testimonial-name">Felicia Jason.</div>

                                    <div class="testimonial-location-add">California.</div>
                                </div>

                                {{-- <div class="item">
                                    <div class="shadow-effect">
                                        <p>
                                            I was going to travel from London to Nigeria for a meeting. The cost was
                                            discouraging until someone referred me to iKORO. iKORO connected me to the
                                            meeting
                                            and it was interactive for me. I give them 5
                                            stars for this innovation.
                                        </p>
                                    </div>

                                    <div class="testimonial-name">Fred Wood.</div>

                                    <div class="testimonial-location-add">London.</div>
                                </div> --}}

                                <!--END OF TESTIMONIAL 1 -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="popular-location">
            <div class="container">
                <h1>Popular Location</h1>
                <div class="row popular-location-inner">
                    <div class="col-md-3 popular-location-col">
                        <div class="image-wrapper">
                            <img src="/ikoro/frontend/images/lagos-nigeria.jpg" alt="Lagos Nigeria">
                            <div class="image-text">Lagos Nigeria</div>
                        </div>
                    </div>

                    <div class="col-md-3 popular-location-col">
                        <div class="image-wrapper">
                            <img src="/ikoro/frontend/images/abuja-nigeria.jpg" alt="Abuja Nigeria">
                            <div class="image-text">Abuja Nigeria</div>
                        </div>
                    </div>

                    <div class="col-md-3 popular-location-col">
                        <div class="image-wrapper">
                            <img src="/ikoro/frontend/images/accra-ghana.jpg" alt="Accra Ghana">
                            <div class="image-text">Accra Ghana</div>
                        </div>
                    </div>

                    <div class="col-md-3 popular-location-col">
                        <div class="image-wrapper">
                            <img src="/ikoro/frontend/images/cape-town-south.jpg" alt="South Africa">
                            <div class="image-text">South Africa</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="subscribe-our">
            <div class="py-3 subscribe-news">
                <div class="container text-center">
                    <div class="row news-subscribe-inner">
                        <div class="col-md-7 news-subscribe-left">
                            <h5 class="mb-3 new-letters-add">Subscribe to our Newsletter.</h5>
                            <p class="mb-3 new-letters-add">We will use your email to serve you better. Get the latest updates, destinations, and services.</p>
                        </div>
                        <div class="col-md-5 news-subscribe-right">
                            <form class="d-flex justify-content-center align-items-center gap-2 subscribe-news-input">
                                <input type="email" class="form-control w-50" placeholder="Enter your email" required>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
