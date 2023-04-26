@extends('layouts.guest')
@section('title', trans('page.register.title'))
@section('content')
<div class="bg-image">
  <div class="row g-0 justify-content-center bg-gd-fruit-op">
    <div class="hero-static col-sm-8 col-md-6 col-xl-8 d-flex align-items-center p-2 px-sm-0">
      <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">

          <div class="mb-2 text-center">
            <div class="link-fx fw-bold fs-1">
              <span class="text-dark">{{ trans('page.register.title') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('page.register.subtitle') }}
            </p>
          </div>

          <form class="js-validation-signup" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
            @csrf

            <div class="row justify-content-center">
              <div class="col-md-6">

                <div class="mb-4">
                  <label for="name" class="form-label">{{ trans('Nama Lengkap') }}</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" onkeypress="return hanyaHuruf(event)">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="nik" class="form-label">{{ trans('Nomor Induk Kependudukan') }}</label>
                  <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" onkeypress="return hanyaAngka(event)">
                  @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
                  <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                    <option value="{{ Constant::MALE }}" {{ old('gender') === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                    <option value="{{ Constant::FEMALE }}" {{ old('gender') === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md">
                    <div class="mb-4">
                      <label for="blood_type_id" class="form-label">{{ trans('Golongan Darah') }}</label>
                      <select name="blood_type_id" id="blood_type_id" class="js-select2 form-select @error('blood_type_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Golongan Darah') }}" style="width: 100%;">
                        <option></option>
                        @foreach ($bloodTypes as $item)
                          @if (old('blood_type_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->type }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->type }}</option>
                          @endif
                        @endforeach
                      </select>
                      @error('blood_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="mb-4">
                      <label for="rhesus" class="form-label">{{ trans('Rhesus') }}</label>
                      <select name="rhesus" id="rhesus" class="form-select @error('rhesus') is-invalid @enderror">
                        <option disabled selected>{{ trans('Pilih Rhesus') }}</option>
                        <option value="{{ Constant::POSITIF }}" {{ old('rhesus') === Constant::POSITIF ? 'selected' : '' }}>{{ Constant::POSITIF }}</option>
                        <option value="{{ Constant::NEGATIF }}" {{ old('rhesus') === Constant::NEGATIF ? 'selected' : '' }}>{{ Constant::NEGATIF }}</option>
                      </select>
                      @error('rhesus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="birth_date" class="form-label">{{ trans('Tanggal Lahir') }}</label>
                  <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                  @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="job_title" class="form-label">{{ trans('Pekerjaan') }}</label>
                  <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" onkeypress="return hanyaHuruf(event)">
                  @error('job_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
                  <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" onkeypress="return hanyaAngka(event)">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="email" class="form-label">{{ trans('Email') }}</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="password" class="form-label">{{ trans('Password') }}</label>
                  <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="password_confirmation" class="form-label">{{ trans('Konfirmasi Password') }}</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror">
                  @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <label class="form-label">{{ trans('page.image') }}</label>
                    </div>
                    <div class="block-content">
                      <div class="push">
                        <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mb-4">
                  <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
                  <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
                  @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
                  <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="text-center my-4">
                  <button type="submit" class="btn btn-hero btn-primary w-100" id="submit-button">
                    <i class="fa fa-fw fa-plus opacity-50 me-1"></i>
                    {{ trans('page.register.button') }}
                  </button>
                </div>

              </div>
            </div>

            <div class="text-center">
              {{ trans('page.register.quest') }}
              <a href="{{ route('login') }}"><b>{{ trans('page.register.link_login') }}</b></a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection