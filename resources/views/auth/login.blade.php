@extends('layouts.guest')
@section('title', trans('page.login.title'))
@section('content')
<div class="bg-image">
  <div class="row g-0 justify-content-center bg-gd-fruit-op">
    <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
      <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">

          <!-- Header -->
          <div class="mb-2 text-center">
            <div class="link-fx fw-bold fs-1">
              <span class="text-dark">{{ trans('page.login.title') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('page.login.subtitle') }}
            </p>
          </div>
          <!-- END Header -->
      
          <!-- Sign In Form -->
          <form method="POST" action="{{ route('login') }}" onsubmit="return disableSubmitButton()">
            @csrf
            <div class="mb-4">
              <div class="input-group input-group-lg">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                <span class="input-group-text">
                  <i class="fa fa-envelope"></i>
                </span>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="mb-4">
              <div class="input-group input-group-lg">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ trans('page.login.remember') }}</label>
              </div>
              <div class="fw-semibold fs-sm py-1">
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">{{ trans('page.login.forgot') }}</a>
                @endif
              </div>
            </div>
            <div class="text-center mb-4">
              <button type="submit" class="btn btn-hero btn-primary w-100" id="submit-button">
                <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i>
                {{ trans('page.login.title') }}
              </button>
            </div>
            <div class="text-center">
              {{ trans('page.login.quest') }}
              <a href="{{ route('register') }}"><b>{{ trans('page.login.link_register') }}</b></a>
            </div>
          </form>
          <!-- END Sign In Form -->

        </div>
      </div>
    </div>
  </div>
</div>
@endsection