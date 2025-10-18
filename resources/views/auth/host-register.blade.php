<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/signup.css') }}">
        <style>
            .toggle-switch {
                display: flex;
                align-items: center;
                position: relative;
                margin-bottom: 1rem;
            }
            .toggle-switch input[type="radio"] {
                display: none;
                /* Hide the default radio buttons */
            }
            .toggle {
                width: 20%;
                height: 30px;
                border-radius: 30px;
                position: relative;
                cursor: pointer;
                transition: background-color 0.3s;
                padding-left: 15px;
            }
            .signup-for-host a.login-a {
                display: flex;
                justify-content: center;
                padding-top: 5px;
            }

            .toggle-inner {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                padding: 0 5px;
            }
            .label-email {
                color: white;
                font-size: 17px;
                transition: opacity 0.3s;
            }
            .label-phone {
                color: black;
                font-size: 17px;
                transition: opacity 0.3s;
            }
            /* Initially show email label */
            .label-phone {
                opacity: 0;
                /* Hide phone label initially */
            }
            input[type="radio"]:checked+input[type="radio"]+.toggle {
                background-color: rgb(169, 240, 5);
                /* Green when checked */
            }
            input[type="radio"]:checked+input[type="radio"]+.toggle .toggle-inner .label-phone {
                opacity: 1;
                /* Show phone label */
            }
            input[type="radio"]:checked+input[type="radio"]+.toggle .toggle-inner .label-email {
                opacity: 0;
                /* Hide email label */
            }
            .toggle-inner {
                width: 100%;
                height: 100%;
                position: relative;
                transition: background-color 0.3s;
            }
            .card.login-card.signup-for-host {
                margin: auto;
                margin-bottom: 20px;
            }
            .container-fluid.mt-2.mb-5.signup-form {
                background-color: #f7f7f7;
                padding: 65px;
                margin: 0px !important;
            }

            @media (min-width:768px) and (max-width:1024px) {
                .card.login-card.signup-for-host {
                    margin: auto;
                    margin-bottom: 0;
                }

            }

            @media screen and (max-width:767px) {
                .card.login-card.signup-for-host {
                    margin: auto;
                    margin-bottom: 0;
                }
                .toggle {
                    width: 26%;
                }
            }
        </style>
    @endpush
    <div class="container-fluid mt-2 mb-5 signup-form">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card login-card signup-for-host">
                    <div class="card-body">
                        @if ($errors->has('sms_error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('sms_error') }}
                            </div>
                        @endif
                        <h5 class="p-3 text-center">Signup Form For Host</h5>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-row">
                                <!-- Name -->
                                <div class="form-group col-md-12">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input type="text" class="search-from" id="name" name="name"
                                        :value="old('name')" Placeholder="Enter Name" required/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="toggle-switch">
                                        <input type="radio" id="email-option" name="contact_method" value="email"
                                            {{ old('contact_method', 'email') === 'email' ? 'checked' : '' }}>
                                        <input type="radio" id="phone-option" name="contact_method" value="phone"
                                            {{ old('contact_method') === 'phone' ? 'checked' : '' }}>

                                        <div class="toggle">
                                            <div class="toggle-inner">
                                                <span class="label-phone">Email</span>
                                                <span class="label-email" style="margin-left: -20px;">Phone</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if (old('contact_method') === 'phone')
                                        <div id="contact-input">
                                            <x-text-input type="phone" class="search-from" id="phone"
                                                name="phone" value="{{ old('phone') }}" required
                                                placeholder="Enter phone" />
                                            @error('phone')
                                                <span class="mt-2 text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @else
                                        <div id="contact-input">
                                            <x-text-input type="email" class="search-from" id="email"
                                                name="email" value="{{ old('email') }}" required
                                                placeholder="Enter Email" />
                                            @error('email')
                                                <span class="mt-2 text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <!-- Password -->
                            <div class="form-row">
                                <!-- Password -->
                                <div class="form-group col-md-12">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="search-from" type="password" name="password"
                                         autocomplete="new-password" Placeholder="Enter Password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="search-from" type="password"
                                        name="password_confirmation"  autocomplete="new-password"
                                        Placeholder="Enter Confirm Password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            <input type="hidden" name="role" value="host">

                            <!-- Submit Button -->
                            <x-primary-button class="ms-3" style="border: 0px;">{{ __('Signup') }}</x-primary-button>
                            <a class="login-a" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input[name="contact_method"]').on('change', function() {
                    if ($('#phone-option').is(':checked')) {
                        $('#contact-input').html(`
                            <x-text-input type="tel" class="search-from" id="phone" name="phone" 
                            value="{{ old('phone') }}" required placeholder="Enter phone number" />
                        `);
                    } else {
                        $('#contact-input').html(`
                            <x-text-input type="email" class="search-from" id="email" name="email" 
                            value="{{ old('email') }}" required placeholder="Enter Email" />
                        `);
                    }
                });

                $('.toggle').on('click', function() {
                    if ($('#phone-option').is(':checked')) {
                        $('#email-option').prop('checked', true).trigger('change');
                    } else {
                        $('#phone-option').prop('checked', true).trigger('change');
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
