@extends('layouts.authLayout')

@section('title', 'Verify Email')

@section('content')
<div class="authentication-wrapper authentication-cover">
  <!-- Logo -->
  <a href="{{ url('/') }}" class="app-brand auth-cover-brand">
    <span class="app-brand-logo demo">
      <span class="text-primary">
        <!-- Vuexy SVG Logo -->
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.0017 0V6.854C0.0017 6.854 -0.1332 9.012 1.9809 10.839L13.6912 21.9964L19.7809 21.9181L18.8042 9.8825L16.4951 7.1729L9.238 0H0.0017Z"
            fill="currentColor" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M7.6982 16.4364L12.5199 3.237L16.5541 7.256L7.6982 16.4364Z"
            fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M8.0775 15.9175L13.9419 4.6399L16.5849 7.2848L8.0775 15.9175Z"
            fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.773 16.3566L23.6563 0H32V6.8838C32 6.8838 31.8262 9.1784 30.6591 10.4057L19.7824 22H13.6938L7.773 16.3566Z"
            fill="currentColor" />
        </svg>
      </span>
    </span>
    <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
  </a>
  <!-- /Logo -->

  <div class="authentication-inner row m-0">
    <!-- Illustration -->
    <div class="d-none d-xl-flex col-xl-8 p-0">
      <div class="auth-cover-bg d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-verify-email-illustration-light.png') }}"
          alt="auth-verify-email" class="my-5 auth-illustration" />
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
          alt="background" class="platform-bg" />
      </div>
    </div>

    <!-- Verify Email Box -->
    <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-6 p-sm-12">
      <div class="w-px-400 mx-auto mt-12 mt-5">
        <h4 class="mb-1">{{ __('Verify Your Email Address') }} ✉️</h4>
        <p class="text-start mb-4">
          {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn’t receive the email, we will gladly send you another.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
          <div class="alert alert-success mb-4" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
          </div>
        @endif

        <!-- Resend Form -->
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="btn btn-primary d-grid w-100 mb-3">
            {{ __('Resend Verification Email') }}
          </button>
        </form>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary d-grid w-100">
            {{ __('Logout') }}
          </button>
        </form>
      </div>
    </div>
    <!-- / Verify Email Box -->
  </div>
</div>
@endsection
