@extends('layouts.guest')
@section('title', 'Reset Kata Sandi')
@section('content')
<div class="bg-image">
  <div class="row g-0 justify-content-center bg-gd-fruit-op">
    <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
      <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
          <!-- Header -->
          <div class="mb-2 text-center">
            <div class="link-fx fw-bold fs-1">
              <span class="text-dark">{{ trans('Reset Password') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('Masukkan email agar kami bisa menemukan akun anda') }}
            </p>
          </div>
          <!-- END Header -->

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}" onsubmit="return disableSubmitButton()">
            @csrf

            <div class="mb-4">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ trans('Email Address') }}">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-primary btn-hero w-100" id="submit-button">{{ __('Send Password Reset Link') }}</button>
            </div>

            <div class="text-center">
              <a href="{{ route('login') }}"><b>{{ trans('Login?') }}</b></a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
