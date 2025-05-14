<x-guest-layout>
    <style>
        .about-page-content .section-title {
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 20px;
            color: #000;
            font-size: 30px;
        }

        .about-page-content p.paragraph {
            color: #000;
        }

        .about-page-content h4 {
            color: #000;
        }

        .about-page-content .social-icons i {
            color: #222;
        }

        .about-page-content {
            padding-bottom: 25px;
        }

        .host-gimbal2-img {
            width: 400px;
            height: 250px;
        }

        .host-gimbal-img {
            width: 400px;
            height: 300px;
        }

        .service-content {
            margin-top: 40px;
        }

        .service-content img.our-service-img {
            width: 100%;
        }

        .host-gimbal2-img {
            width: 500px;
            height: 300px;
        }

        .host-gimbal-img {
            width: 500px;
            height: 300px;
            margin: 15px 0;
        }
    </style>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/content.css') }}">
    @endpush


    <div class="container about-page-content">
        <!-- Our Mission -->
        <!-- About Us -->
        <div class="about-content">
            <h1 class="section-title">About Us</h1>
            <p class="paragraph">
                Welcome to iKORO. We use simple smart tools to solve complex life challenges!
            </p>
            <img class="host-gimbal2-img" src="{{ asset('/frontend/images/gimbal1.png') }}">
        </div>
        <div class="service-content">
            <img class="our-service-img" src="{{ asset('/frontend/images/ovr-service.png') }}">
            <h4>Property Inspection:</h4>
            <p class="paragraph">
                Whether you&#39;re building, renting, or buying a property from a distance you need iKORO to enjoy
                seamless, thorough and live interactive tour of the property. You can order for live tour of your
                existing
                property in our serving destinations.
            </p>

            <h4>City Tours:</h4>
            <p class="paragraph">
                Have you heard such much about a city? iKORO offers immersive virtual live tours, letting you explore
                landmarks, streets, and
            </p>

            <h4>Meeting/Events:</h4>
            <p class="paragraph">
                Do you have a meeting or event to end? Use iKORO to attend that meeting or event in another city.
                iKORO allows seamless virtual participation, ensuring you never miss important discussions or
                networking opportunities, all from the comfort of your location. Stay connected, informed, and engaged
                effortlessly.
            </p>

            <h4>Surprise Some:</h4>
            <p class="paragraph">
                Surprises are memorable, use iKORO to surprise your loved ones.
            </p>
            <h4>Verify place:</h4>
            <p class="paragraph">
                KYC is the engine of commerce. Ensure you know your customers, intending friends, and
                partners using traditional live interactive video to ask questions.
            </p>
        </div>

        <div class="our-host">
            <h4>Our Hosts:</h4>
            <img class="host-gimbal-img" src="{{ asset('/frontend/images/gimbal2.png') }}">
            <p class="paragraph">Our Hosts are dedicated men, and women who are committed in their locations to serve
                you in
                our listed SERVICES.
                Our hosts are already where you want to be waiting to feed you with what you want to see, and
                where you want to be.</p>
        </div>
    </div>

</x-guest-layout>
