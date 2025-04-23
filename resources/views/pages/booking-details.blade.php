<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
    @endpush

    <style>
        .booking-login-add .modal-dialog {
            margin-top: 94px;
        }

        .booking-login-add .modal-content {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0;
            background: #2a7d76 !important;
            border: 2px solid #2a7d76;
            color: rgb(255, 255, 255);
            border-radius: 10px;
        }

        .booking-login-add button.btn.btn-block.login-button.ms-3 {
            height: 48px;
            background-color: #000;
            margin-top: 10px;
            box-shadow: none;
            border-radius: 100px;
            color: #fff;
        }

        .booking-login-add button.btn.btn-block.login-button.ms-3:hover {
            background: #fff;
            color: #000;
            border: #dee2e6 !important;
        }

        .booking-login-add input.search-from {
            height: 40px;
            background-color: #fff;
            color: #000;
            border-radius: 50px;
        }
    </style>

    <div class="host-profile-by-id">
        <div class="container host-main-profile">
            <div class="booking-page">
                <div class="row booking-mark-sdv">
                    <div class="container select-duration">
                        <div class="row select-duration-inner">
                            <div class="col-md-8 select-duration-left">
                                <button class="accordion active">
                                    <div class="accordion-list">
                                        <p class="number-list">1</p>
                                        <span>Select Duration</span>
                                    </div>
                                    <div class="angle-icons">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="panel time-zone-sct" style="display: block;"> <!-- open by default -->
                                    <ul>
                                        @foreach ($selectedEquipmentPrices as $price)
                                            <li class="time-zone-mark price-option"
                                                data-duration="{{ $price->duration_minutes }}"
                                                data-price="{{ $price->price }}">
                                                {{ $price->duration_minutes }} Mins:
                                                <span>${{ $price->price }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <button class="accordion disabled">
                                    <div class="accordion-list">
                                        <p class="number-list">2</p>
                                        <span>Select Date & Time</span>
                                    </div>
                                    <div class="angle-icons">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="panel time-zone-sct">
                                    {{-- <input type="date" id="booking-date" min="{{ now()->toDateString() }}">
                                    <div id="time-slots-wrapper" style="margin-top: 10px;"></div> --}}
                                    <button class="slot-btn">Add Slot</button>
                                </div>

                                <button class="accordion disabled">
                                    <div class="accordion-list">
                                        <p class="number-list">3</p>
                                        <span>Notes for the Host</span>
                                    </div>
                                    <div class="angle-icons">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="panel time-zone-sct">
                                    <textarea class="form-control booking-host-expert-note" placeholder="Write your message here."></textarea>
                                </div>
                            </div>

                            <div class="col-md-4 select-duration-right">
                                <div class="music-audio">
                                    @if ($gig->host->image)
                                        <img src="{{ asset('public/' . $gig->host->image) }}" alt="" />
                                    @else
                                        <img src="{{ asset('frontend/images/host.jpg') }}" alt="" />
                                    @endif
                                    <div class="music-list-text">
                                        <h5>{{ $gig->host->name }}</h5>
                                        <p>{{ $gig->task->title }}</p>
                                        <p>Tool: {{ $gig->equipment_name }}</p>
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
                                        <p id="selected-duration">Not Selected</p>
                                        <p id="selected-price">-</p>
                                    </div>

                                </div>
                                <div class="Proceed-to-checkout">
                                    <form action="{{ route('user.strip.payment') }}" method="GET">
                                        <input type="hidden" name="gig_id" id="gig-id"
                                            value="{{ $gig->id }}">
                                        <input type="hidden" name="price" id="selected-gig-price" value="">
                                        <input type="hidden" name="duration" id="selected-gig-duration" value="">

                                        <button type="submit" class="go-to-checkout" id="checkout-btn" disabled>PROCEED
                                            TO CHECKOUT <i class="fa fa-credit-card" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Login Modal -->
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Accordion click behavior
            $(".accordion").click(function() {
                if ($(this).hasClass("disabled")) return; // Prevent click if disabled

                $(".accordion").removeClass("active");
                $(".panel").slideUp();

                $(this).addClass("active");
                $(this).next(".panel").slideDown();
            });

            let selectedDuration = null;
            let selectedPrice = null;

            // Step 1: Duration selection
            $(".price-option").click(function() {
                selectedDuration = $(this).data("duration");
                selectedPrice = $(this).data("price");
                const gigId = "{{ $gig->id }}";
           

                $('#selected-gig-price').val(selectedPrice);
                $('#selected-gig-duration').val(selectedDuration);
                $('#gig-id').val(gigId);

                // Enable and open second accordion
                const secondAccordion = $(".accordion").eq(1);
                const secondPanel = secondAccordion.next(".panel");
                secondAccordion.removeClass("disabled").addClass("active");
                secondPanel.slideDown();

                // Close others
                $(".accordion").not(secondAccordion).removeClass("active");
                $(".panel").not(secondPanel).slideUp();
            });

            // Step 2: Time slot generation (assumes slot buttons already handled)
            $(document).on("click", ".slot-btn", function() {
                const thirdAccordion = $(".accordion").eq(2);
                const checkoutBtn = $("#checkout-btn");
                checkoutBtn.removeAttr("disabled").addClass("active-checkout");

                const thirdPanel = thirdAccordion.next(".panel");
                thirdAccordion.removeClass("disabled").addClass("active");
                thirdPanel.slideDown();

                $(".accordion").not(thirdAccordion).removeClass("active");
                $(".panel").not(thirdPanel).slideUp();
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceOptions = document.querySelectorAll('.price-option');
            const durationDisplay = document.getElementById('selected-duration');
            const priceDisplay = document.getElementById('selected-price');
            // const checkoutBtn = document.getElementById('checkout-btn');

            priceOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all
                    priceOptions.forEach(opt => opt.classList.remove('selected'));

                    // Add selected class
                    this.classList.add('selected');

                    // Update duration and price display
                    const duration = this.getAttribute('data-duration');
                    const price = this.getAttribute('data-price');

                    durationDisplay.textContent = `${duration} Minutes`;
                    priceDisplay.textContent = `$${price}`;

                    // Enable checkout button
                    // checkoutBtn.disabled = false;
                    // checkoutBtn.classList.add('active-checkout');
                });
            });
        });
    </script>




</x-guest-layout>
