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
      {{ trans('page.registrations.show') }}
    </h3>
  </div>
  <div class="block-content">

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
          <div class="fw-semibold">{{ $registration->user->name }}</div>
          <div class="fw-normal mb-4">{{ $registration->user->donor->nik }}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
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
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status Pendaftaran') }}
            <span class="fw-semibold">{{ $registration->status }}</span>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nomor Pendaftaran') }}
            <span class="fw-semibold">{{ $registration->number }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Terakhir Donor') }}
            <span class="fw-semibold">{{ Helper::customDate($registration->last_donor) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Donor Kembali') }}
            <span class="fw-semibold">{{ Helper::customDate($registration->return_donor) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Bersedia Donor Kapanpun?') }}
            <span class="fw-semibold">{{ $registration->urgency }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Bersedia Donor Bulan Ramadhan?') }}
            <span class="fw-semibold">{{ $registration->ramadan }}</span>
          </li>
        </ul>
      </div>
    </div>

    <form action="{{ route('registrations.update', $registration->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')


      <div class="row justify-content-center">
        <div class="col-md-6">

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

                <div id="update-status-area" style="display: none;">
                  <div class="mb-4">
                    <label for="message" class="form-label">{{ trans('Alasan Penolakan') }}</label>
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Input Alasan">{{ old('message') }}</textarea>
                    @error('message')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

              </div>

              <div class="mb-4">
                <button type="submit" class="btn btn-primary w-100" id="submit-button">
                  <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                  {{ trans('page.edit') }}
                </button>
              </div>

            @endif
          @endif

        </div>
      </div>

    </form>

  </div>
</div>
@endsection
@push('javascript')
  <script>

    $(function () {
      let REJECTED = '{{ Constant::REJECTED }}'
      $('input[name="status"]').change(function () {
        if ($(this).val() === REJECTED) {
          $('#update-status-area').show()
        } else {
          $('#update-status-area').hide()
          $('#message').val('')
        }
      })
    })

  </script>
@endpush