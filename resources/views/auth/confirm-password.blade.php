<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>
    <div class="container d-flex justify-content-center align-items-center vh-100 login-container">
        <div class="card login-card" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
