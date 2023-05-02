@extends('layouts.app')
@section('title') {{ trans('page.users.show') }} @endsection
@section('hero')
  <div class="bg-image" style="background-image: url({{ asset('assets/dashmix/src/assets/media/photos/photo10@2x.jpg') }});">
    <div class="bg-primary-dark-op">
      <div class="content content-full text-center">
        <div class="my-3">
          <img class="img-avatar img-avatar-thumb" src="{{ $donor->user->getAvatar() }}" alt="">
        </div>
        <h1 class="h2 text-white mb-0">{{ $donor->user->name }}</h1>
        <h2 class="h4 fw-normal text-white-75">
          {{ $donor->user->isRoleName() }}
        </h2>
        <a class="btn btn-alt-secondary" href="{{ route('home') }}">
          <i class="fa fa-fw fa-arrow-left text-danger me-1"></i>
          {{ trans('Back to Dashboard') }}
        </a>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="content content-full content-boxed">
  <div class="block block-rounded">
    <div class="block-content">
      <form action="{{ route('donors.update', $donor->uuid) }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
        @csrf
        @method('PATCH')

        <!-- User Profile -->
        <h2 class="content-heading pt-0">
          <i class="fa fa-fw fa-user-circle text-muted me-1"></i>
          {{ trans('Ubah Profile') }}
        </h2>
        <div class="row push">
          <div class="col-lg-4">
            <p class="text-muted">
              {{ trans('Info penting akun Anda. Nama pengguna Anda akan terlihat oleh publik.') }}
            </p>
          </div>
          <div class="col-lg-8 col-xl-5">

            <input type="hidden" name="roles" id="roles" value="{{ old('roles', $donor->user->isRoleName()) }}" class="form-control">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $donor->user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $donor->user->email) }}" required placeholder="Input Email" readonly>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $donor->user->phone) }}" onkeypress="return hanyaAngka(event)" placeholder="Input No. Handphone">
              @error('phone')
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
                    @isset($donor->user->avatar)
                      <img class="img-prev img-profile-center" src="{{ $donor->user->getAvatar() }}" alt="">
                    @else
                      <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                    @endisset
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <input type="hidden" name="old_avatar" id="old_avatar" class="form-control" value="{{ $donor->user->avatar }}">
            </div>

            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload New Avatar') }}</label>
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="nik" class="form-label">{{ trans('Nomor Induk Kependudukan') }}</label>
              <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $donor->nik) }}" onkeypress="return hanyaAngka(event)" placeholder="Input Nomor Induk Kependudukan">
              @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="{{ Constant::MALE }}" {{ old('gender', $donor->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                <option value="{{ Constant::FEMALE }}" {{ old('gender', $donor->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
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
                      @if (old('blood_type_id', $donor->blood_type_id) == $item->id)
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
                    <option value="{{ Constant::POSITIF }}" {{ old('rhesus', $donor->rhesus) === Constant::POSITIF ? 'selected' : '' }}>{{ Constant::POSITIF }}</option>
                    <option value="{{ Constant::NEGATIF }}" {{ old('rhesus', $donor->rhesus) === Constant::NEGATIF ? 'selected' : '' }}>{{ Constant::NEGATIF }}</option>
                    <option value="{{ Constant::UNKNOWN }}" {{ old('rhesus', $donor->rhesus) === Constant::UNKNOWN ? 'selected' : '' }}>{{ Constant::UNKNOWN }}</option>
                  </select>
                  @error('rhesus')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mb-4">
              <label for="birth_date" class="form-label">{{ trans('Tanggal Lahir') }}</label>
              <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', date('Y-m-d', strtotime($donor->birth_date->toDateString()))) }}">
              @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="mb-4">
              <label for="job_title" class="form-label">{{ trans('Pekerjaan') }}</label>
              <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title', $donor->job_title) }}" onkeypress="return hanyaHuruf(event)" placeholder="Input Pekerjaan">
              @error('job_title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="mb-4">
              <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror" placeholder="Input Alamat">{{ old('address', $donor->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
          </div>
        </div>
        <!-- END User Profile -->

        <!-- Submit -->
        <div class="row push">
          <div class="col-lg-8 col-xl-5 offset-lg-4">
            <div class="mb-4">
              <button type="submit" class="btn btn-alt-primary w-100" id="submit-button">
                <i class="fa fa-check-circle opacity-50 me-1"></i>
                {{ trans('page.button.edit') }}
              </button>
            </div>
          </div>
        </div>
        <!-- END Submit -->
      </form>
    </div>
  </div>
</div>
@endsection