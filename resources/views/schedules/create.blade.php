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
      {{ trans('page.schedules.create') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('schedules.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="registration_id" class="form-label">{{ trans('Nomor Pendaftaran') }}</label>
            <select name="registration_id" id="registration_id" class="js-select2 form-select @error('registration_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Nomor Pendaftaran') }}" style="width: 100%;">
              <option></option>
              @foreach ($registrations as $item)
                @if (old('registration_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->number }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->number }}</option>
                @endif
              @endforeach
            </select>
            @error('registration_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="date" class="form-label">{{ trans('Tanggal Pengambilan') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
            @error('date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="mb-4">
            <label for="time" class="form-label">{{ trans('Jam Pengambilan') }}</label>
            <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}">
            @error('time')
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
@push('javascript')
  <script>
    // Can't select before today
    $(document).ready(function() {
      var today = new Date().toISOString().split('T')[0];
      $('#date').attr('min', today);
    });
  </script>
@endpush