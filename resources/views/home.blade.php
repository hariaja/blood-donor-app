@extends('layouts.app')
@section('title', trans('page.overview.title'))
@section('content')
<!-- Quick Stats -->
<div class="row">
  <div class="col-md-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full d-flex align-items-center justify-content-between">
        <div>
          <!-- Sparkline Dashboard Users Container -->
          <span class="js-sparkline" data-type="line"
                data-points="[340,330,360,340,360,350,370,360]"
                data-width="90px"
                data-height="40px"
                data-line-color="#82b54b"
                data-fill-color="transparent"
                data-spot-color="transparent"
                data-min-spot-color="transparent"
                data-max-spot-color="transparent"
                data-highlight-spot-color="#82b54b"
                data-highlight-line-color="#82b54b"
                data-tooltip-suffix="Users"></span>
        </div>
        <div class="ms-3 text-end">
          <p class="text-muted mb-0">
            Users
          </p>
          <p class="fs-3 mb-0">
            +350
          </p>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full d-flex align-items-center justify-content-between">
        <div>
          <!-- Sparkline Dashboard Tickets Container -->
          <span class="js-sparkline" data-type="line"
                data-points="[21,17,19,25,24,25,18,27]"
                data-width="90px"
                data-height="40px"
                data-line-color="#e04f1a"
                data-fill-color="transparent"
                data-spot-color="transparent"
                data-min-spot-color="transparent"
                data-max-spot-color="transparent"
                data-highlight-spot-color="#e04f1a"
                data-highlight-line-color="#e04f1a"
                data-tooltip-suffix="Tickets"></span>
        </div>
        <div class="ms-3 text-end">
          <p class="text-muted mb-0">
            Tickets
          </p>
          <p class="fs-3 mb-0">
            28
          </p>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full d-flex align-items-center justify-content-between">
        <div>
          <!-- Sparkline Dashboard Projects Container -->
          <span class="js-sparkline" data-type="line"
                data-points="[7,9,5,2,3,4,8,3]"
                data-width="90px"
                data-height="40px"
                data-line-color="#3c90df"
                data-fill-color="transparent"
                data-spot-color="transparent"
                data-min-spot-color="transparent"
                data-max-spot-color="transparent"
                data-highlight-spot-color="#3c90df"
                data-highlight-line-color="#3c90df"
                data-tooltip-suffix="Projects"></span>
        </div>
        <div class="ms-3 text-end">
          <p class="text-muted mb-0">
            Projects
          </p>
          <p class="fs-3 mb-0">
            6
          </p>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full d-flex align-items-center justify-content-between">
        <div>
          <!-- Sparkline Dashboard Sales Container -->
          <span class="js-sparkline" data-type="line"
                data-points="[68,25,36,62,59,80,75,89]"
                data-width="90px"
                data-height="40px"
                data-line-color="#343a40"
                data-fill-color="transparent"
                data-spot-color="transparent"
                data-min-spot-color="transparent"
                data-max-spot-color="transparent"
                data-highlight-spot-color="#343a40"
                data-highlight-line-color="#343a40"
                data-tooltip-suffix="Sales"></span>
        </div>
        <div class="ms-3 text-end">
          <p class="text-muted mb-0">
            Sales
          </p>
          <p class="fs-3 mb-0">
            +89
          </p>
        </div>
      </div>
    </a>
  </div>
</div>
<!-- END Quick Stats -->

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
