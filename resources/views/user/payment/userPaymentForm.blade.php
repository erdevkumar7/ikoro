<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/content.css') }}">
    @endpush
    <div class="container d-flex justify-content-center mt-5 mb-5">
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
        <form action="{{ route('user.strip.paymentSubmit') }}" method="POST" id="payment-form">
            @csrf
            <div class="row g-3">
                <div class="col-md-">
                    <span>Payment Method</span>
                    <div class="card">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header p-0">
                                    <h2 class="mb-0">
                                        <button class="btn btn-light btn-block text-left p-3 rounded-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span>Card Number</span>
                                                <div class="icons">
                                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                    <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                                    <img src="https://i.imgur.com/35tC99g.png" width="30">
                                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body payment-card-body">
                                        <span class="font-weight-normal card-text">Card Details</span>

                                        <!-- Card Element will be inserted here -->
                                        <div id="card-element" class="form-control"
                                            style="padding: 10px; border: 1px solid #ccc;">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Error message placeholder -->
                                        <div id="card-errors" role="alert" style="color: red;"></div>

                                        <span class="text-muted certificate-text">
                                            <i class="fa fa-lock"></i> Your transaction is secured with SSL certificate
                                        </span>
                                    </div>
                                </div>

                                <input type="hidden" name="gig_id" id="gig-id" value="{{ $gigId }}">
                                <input type="hidden" name="price" id="selected-gig-price"
                                    value="{{ $price }}">
                                <input type="hidden" name="duration" id="selected-gig-duration"
                                    value="{{ $duration }}">
                                <input type="hidden" name="operation_time" id="selected-gig-operation-time"
                                    value="{{ $operation_time }}" />

                                <div class="p-3">
                                    <button type="submit" class="btn btn-primary btn-block free-button">Pay
                                        Now</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</x-guest-layout>



<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe with your public key
    window.onload = function() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card', {
            hidePostalCode: true, // Optional: Hide postal code field if not needed
            style: {
                base: {
                    iconColor: '#666EE8',
                    color: '#31325F',
                    fontWeight: 400,
                    fontFamily: 'Helvetica Neue, Helvetica, sans-serif',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });

        // Mount the card element to the div in HTML
        card.mount('#card-element');

        // Handle real-time validation errors from the card element
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log('result.token.id', result.token.id);
                    // Send the token to your server
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    }
</script>
