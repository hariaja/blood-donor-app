@extends('layouts.app')
@section('title', trans('page.overview.title'))
@section('content')
<div class="row">
  <div class="col-md-6 col-xl-4">
    <div class="block block-rounded">
      <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
        <div class="me-3">
          <p class="fs-3 fw-bold mb-0">
            {{ $dashboard->userDonorActive() }}
          </p>
          <p class="text-muted mb-0">
            {{ trans('Pendonor Aktif') }}
          </p>
        </div>
        <div class="item rounded-circle bg-body">
          <i class="fa fa-user fa-lg text-danger"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="block block-rounded">
      <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
        <div class="me-3">
          <p class="fs-3 fw-bold mb-0">
            {{ $dashboard->registrationApproved() }}
          </p>
          <p class="text-muted mb-0">
            {{ trans('Pendaftaran Disetujui') }}
          </p>
        </div>
        <div class="item rounded-circle bg-body">
          <i class="fa fa-file-circle-check fa-lg text-success"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="block block-rounded">
      <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
        <div class="me-3">
          <p class="fs-3 fw-bold mb-0">
            {{ $dashboard->hasArrivedSchedule() }}
          </p>
          <p class="text-muted mb-0">
            {{ trans('Berhasil Donor') }}
          </p>
        </div>
        <div class="item rounded-circle bg-body">
          <i class="fa fa-check fa-lg text-primary"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 col-md-12">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          {{ trans('Dashboard') }}
        </h3>
      </div>
      <div class="block-content">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <div class="text-center">
          <h6>
            {{ __('You are logged in!') }}
          </h6>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
