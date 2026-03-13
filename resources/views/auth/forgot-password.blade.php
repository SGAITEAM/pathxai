@extends('layouts.authLayout')

@section('title', __('Forgot Your Password?'))

@section('content')
<div class="authentication-wrapper authentication-cover">
   
  <div class="authentication-inner row m-0">
    <!-- Left Image -->
    <div class="d-none d-xl-flex col-xl-8 p-0">
      <div class="auth-cover-bg d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-verify-email-illustration-dark.png') }}"
          alt="auth-forgot-password" class="my-5 auth-illustration d-lg-block d-none" />
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
          alt="background-shape" class="platform-bg" />
      </div>
    </div>

    <!-- Forgot Password Form -->
    <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
      <div class="w-px-400 mx-auto mt-12 mt-5">
        <!-- Logo -->
        <div class="app-brand mb-4 text-center">
          <a href="{{ url('/') }}" class="app-brand-link gap-2 text-center">
            <span class="app-brand-logo demo ">
              <img src="{{ asset('/img/logo.png') }}" alt="Logo" height="64" width="64">
            </span>
            <h1 class="mb-0 display-5">PathXAI</h1>
          </a>
        </div>

        <h4 class="mb-1">{{ __('Forgot Your Password?') }} 🔒</h4>
        <p class="mb-4">{{ __('Enter your email and we’ll send you a link to reset your password') }}</p>

        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="mb-3 form-control-validation">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
              id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}" required autofocus />
            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button class="btn btn-primary d-grid w-100">{{ __('Send Password Reset Link') }}</button>
        </form>

        <div class="text-center mt-3">
          <a href="{{ route('login') }}" class="d-flex justify-content-center align-items-center">
            <i class="ti tabler-chevron-left me-1_5"></i>
            {{ __('Back to login') }}
          </a>
        </div>
      </div>
    </div>
    <!-- /Form -->
  </div>
</div>
@endsection
