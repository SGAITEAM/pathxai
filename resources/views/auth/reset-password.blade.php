@extends('layouts.authLayout')

@section('title', __('Reset Password'))

@section('content')
<div class="authentication-wrapper authentication-cover">
  <!-- Logo -->
  <a href="{{ url('/') }}" class="app-brand auth-cover-brand">
    <span class="app-brand-logo demo">
      <img src="{{ asset('assets/img/app-logo.png') }}" height="64" alt="Logo">
    </span>
    <span class="app-brand-text demo text-heading fw-bold">MenuMood</span>
  </a>
  <!-- /Logo -->

  <div class="authentication-inner row m-0">
    <!-- Illustration -->
    <div class="d-none d-xl-flex col-xl-8 p-0">
      <div class="auth-cover-bg d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
          alt="reset-password" class="my-5 auth-illustration" />
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
          alt="bg" class="platform-bg" />
      </div>
    </div>

    <!-- Form -->
    <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-6 p-sm-12">
      <div class="w-px-400 mx-auto mt-12 pt-5">
        <h4 class="mb-1">{{ __('Reset Password') }} 🔒</h4>
        <p class="mb-4">{{ __('Your new password must be different from previously used passwords.') }}</p>

        <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <!-- Hidden Token -->
          <input type="hidden" name="token" value="{{ request()->route('token') }}">
          <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

          <!-- New Password -->
          <div class="mb-4 form-password-toggle">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <div class="input-group input-group-merge">
              <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required autofocus autocomplete="new-password"
                placeholder="••••••••••••" />
              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
            </div>
            @error('password')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="mb-4 form-password-toggle">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group input-group-merge">
              <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control" required autocomplete="new-password"
                placeholder="••••••••••••" />
              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
            </div>
          </div>

          <button type="submit" class="btn btn-primary d-grid w-100 mb-3">{{ __('Set New Password') }}</button>

          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex justify-content-center align-items-center">
              <i class="ti tabler-chevron-left me-1_5"></i> {{ __('Back to login') }}
            </a>
          </div>
        </form>
      </div>
    </div>
    <!-- /Form -->
  </div>
</div>
@endsection
