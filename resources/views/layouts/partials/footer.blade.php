<div class="content py-4">
  <!-- Footer Navigation -->
  <div class="row items-push fs-sm border-bottom pt-4">
    <div class="col-6 col-md-4">
      <h3 class="fw-light">{{ trans('Akun') }}</h3>
      <ul class="list list-simple-mini">
        <li>
          <a class="fw-semibold" href="javascript:void(0)">
            <i class="fa fa-fw fa-wrench text-primary-lighter me-2"></i>
            {{ trans('Ubah Kata Sandi') }}
          </a>
        </li>
        <li>
          <a class="fw-semibold text-dark" href="{{ me()->hasRole(Constant::DONOR) ? route('donors.show', me()->donor->uuid) : route('users.show', me()->uuid) }}">
            <i class="fa fa-fw fa-user-circle text-muted me-2"></i>
            {{ me()->name }}
          </a> -
          <a class="fw-semibold text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ trans('Keluar Aplikasi?') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
  <!-- END Footer Navigation -->

  <!-- Footer Copyright -->
  <div class="row fs-sm pt-4">
    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
      <span class="fw-semibold">
        {{ config('app.name') }}
      </span>
    </div>
    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
      <a class="fw-semibold text-danger" href="#" target="_blank">{{ trans('Palang Merah Indonesia Kota Sukabumi') }}</a> &copy; <span data-toggle="year-copy"></span>
    </div>
  </div>
  <!-- END Footer Copyright -->
</div>