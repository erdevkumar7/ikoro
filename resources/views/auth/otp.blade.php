<x-guest-layout>
    @if ($errors->has('otp'))
        <div class="alert alert-danger">
            {{ $errors->first('otp') }}
        </div>
    @endif
    <div class="container login-card" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h1 class="nav-link">Verify Your OTP</h1>
            <form action="{{ route('otp.verify.post') }}" method="POST">
                @csrf
                <input type="hidden" name="phone" value="{{ $phone }}">
                <div class="form-group">
                    <label for="otp">Enter OTP:</label>
                    <x-text-input type="text" id="otp" name="otp" class="search-from" required>
                </div>
                <x-primary-button>Verify OTP</x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>

