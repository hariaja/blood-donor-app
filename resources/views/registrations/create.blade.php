@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.registrations.create') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('registrations.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="text-center mb-4">
            <div class="my-3">
              <div class="d-flex py-3 justify-content-center">
                <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                  <img class="img-avatar " src="{{ me()->getAvatar() }}" alt="">
                  @if(me()->hasVerifiedEmail())
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                  @else
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                  @endif
                </div>
              </div>
            </div>
            <div class="fw-semibold mb-4">{{ me()->name }}</div>

            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Usia') }}
                <span class="fw-semibold">{{ me()->donor->age . ' Tahun' }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Tanggal Lahir') }}
                <span class="fw-semibold">{{ Helper::customDate(me()->donor->birth_date) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Golongan Darah') }}
                <span class="fw-semibold">{{ me()->donor->bloodType->type }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Rhesus') }}
                <span class="fw-semibold">{{ me()->donor->rhesus }}</span>
              </li>
            </ul>

          </div>

          <div class="mb-3">
            <label for="last_donor" class="form-label">{{ trans('Terakhir Melakukan Donor') }}</label>
            <input type="date" name="last_donor" id="last_donor" class="form-control @error('last_donor') is-invalid @enderror" value="{{ old('last_donor') }}">
            <span class="text-muted fw-semibold fs-xs">{{ trans('Kosongkan jika belum pernah') }}</span>
            @error('last_donor')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label mb-2">{{ trans('Apakah anda bersedia melakukan donor pada waktu tertentu? (Di luar donor rutin)') }}</label>
            <div class="space-x-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('urgency') is-invalid @enderror" type="radio" id="urgency" name="urgency" value="{{ Constant::YES }}" {{ old('urgency') == Constant::YES ? 'checked' : '' }}>
                <label class="form-check-label" for="urgency">{{ Constant::YES }}</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('urgency') is-invalid @enderror" type="radio" id="urgency" name="urgency" value="{{ Constant::NO }}" {{ old('urgency') == Constant::NO ? 'checked' : '' }}>
                <label class="form-check-label" for="urgency">{{ Constant::NO }}</label>
              </div>
            </div>
            <span class="text-muted fw-semibold fs-xs">{{ trans('Pilih salah satu (Wajib)') }}</span>
            @error('urgency')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label mb-2">{{ trans('Apakah anda bersedia melakukan donor pada bulan puasa?') }}</label>
            <div class="space-x-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('ramadan') is-invalid @enderror" type="radio" id="ramadan" name="ramadan" value="{{ Constant::YES }}" {{ old('ramadan') == Constant::YES ? 'checked' : '' }}>
                <label class="form-check-label" for="ramadan">{{ Constant::YES }}</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('ramadan') is-invalid @enderror" type="radio" id="ramadan" name="ramadan" value="{{ Constant::NO }}" {{ old('ramadan') == Constant::NO ? 'checked' : '' }}>
                <label class="form-check-label" for="ramadan">{{ Constant::NO }}</label>
              </div>
            </div>
            <span class="text-muted fw-semibold fs-xs">{{ trans('Pilih salah satu (Wajib)') }}</span>
            @error('ramadan')
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