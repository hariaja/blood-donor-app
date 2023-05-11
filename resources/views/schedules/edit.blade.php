@extends('layouts.app')
@section('title') {{ trans('page.schedules.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.schedules.title') }}</h1>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-block-option text-danger">
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
        {{ trans('page.schedules.edit') }}
      </h3>
    </div>
    <div class="block-content">

      <form action="{{ route('schedules.update', $schedule->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
        @csrf
        @method('PATCH')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <input type="hidden" name="registration_id" value="{{ $schedule->registration_id }}">

            <div class="mb-4">
              <label for="number" class="form-label">{{ trans('Nomor Pendaftaran') }}</label>
              <input type="text" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ $schedule->registration->number }}" readonly>
              @error('number')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="date" class="form-label">{{ trans('Tanggal Pengambilan Darah') }}</label>
              <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d', strtotime($schedule->date->toDateString()))) }}">
              @error('date')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="time" class="form-label">{{ trans('Jam Pengambilan') }}</label>
              <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $schedule->time) }}">
              @error('time')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            @if(me()->hasRole(Constant::ADMIN))
              <div class="text-center">
                <div class="mb-4">
                  <label class="form-label">{{ trans('Pilih Status') }}</label>
                  <div class="space-x-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-have-arrived" name="status" value="{{ Constant::HAVE_ARRIVED }}" {{ $schedule->status == Constant::HAVE_ARRIVED ? 'checked' : '' }}>
                      <label class="form-check-label text-success" for="status-have-arrived">{{ Constant::HAVE_ARRIVED }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-not-yet-come" name="status" value="{{ Constant::NOT_YET_COME }}" {{ $schedule->status == Constant::NOT_YET_COME ? 'checked' : '' }}>
                      <label class="form-check-label text-warning" for="status-not-yet-come">{{ Constant::NOT_YET_COME }}</label>
                    </div>
                  </div>
                </div>
              </div>
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
@push('javascript')
  <script>
    // Can't select before today
    $(document).ready(function() {
      var today = new Date().toISOString().split('T')[0];
      $('#date').attr('min', today);
    });
  </script>
@endpush
