@extends('layouts.authLayout')

@section('title', __('Login'))

@section('content')
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">

    <!-- Left Side Illustration -->
    <div class="d-none d-xl-flex col-xl-8 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" />
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="bg-shape" class="platform-bg" />
      </div>
    </div>

    <!-- Login Form -->
    <div class="d-flex col-12 col-xl-4 align-items-center auth-bg px-5">
      <div class="w-px-400 mx-auto">

        <!-- Logo -->
        <div class="app-brand mb-4 text-center">
          <a href="{{ url('/') }}" class="app-brand-link gap-2 text-center">
            <span class="app-brand-logo demo ">
              <img src="{{ asset('/img/logo.png') }}" alt="Logo" height="64" width="64">
            </span>
            <h1 class="mb-0 display-5">PathXAI</h1>
          </a>
        </div>

        <!-- Headings -->
        <h4 class="mb-2"></h4>
        <p class="mb-4"> {{ __('welcome') }}</p>

        <!-- Login Form Start -->
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus />
            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">{{ __('Password') }}</label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                  <small>{{ __('Forgot Your Password?') }}</small>
                </a>
              @endif
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password" name="password"
                class="form-control form-control-lg @error('password') is-invalid @enderror" required />
              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
            </div>
            @error('password')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Remember Me -->
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
            </div>
          </div>

          <!-- Sign In -->
          <div class="mb-3">
            <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Login') }}</button>
          </div>
        </form>

        <!-- Register -->
        <p class="text-center">
          <span></span>
          <a href="{{ route('register') }}">
            <span>{{ __('Register') }}</span>
          </a>
        </p>

        <!-- Or separator -->
        {{-- <div class="divider my-4">
          <div class="divider-text">or</div>
        </div> --}}


      </div>
    </div>

  </div>
</div>
@endsection
