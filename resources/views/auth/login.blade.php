<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container d-flex justify-content-center align-items-center vh-100 login-container">
        <div class="card login-card" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                @if ($errors->has('status'))
                    <div class="alert alert-danger">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <x-input-label for="username" :value="__('Email')" />
                        <x-text-input type="text" class="search-from" name="email" :value="old('email')" required
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="search-from" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="login-a">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <p class="already-account "> Don't have an account?</p>
                    <a href="{{ route('user.register') }}" class="login-a">SignUp as User</a> | <a
                        href="{{ route('host.register') }}" class="login-a">SignUp as Host</a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
