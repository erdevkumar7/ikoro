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
                                    <a href="{{ route('get.host.profile', $host->id) }}">
                                        <div class="img-area">
                                            {{-- <img alt="" class="img-fluid" src="https://votivelaravel.in/ikoro/frontend/images/host.jpg" /> --}}
                                            @if ($host->image)
                                                <img class="img-fluid" src="{{ asset('public/' . $host->image) }}"
                                                    alt="{{ $host->name }}" />
                                            @else
                                                <img class="img-fluid" src="{{ asset('frontend/images/host.jpg') }}"
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
                                    </a>
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

        {{-- <div id="selected-host-profile">
        @include('partials.selected-host', ['host_profile' => $host_profile])
      </div> --}}


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
                                        I was scouting to buy a property in Lagos. Flying from Kano to Lagos for
                                        inspection
                                        was a huge problem until I got introduced to iKORO. With iKORO, I
                                        inspected a lot of
                                        properties and finally made a
                                        successful purchase. I think they are Uber for interactive live videos.
                                    </p>
                                </div>

                                <div class="testimonial-name">Ahmed Yusuf.</div>

                                <div class="testimonial-name">Kano.</div>
                            </div>

                            <div class="item">
                                <div class="shadow-effect">
                                    <p>Developing a property in Asaba from the United States was easy. I used
                                        iKORO to
                                        monitor live progress of the project. It felt like I was present on site
                                        always.</p>
                                </div>

                                <div class="testimonial-name">Jonathan Osadebe.</div>

                                <div class="testimonial-name">Houston Texas.</div>
                            </div>

                            <div class="item">
                                <div class="shadow-effect">
                                    <p>iKORO made my house hunting in Abuja seamless. From the streets to
                                        markets and every
                                        corner of the apartment I inspected them via iKORO interactive virtual
                                        live video.
                                    </p>
                                </div>

                                <div class="testimonial-name">Helen Uzor.</div>

                                <div class="testimonial-name">Abuja.</div>
                            </div>

                            <div class="item">
                                <div class="shadow-effect">
                                    <p>
                                        I was going to travel from London to Nigeria for a meeting. The cost was
                                        discouraging until someone referred me to iKORO. iKORO connected me to
                                        the meeting
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
    </div>
@endsection
