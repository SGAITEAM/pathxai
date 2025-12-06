@extends('layouts.authLayout')

@section('title', __('Confirm Password'))

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner py-4">
    <!-- Confirm Password Card -->
    <div class="card">
      <div class="card-body">

        <!-- Logo -->
        <div class="app-brand justify-content-center mb-4">
          <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset('assets/img/app-logo.png') }}" height="64" alt="Logo">
            </span>
            <span class="app-brand-text demo text-heading ms-2">MenuMood</span>
          </a>
        </div>

        <!-- Title -->
        <h4 class="mb-2">{{ __('Confirm Password') }} 🔒</h4>
        <p class="mb-4">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
        <p class="mb-4">{{ __('Please confirm your password before continuing.') }}</p>

        <!-- Confirm Form -->
        <form method="POST" action="{{ route('password.confirm') }}">
          @csrf

          <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" id="password" name="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="••••••••••" required autocomplete="current-password" />
            @error('password')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Confirm Password') }}</button>
        </form>

        <!-- Forgot Password -->
        @if (Route::has('password.request'))
        <p class="text-center mt-3">
          <a href="{{ route('password.request') }}">
            <small>{{ __('Forgot Your Password?') }}</small>
          </a>
        </p>
        @endif

      </div>
    </div>
    <!-- /Card -->
  </div>
</div>
@endsection
