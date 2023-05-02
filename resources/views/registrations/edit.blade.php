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
      {{ trans('page.registrations.edit') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('registrations.update', $registration->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')


      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="text-center mb-4">
            <div class="my-3">
              <div class="d-flex py-3 justify-content-center">
                <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                  <img class="img-avatar " src="{{ $registration->user->getAvatar() }}" alt="">
                  @if($registration->user->hasVerifiedEmail())
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                  @else
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                  @endif
                </div>
              </div>
            </div>
            <div class="fw-semibold mb-4">{{ $registration->user->name }}</div>

            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Usia') }}
                <span class="fw-semibold">{{ $registration->user->donor->age . ' Tahun' }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Tanggal Lahir') }}
                <span class="fw-semibold">{{ Helper::customDate($registration->user->donor->birth_date) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Golongan Darah') }}
                <span class="fw-semibold">{{ $registration->user->donor->bloodType->type }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Rhesus') }}
                <span class="fw-semibold">{{ $registration->user->donor->rhesus }}</span>
              </li>
            </ul>

          </div>

          <div class="mb-4">
            <label for="last_donor" class="form-label">{{ trans('Terakhir Melakukan Donor') }}</label>
            <input type="date" name="last_donor" id="last_donor" class="form-control @error('last_donor') is-invalid @enderror" value="{{ old('last_donor') }}">
            <span class="text-muted fw-semibold fs-xs">{{ trans('Kosongkan jika belum pernah') }}</span>
            @error('last_donor')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
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

          <div class="mb-4">
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

          @if (me()->hasRole(Constant::ADMIN))
            @if ($registration->status !== Constant::APPROVED)
              <div class="text-center">
                <div class="fw-semibold mb-4">{{ trans('Ubah Status Pendaftaran') }}</div>
              </div>

              <div class="text-center">
                <div class="mb-4">
                  <label class="form-label">{{ trans('Pilih Status') }}</label>
                  <div class="space-x-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-pending" name="status" value="{{ Constant::PENDING }}" {{ $registration->status == Constant::PENDING ? 'checked' : '' }}>
                      <label class="form-check-label text-primary" for="status-pending">{{ Constant::PENDING }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-approved" name="status" value="{{ Constant::APPROVED }}" {{ $registration->status == Constant::APPROVED ? 'checked' : '' }}>
                      <label class="form-check-label text-success" for="status-approved">{{ Constant::APPROVED }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-rejected" name="status" value="{{ Constant::REJECTED }}" {{ $registration->status == Constant::REJECTED ? 'checked' : '' }}>
                      <label class="form-check-label text-danger" for="status-rejected">{{ Constant::REJECTED }}</label>
                    </div>
                  </div>
                </div>

                <div id="message-area" style="display: none;">
                  <div class="mb-4">
                    <label for="message" class="form-label">{{ trans('Alasan Penolakan') }}</label>
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Input Alasan">{{ old('message') }}</textarea>
                    @error('message')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

              </div>
            @endif
          @endif

          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection