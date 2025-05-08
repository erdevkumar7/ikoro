<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/booking-style.css') }}" />
    @endpush
    <div class="host-profile-by-id">
        <div class="container host-main-profile">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if (Session::has('payment_fail'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    });
                </script>
            @endif
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
                                <div class="panel time-zone-sct" style="display: block;">
                                    <!-- open by default -->
                                    <ul>

                                        {{-- @foreach ($selectedEquipmentPrices as $price)
                                            <li class="time-zone-mark price-option"
                                                data-duration="{{ $price->duration_minutes }}"
                                                data-price="{{ $price->price }}">
                                                {{ $price->duration_minutes }} Mins:
                                                <span>${{ $price->price }}</span>
                                            </li>
                                        @endforeach --}}


                                        <li class="time-zone-mark price-option" data-duration="30"
                                            data-price="{{ isset($gig->price30min) ? number_format($gig->price30min, 2) : '' }}">
                                            30 Mins:
                                            ${{ isset($gig->price30min) ? number_format($gig->price30min, 2) : '' }}
                                        </li>
                                        <li class="time-zone-mark price-option" data-duration="60"
                                            data-price="{{ isset($gig->price60min) ? number_format($gig->price60min, 2) : '' }}">
                                            60 Mins:
                                            ${{ isset($gig->price60min) ? number_format($gig->price60min, 2) : '' }}
                                        </li>
                                        <li class="time-zone-mark price-option" data-duration="90"
                                            data-price="{{ isset($gig->price90min) ? number_format($gig->price90min, 2) : '' }}">
                                            90 Mins:
                                            ${{ isset($gig->price90min) ? number_format($gig->price90min, 2) : '' }}
                                        </li>
                                        <li class="time-zone-mark price-option" data-duration="120"
                                            data-price="{{ isset($gig->price120min) ? number_format($gig->price120min, 2) : '' }}">
                                            120 Mins:
                                            ${{ isset($gig->price120min) ? number_format($gig->price120min, 2) : '' }}
                                        </li>
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
                                    {{-- <input type="date" id="booking-date" min="{{ now()->toDateString() }}" />
                                    <div id="time-slots-wrapper" style="margin-top: 10px;"></div>
                                    --}}
                                    <!--                                     <button class="slot-btn">Add Slot</button>
                                      -->
                                    <div class="calendar-date">
                                        <div class="calendar-date-left">
                                            <div class="calendar">
                                                <header class="calendar-header">
                                                    <button onclick="changeMonth(-1)"><i
                                                            class="fa-solid fa-caret-left"></i></button>
                                                    <h2 id="month-year">April 2025</h2>
                                                    <button onclick="changeMonth(1)"><i
                                                            class="fa-solid fa-caret-right"></i></button>
                                                </header>
                                                <div class="days add-day">
                                                    <div class="day">Sun</div>
                                                    <div class="day">Mon</div>
                                                    <div class="day">Tue</div>
                                                    <div class="day">Wed</div>
                                                    <div class="day">Thu</div>
                                                    <div class="day">Fri</div>
                                                    <div class="day">Sat</div>
                                                </div>
                                                <div class="days" id="dates"></div>
                                            </div>


                                        </div>

                                        <div class="calendar-date-right">
                                            <p class="time-date-add">Tue - <span>Apr 25</span></p>
                                            <h4 class="select-time-text">Select Time</h4>
                                            <div class="time-add">
                                                <!--
                                                <button type="button" class="slot-btn btn btn-outline-primary m-1">9:00
                                                    AM</button>
                                                <button type="button"
                                                    class="slot-btn btn btn-outline-primary m-1">11:00 AM</button>
                                                <button type="button" class="slot-btn btn btn-outline-primary m-1">1:00
                                                    PM</button>
                                                <button type="button" class="slot-btn btn btn-outline-primary m-1">3:00
                                                    PM</button>
                                                <button type="button" class="slot-btn btn btn-outline-primary m-1">5:00
                                                    PM</button>
                                                -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="accordion disabled">
                                    <div class="accordion-list">
                                        <p class="number-list">3</p>
                                        <span>Service Feedback Tool</span>
                                    </div>
                                    <div class="angle-icons">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="panel time-zone-sct">
                                    <div class="contact-and-info">
                                        <div class="col-md-6 booking-contatct">
                                            <select class="form-control" id="feedback-tool" name="feedback_tool">
                                                <option value="">Select tool</option>
                                                <option value="whatsapp">WhatsApp</option>
                                                <option value="wechat_id">Wechat Id</option>
                                                <option value="telegram_no">Telegram No</option>
                                                <option value="facebook_live_id">Facebook Live Id</option>
                                                <option value="google_meet_id">Google Meet Id</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 booking-contatct-info">
                                            <input type="text" class="form-control" id="feedback-tool-value"
                                                name="feedback_tool_value">

                                        </div>
                                    </div>
                                </div>

                                <button class="accordion disabled">
                                    <div class="accordion-list">
                                        <p class="number-list">4</p>
                                        <span>Notes for the Host</span>
                                    </div>
                                    <div class="angle-icons">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="panel time-zone-sct">
                                    <textarea id="host-notes" name="host_notes" class="form-control booking-host-expert-note"
                                        placeholder="Write your message here."></textarea>
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
                                    <form id="checkout-form" action="{{ route('user.strip.payment') }}"
                                        method="GET">
                                        <input type="hidden" name="gig_id" id="gig-id"
                                            value="{{ $gig->id }}" />
                                        <input type="hidden" name="price" id="selected-gig-price"
                                            value="" />
                                        <input type="hidden" name="duration" id="selected-gig-duration"
                                            value="" />
                                        <input type="hidden" name="operation_time" id="selected-gig-operation-time"
                                            value="" />
                                        <input type="hidden" name="features_ids" id="selected-features_ids"
                                            value="{{ implode(',', $selectedFeatureIds) }}" />

                                        <button type="submit" class="go-to-checkout" id="checkout-btn"
                                            disabled>PROCEED TO CHECKOUT <i class="fa fa-credit-card"
                                                aria-hidden="true"></i></button>
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
    <div class="modal fade login-booking-add" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog col-md-4">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="host-modal-title nav-link" id="exampleModalLabel">Login Please</h5>
                    <button type="button" id="close-login-model" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" id="loggedIn" value="{{ $loggedIn }}" />
                    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <x-input-label class="text-white" for="username" :value="__('Email')" />
                            <x-text-input type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="Enter Email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <x-input-label class="text-white" for="password" :value="__('Password')" />
                            <x-text-input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="Enter Password" />
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

            const today = new Date();
            displaySelectedDate(today);

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


                $("#selected-gig-price").val(selectedPrice);
                $("#selected-gig-duration").val(selectedDuration);
                $("#gig-id").val(gigId);

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
                const fourthAccordion = $(".accordion").eq(3);
                const checkoutBtn = $("#checkout-btn");
                checkoutBtn.removeAttr("disabled").addClass("active-checkout");

                const thirdPanel = thirdAccordion.next(".panel");
                thirdAccordion.removeClass("disabled").addClass("active");
                thirdPanel.slideDown();

                const fourthPanel = fourthAccordion.next(".panel");
                fourthAccordion.removeClass("disabled").addClass("active");
                fourthPanel.slideDown();

                $(".accordion").not(thirdAccordion).removeClass("active");
                $(".panel").not(thirdPanel).slideUp();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const priceOptions = document.querySelectorAll(".price-option");
            const durationDisplay = document.getElementById("selected-duration");
            const priceDisplay = document.getElementById("selected-price");
            // const checkoutBtn = document.getElementById('checkout-btn');

            priceOptions.forEach((option) => {
                option.addEventListener("click", function() {
                    // Remove active class from all
                    priceOptions.forEach((opt) => opt.classList.remove("selected"));

                    // Add selected class
                    this.classList.add("selected");


                    // Remove all 'time_button_clicked' classes
                    document.querySelectorAll('.time_button_clicked').forEach(el => {
                        el.classList.remove('time_button_clicked');
                    });
                    document.getElementById('checkout-btn').classList.remove('active-checkout');



                    // Update duration and price display
                    const duration = this.getAttribute("data-duration");
                    const price = this.getAttribute("data-price");

                    durationDisplay.textContent = `${duration} Minutes`;
                    priceDisplay.textContent = `$${price}`;

                    // Enable checkout button
                    // checkoutBtn.disabled = false;
                    // checkoutBtn.classList.add('active-checkout');
                });
            });
        });
    </script>

<script>
    $(document).ready(function () {
        // Set this variable from server side
        let isUserLoggedIn = {{ Auth::check() && Auth::user()->role === 'user' ? 'true' : 'false' }};

        $('#checkout-btn').on('click', function (e) {
            e.preventDefault();

            // Disable the button to prevent double clicks
            $(this).prop('disabled', true);

            // Send AJAX request to store booking data in session
            $.ajax({
                url: '{{ route('store.booking.data') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    gig_id: $('#gig-id').val(),
                    price: $('#selected-gig-price').val(),
                    duration: $('#selected-gig-duration').val(),
                    operation_time: $('#selected-gig-operation-time').val(),
                    feature_ids: $('#selected-features_ids').val(),
                    feedback_tool: $('#feedback-tool').val(),
                    feedback_tool_value: $('#feedback-tool-value').val(),
                    host_notes: $('#host-notes').val(),
                },
                success: function () {
                    console.log('Booking session created.');

                    if (!isUserLoggedIn) {
                        $('#loginModal').modal('show');
                    } else {
                        // Submit the form if user is logged in
                        $('#checkout-form').submit();
                    }

                    // Re-enable the button if needed
                    $('#checkout-btn').prop('disabled', false);
                },
                error: function () {
                    alert('Failed to create booking session. Please try again.');
                    $('#checkout-btn').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '#close-login-model', function () {
            $('#loginModal').modal('hide');
        });
    });
</script>

</x-guest-layout>



<script>
    let hasInteracted = false;

    function displaySelectedDate(date) {

        const n_year = date.getFullYear();
        const n_month = String(date.getMonth() + 1).padStart(2, '0'); // getMonth() is 0-based
        const n_day = String(date.getDate()).padStart(2, '0');



        const weekdayStr = date.toLocaleDateString("en-US", {
            weekday: "short"
        });
        const monthStr = date.toLocaleDateString("en-US", {
            month: "short"
        });
        const dayStr = date.getDate();
        const formattedDate = `${weekdayStr} - <span>${monthStr} ${dayStr}</span>`;
        const timeDateAdd = document.querySelector(".time-date-add");
        if (timeDateAdd) {
            timeDateAdd.innerHTML = formattedDate;
        }
    }


    function parseHour(timeStr) {
        const [time, modifier] = timeStr.toLowerCase().split(" ");
        let [hours, minutes] = time.split(":").map(Number);
        if (modifier === "pm" && hours !== 12) hours += 12;
        if (modifier === "am" && hours === 12) hours = 0;
        return hours + minutes / 60;
    }

    function formatTime(decimalHour) {
        let totalMinutes = Math.round(decimalHour * 60);
        let hours = Math.floor(totalMinutes / 60);
        let minutes = totalMinutes % 60;
        let ampm = "am";

        if (hours >= 12) {
            ampm = "pm";
            if (hours > 12) hours -= 12;
        }
        if (hours === 0) hours = 12;

        let minutesStr = minutes < 10 ? "0" + minutes : minutes;
        return `${hours}:${minutesStr} ${ampm}`;
    }

    // Inject open/close times for all days from Blade
    const timeData = {
        sun: {
            open: "{{ $gig->host->sun_open_time }}",
            close: "{{ $gig->host->sun_close_time }}",
        },
        mon: {
            open: "{{ $gig->host->mon_open_time }}",
            close: "{{ $gig->host->mon_close_time }}",
        },
        tue: {
            open: "{{ $gig->host->tue_open_time }}",
            close: "{{ $gig->host->tue_close_time }}",
        },
        wed: {
            open: "{{ $gig->host->wed_open_time }}",
            close: "{{ $gig->host->wed_close_time }}",
        },
        thu: {
            open: "{{ $gig->host->thu_open_time }}",
            close: "{{ $gig->host->thu_close_time }}",
        },
        fri: {
            open: "{{ $gig->host->fri_open_time }}",
            close: "{{ $gig->host->fri_close_time }}",
        },
        sat: {
            open: "{{ $gig->host->sat_open_time }}",
            close: "{{ $gig->host->sat_close_time }}",
        },
    };

    document.addEventListener("click", function(e) {


        // this is for upper click

        if (e.target.classList.contains("time-zone-mark")) {

            // Remove previous "selected" class from all price options
            document.querySelectorAll(".price-option").forEach(el => {
                el.classList.remove("selected");
            });

            // Add "selected" class to the clicked one
            e.target.classList.add("selected");

            const clickedDateElement = document.querySelector(".date.clicked_date");

            if (clickedDateElement) {
                const dayNumber = parseInt(clickedDateElement.textContent.trim());
                const monthYearStr = document.getElementById("month-year").textContent.trim();
                const [monthName, yearStr] = monthYearStr.split(" ");
                const year = parseInt(yearStr);
                const month = new Date(`${monthName} 1, ${year}`).getMonth();
                const clickedDate = new Date(year, month, dayNumber);

                displaySelectedDate(clickedDate); // Reuse your existing function

                const weekdays = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
                const dayName = weekdays[clickedDate.getDay()];

                const selectedOption = document.querySelector(".price-option.selected");

                if (selectedOption) {
                    const duration = parseInt(selectedOption.getAttribute("data-duration")); // in minutes

                    const openTimeStr = timeData[dayName]?.open || "12:00 am";
                    const closeTimeStr = timeData[dayName]?.close || "12:00 am";

                    const startHour = parseHour(openTimeStr);
                    const endHour = parseHour(closeTimeStr);

                    const timeAddContainer = document.querySelector(".time-add");
                    timeAddContainer.innerHTML = ""; // Clear previous buttons


                    let clickedDate1 = new Date(clickedDate);
                    let formattedDate = clickedDate1.getFullYear() + '-' +
                        String(clickedDate1.getMonth() + 1).padStart(2, '0') + '-' +
                        String(clickedDate1.getDate()).padStart(2, '0');




                    for (let time = startHour; time < endHour; time += duration / 60) {
                        const btn = document.createElement("button");
                        btn.type = "button";
                        btn.className = "btn btn-outline-primary m-1 slot-btn";
                        btn.textContent = formatTime(time);






                        var ajaxUrl = "{{ url('/get-matching-bookings') }}";
                        $.ajax({
                            url: ajaxUrl,
                            type: 'GET',
                            async: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                date: formattedDate
                            },
                            success: function(response) {
                                const bookedRanges = [];
                                response.forEach(function(booking) {
                                    const formatted = formatBookingTime(booking
                                        .operation_time, booking.duration);
                                    if (formatted) {
                                        bookedRanges.push(formatted);
                                    }
                                });
                                if (bookedRanges.length > 0) {
                                    //alert(bookedRanges .join('\n'));
                                }
                                var timeToCheck = convertDecimalToTime(time);


                                function isBetween(value, start, end, inclusive = true) {
                                    return inclusive ?
                                        value >= start && value <= end :
                                        value > start && value < end;
                                }

                                function parseTimeToDate(timeStr) {
                                    const today = new Date();
                                    const [time, modifier] = timeStr.split(' ');
                                    let [hours, minutes] = time.split(':').map(Number);

                                    if (modifier.toLowerCase() === 'pm' && hours !== 12) hours +=
                                        12;
                                    if (modifier.toLowerCase() === 'am' && hours === 12) hours = 0;

                                    return new Date(today.getFullYear(), today.getMonth(), today
                                        .getDate(), hours, minutes);
                                }

                                // Convert timeToCheck to a Date
                                const checkTime = parseTimeToDate(timeToCheck);

                                // Check each range
                                let isBooked = false;

                                bookedRanges.forEach(range => {
                                    const [startStr, endStr] = range.split(' to ');
                                    const startTime = parseTimeToDate(startStr.trim());
                                    const endTime = parseTimeToDate(endStr.trim());


                                    var checkTimeDuration = new Date(checkTime);

                                    // Add 120 minutes
                                    checkTimeDuration.setMinutes(checkTime.getMinutes() +
                                        duration);

                                    //if (checkTime >= startTime && checkTime < endTime) {
                                    if (isBetween(checkTime, startTime, endTime)) {

                                        isBooked = true;
                                    }

                                    if (checkTime <= startTime && endTime <=
                                        checkTimeDuration) {
                                        isBooked = true;

                                    }
                                });

                                if (isBooked) {


                                    if (btn.textContent === timeToCheck) {
                                        btn.disabled = true;
                                        btn.classList.add(
                                            "disabled"); // Optional: for visual styling
                                    }


                                } else {
                                    //alert(`${timeToCheck} is available`);
                                }

                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", status, error);
                            }
                        });




                        function formatBookingTime(operationTime, durationMinutes) {
                            const start = new Date(operationTime);
                            const end = new Date(start.getTime() + durationMinutes *
                                60000); // 60000 ms in 1 minute

                            const options = {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            };
                            const startFormatted = start.toLocaleTimeString('en-US', options);
                            const endFormatted = end.toLocaleTimeString('en-US', options);

                            return `${startFormatted} to ${endFormatted}`;
                        }

                        function convertDecimalToTime(decimalTime) {
                            const hours = Math.floor(decimalTime);
                            const minutes = Math.round((decimalTime - hours) * 60);

                            const date = new Date();
                            date.setHours(hours);
                            date.setMinutes(minutes);

                            return date.toLocaleTimeString('en-US', {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            }).toLowerCase();
                        }








                        // Add click event for slot buttons
                        btn.addEventListener("click", function() {
                            document.querySelectorAll(".slot-btn").forEach(b => {
                                b.classList.remove("time_button_clicked");
                            });

                            this.classList.add("time_button_clicked");

                            function convertTo24HourFormat(time12h) {
                                const [timePart, modifier] = time12h.split(' ');
                                let [hours, minutes] = timePart.split(':');
                                if (hours === '12') {
                                    hours = '00';
                                }
                                if (modifier.toLowerCase() === 'pm') {
                                    hours = parseInt(hours, 10) + 12;
                                }
                                return `${String(hours).padStart(2, '0')}:${minutes}`;
                            }

                            let month_plus = String(clickedDate.getMonth() + 1).padStart(2, '0');
                            let time24 = convertTo24HourFormat(this.textContent);

                            let operation_time = `${year}-${month_plus}-${dayNumber}T${time24}`;
                            $('#selected-gig-operation-time').val(operation_time);
                        });

                        timeAddContainer.appendChild(btn);
                    }
                }

            } else {
                //alert("Please select a date first.");
                if (hasInteracted) {
                    alert("Please select a date from calender.");
                }
            }
        }




        // this is for upper click

        if (e.target.classList.contains("date") && e.target.classList.contains("highlighted")) {

            document.querySelectorAll(".date.highlighted").forEach(el => {
                el.classList.remove("clicked_date");
            });
            e.target.classList.add("clicked_date");
            hasInteracted = true;

            const dayNumber = parseInt(e.target.textContent.trim());
            const monthYearStr = document.getElementById("month-year").textContent.trim();
            const [monthName, yearStr] = monthYearStr.split(" ");
            const year = parseInt(yearStr);
            const month = new Date(`${monthName} 1, ${year}`).getMonth();

            const clickedDate = new Date(year, month, dayNumber);


            //25 apr 2025
            displaySelectedDate(clickedDate);
            //25 apr 2025

            const weekdays = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
            const dayName = weekdays[clickedDate.getDay()];

            const selectedOption = document.querySelector(".price-option.selected");

            if (selectedOption) {
                const duration = parseInt(selectedOption.getAttribute("data-duration")); // in minutes

                const openTimeStr = timeData[dayName]?.open || "12:00 am";
                const closeTimeStr = timeData[dayName]?.close || "12:00 am";

                const startHour = parseHour(openTimeStr);
                const endHour = parseHour(closeTimeStr);

                const timeAddContainer = document.querySelector(".time-add");
                timeAddContainer.innerHTML = ""; // Clear previous buttons


                let clickedDate1 = new Date(clickedDate);
                let formattedDate = clickedDate1.getFullYear() + '-' +
                    String(clickedDate1.getMonth() + 1).padStart(2, '0') + '-' +
                    String(clickedDate1.getDate()).padStart(2, '0');



                for (let time = startHour; time < endHour; time += duration / 60) {
                    const btn = document.createElement("button");
                    btn.type = "button";
                    btn.className = "btn btn-outline-primary m-1 slot-btn";
                    btn.textContent = formatTime(time);





                    var ajaxUrl = "{{ url('/get-matching-bookings') }}";
                    $.ajax({
                        url: ajaxUrl,
                        type: 'GET',
                        async: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            date: formattedDate
                        },
                        success: function(response) {
                            const bookedRanges = [];
                            response.forEach(function(booking) {
                                const formatted = formatBookingTime(booking.operation_time,
                                    booking.duration);
                                if (formatted) {
                                    bookedRanges.push(formatted);
                                }
                            });
                            if (bookedRanges.length > 0) {
                                //alert(bookedRanges .join('\n'));
                            }
                            var timeToCheck = convertDecimalToTime(time);


                            function isBetween(value, start, end, inclusive = true) {
                                return inclusive ?
                                    value >= start && value <= end :
                                    value > start && value < end;
                            }


                            function parseTimeToDate(timeStr) {
                                const today = new Date();
                                const [time, modifier] = timeStr.split(' ');
                                let [hours, minutes] = time.split(':').map(Number);

                                if (modifier.toLowerCase() === 'pm' && hours !== 12) hours += 12;
                                if (modifier.toLowerCase() === 'am' && hours === 12) hours = 0;

                                return new Date(today.getFullYear(), today.getMonth(), today
                                    .getDate(), hours, minutes);
                            }

                            // Convert timeToCheck to a Date
                            const checkTime = parseTimeToDate(timeToCheck);

                            // Check each range
                            let isBooked = false;

                            bookedRanges.forEach(range => {
                                const [startStr, endStr] = range.split(' to ');
                                const startTime = parseTimeToDate(startStr.trim());
                                const endTime = parseTimeToDate(endStr.trim());


                                var checkTimeDuration = new Date(checkTime);
                                // Add 120 minutes
                                checkTimeDuration.setMinutes(checkTime.getMinutes() +
                                    duration);


                                //if (checkTime >= startTime && checkTime < endTime) {
                                if (isBetween(checkTime, startTime, endTime)) {
                                    isBooked = true;
                                }

                                if (checkTime <= startTime && endTime <=
                                    checkTimeDuration) {
                                    isBooked = true;

                                }
                            });

                            if (isBooked) {


                                if (btn.textContent === timeToCheck) {
                                    btn.disabled = true;
                                    btn.classList.add("disabled"); // Optional: for visual styling
                                }


                            } else {
                                //alert(`${timeToCheck} is available`);
                            }

                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                        }
                    });




                    function formatBookingTime(operationTime, durationMinutes) {
                        const start = new Date(operationTime);
                        const end = new Date(start.getTime() + durationMinutes * 60000); // 60000 ms in 1 minute

                        const options = {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        };
                        const startFormatted = start.toLocaleTimeString('en-US', options);
                        const endFormatted = end.toLocaleTimeString('en-US', options);

                        return `${startFormatted} to ${endFormatted}`;
                    }

                    function convertDecimalToTime(decimalTime) {
                        const hours = Math.floor(decimalTime);
                        const minutes = Math.round((decimalTime - hours) * 60);

                        const date = new Date();
                        date.setHours(hours);
                        date.setMinutes(minutes);

                        return date.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        }).toLowerCase();
                    }












                    // Add click event for highlighting
                    btn.addEventListener("click", function() {
                        // Remove the class from all buttons
                        document.querySelectorAll(".slot-btn").forEach(b => {
                            b.classList.remove("time_button_clicked");
                        });

                        // Add the class to the clicked button
                        this.classList.add("time_button_clicked");

                        // Convert 12-hour time to 24-hour format
                        function convertTo24HourFormat(time12h) {
                            const [timePart, modifier] = time12h.split(' ');

                            let [hours, minutes] = timePart.split(':');
                            if (hours === '12') {
                                hours = '00';
                            }
                            if (modifier.toLowerCase() === 'pm') {
                                hours = parseInt(hours, 10) + 12;
                            }
                            return `${String(hours).padStart(2, '0')}:${minutes}`;
                        }

                        let month_plus = String(clickedDate.getMonth() + 1).padStart(2,
                            '0'); // Month is 0-indexed
                        let time24 = convertTo24HourFormat(this.textContent);

                        let operation_time = `${year}-${month_plus}-${dayNumber}T${time24}`;
                        $('#selected-gig-operation-time').val(operation_time);
                        // console.log(year, month_plus, dayNumber, time24, operation_time)

                        // const h_duration = document.querySelector('input[name="h_duration"]');
                        // if (h_duration) {
                        //     h_duration.value = this.textContent;
                        // }
                    });

                    timeAddContainer.appendChild(btn);


                }
            } else {
                alert("No time slot selected.");
            }
        }
    });
</script>


<script>
    const datesContainer = document.getElementById("dates");
    const monthYear = document.getElementById("month-year");

    // These values come from Blade and PHP
    const openDays = {
        @foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $key)
            '{{ $key }}': {{ $gig->host->{$key . '_is_open'} }},
        @endforeach
    };

    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function formatDate(dateObj) {
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const day = String(dateObj.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function getDayKey(dayIndex) {
        return ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'][dayIndex];
    }

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        datesContainer.innerHTML = "";

        const currentDisplayedMonth = new Date(year, month);
        monthYear.innerText = `${currentDisplayedMonth.toLocaleString("default", { month: "long" })} ${year}`;

        // Define the range: today to today + 2 months
        const startDate = new Date();
        const endDate = new Date();
        endDate.setMonth(endDate.getMonth() + 2);

        for (let i = 0; i < firstDay; i++) {
            const empty = document.createElement("div");
            datesContainer.appendChild(empty);
        }

        for (let i = 1; i <= lastDate; i++) {
            const date = document.createElement("div");
            date.className = "date";
            date.textContent = i;

            const thisDate = new Date(year, month, i);
            const dayKey = getDayKey(thisDate.getDay());

            // Only highlight if within the 2-month window and the day is open
            if (thisDate >= startDate && thisDate <= endDate && openDays[dayKey] === 1) {
                date.classList.add("highlighted");
            } else {
                date.classList.add("date-disable");
            }

            // Mark today
            if (
                i === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                date.classList.add("today");
            }

            datesContainer.appendChild(date);
        }
    }


    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear -= 1;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear += 1;
        }

        renderCalendar(currentMonth, currentYear);
    }

    renderCalendar(currentMonth, currentYear);
</script>
