@extends('layouts.authLayout')

@section('title', __('Register'))

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner py-6 mt-6">
    <!-- Register Card -->
    <div class="card">
      <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-4">
          <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset('/img/logo.png') }}" height="64" alt="Logo">
            </span>
            <span class="app-brand-text demo text-heading ms-2">PathXAI</span>
          </a>
        </div>
        <!-- /Logo -->

        <h4 class="mb-1 text-center">{{ __('Register Now') }}</h4>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
          @csrf
        
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus />
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        
          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required />
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        
          {{-- <!-- Phone -->
          <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Phone') }}</label>
            <input id="phone" type="text"
              class="form-control @error('phone') is-invalid @enderror"
              name="phone" value="{{ old('phone') }}" required />
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        
          <!-- Brand -->
          <div class="mb-3">
            <label for="brand" class="form-label">{{ __('Brand') }}</label>
            <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required />
            @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div> --}}
        
          <!-- Password -->
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <div class="input-group input-group-merge">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required />
              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
            </div>
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
          </div>
        
          <!-- Confirm Password -->
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
            <div class="input-group input-group-merge">
              <input id="password_confirmation" type="password"
                class="form-control" name="password_confirmation" required />
              <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
            </div>
          </div>
        
          <!-- reCAPTCHA -->
          {{-- @if(env('GOOGLE_RECAPTCHA_KEY'))
          <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
          </div>
          @endif --}}
        
          <!-- Reg Phrase -->
          {{-- <div class="mb-3" style="font-size: 11px; text-align: justify; color:#6d6b78;">
            <i class="ti tabler-exclamation-circle" style="font-size: 15px"></i> {!! __('RegPhrase') !!} 
          </div> --}}
        
          <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Register') }}</button>
        </form>
        

        <!-- Already have account -->
        <p class="text-center mt-3">
          <span>{{ __('Already have an account?') }}</span>
          <a href="{{ route('login') }}">
            <span>{{ __('Sign in instead') }}</span>
          </a>
        </p>

      </div>
    </div>
    <!-- /Register Card -->
  </div>
</div>
@endsection
