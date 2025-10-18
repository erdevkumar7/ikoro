    <x-guest-layout>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        @push('styles')
            <link rel="stylesheet" href="{{ asset('frontend/assets/css/signup.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        @endpush

        <div class="container mt-2 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card login-card sign-up-card">
                        <div class="card-body">
                            <h5 class="p-3 text-center">Signup Form For User</h5>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-row">
                                    <!-- Name -->
                                    <div class="form-group col-md-12">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input type="text" class="search-from" id="name" name="name"
                                            :value="old('name')" placeholder="Enter Name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Email -->
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <x-text-input type="text" class="search-from" id="email" name="email"
                                            :value="old('email')" placeholder="Enter Email" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="form-row tool-details" id="whatsapp_div">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="whatsapp" :value="__('WhatsApp')" />
                                        <x-text-input id="whatsapp" class="search-from" type="text" name="whatsapp"
                                            :value="old('whatsapp')" autocomplete="" placeholder="Enter WhatsApp No" />
                                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="feedback_tool" :value="__('Feedback Tool')" />
                                        <select name="feedback_tool" class="search-from" required id="feedback_tool">
                                            <option value="">Select Tool</option>
                                            @foreach (config('app.feedback_tool') as $tool)
                                                <option value="{{ $tool }}">{{ $tool }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row tool-details" id="skype_div">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="skype" :value="__('Skype')" />
                                        <x-text-input id="skype" class="search-from" type="text" name="skype"
                                            autocomplete="" placeholder="Enter Skype Id" />
                                        <x-input-error :messages="$errors->get('skype')" class="mt-2" />
                                    </div>
                                </div> --}}

                                <div class="form-row tool-details" id="goole_meet_div">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="google_meet_id" :value="__('Google Meet Id')" />
                                        <x-text-input id="google_meet_id" class="search-from" type="text"
                                            name="google_meet_id" :value="old('google_meet_id')" autocomplete=""
                                            placeholder="Enter Google Meet Id" />
                                        <x-input-error :messages="$errors->get('google_meet_id')" class="mt-2" />
                                    </div>
                                </div>


                                <!-- Password -->
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="search-from" type="password" name="password"
                                            autocomplete="new-password" placeholder="Enter Password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="search-from" type="password"
                                            name="password_confirmation" autocomplete="new-password"
                                            placeholder="Enter Confirm Password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <x-primary-button class="ms-3" style="border: 0px;">
                                    {{ __('Signup') }}</x-primary-button>
                                <a href="{{ route('login') }}" class="login-a"> {{ __('Already registered?') }} </a>
                            </form>
                        </div>

                        <div class="card-footer goggle-face-add-btn">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <a href="{{ route('google.redirect') }}">
                                        <button class="btn-login">
                                            Signup as <i class="fa-brands fa-google"></i>
                                        </button>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ url('auth/facebook') }}">
                                        <button class="btn-login float-right">
                                            Signup as <i class="fa-brands fa-facebook-f"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-guest-layout>
