@extends('layouts.app')
@section('title') {{ trans('page.donors.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.donors.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-block-option text-danger">
              <i class="fa fa-xs fa-chevron-left me-1"></i>
              {{ trans('page.button.back') }}
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.donors.create') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('donors.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Input Email">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" onkeypress="return hanyaAngka(event)" placeholder="Input No. Handphone">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="roles" class="form-label">{{ trans('Role') }}</label>
              <input type="text" name="roles" id="roles" value="{{ old('roles', $roles->name) }}" class="form-control @error('roles') is-invalid @enderror" placeholder="{{ trans('Input Role') }}" onkeypress="return hanyaHuruf(event)" readonly>
              @error('roles')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <h6 class="">{{ trans('Detail Informasi Pendonor') }}</h6>
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
              <label for="nik" class="form-label">{{ trans('Nomor Induk Kependudukan') }}</label>
              <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" onkeypress="return hanyaAngka(event)" placeholder="Input Nomor Induk Kependudukan">
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
          
            <div class="mb-4">
              <label for="birth_date" class="form-label">{{ trans('Tanggal Lahir') }}</label>
              <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
              @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="mb-4">
              <label for="job_title" class="form-label">{{ trans('Pekerjaan') }}</label>
              <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" onkeypress="return hanyaHuruf(event)" placeholder="Input Pekerjaan">
              @error('job_title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="mb-4">
              <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror" placeholder="Input Alamat">{{ old('address') }}</textarea>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-primary w-100" id="submit-button">
                <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                {{ trans('page.create') }}
              </button>
            </div>

          </div>
        </div>

      </form>

    </div>
  </div>
@endsection