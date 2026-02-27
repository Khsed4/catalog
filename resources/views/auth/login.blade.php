@extends('layouts.auth')

@section('content')
<div class="auth-brand">
    <div class="auth-brand-icon">
        <i class="material-icons">inventory_2</i>
    </div>
    <h1>{{ config('app.name', 'Product Catalogue') }}</h1>
    <p>Product Catalogue Management</p>
</div>

<div class="auth-card">
    <div class="auth-card-header">
        <h2>Welcome back</h2>
        <p>Sign in to your account to continue</p>
    </div>
    <div class="auth-card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="you@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                       name="password" required autocomplete="current-password"
                       placeholder="Enter your password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>
    </div>
</div>

<div class="auth-footer">
    &copy; {{ date('Y') }} {{ config('app.name', 'Product Catalogue') }}
</div>
@endsection
