<div class="content-header">
  <!-- Left Section -->
  <div class="d-flex align-items-center">
    <!-- Logo -->
    <a class="fw-semibold text-dual tracking-wide" href="{{ route('home') }}">
      {{ config('app.name') }}
    </a>
    <!-- END Logo -->
  </div>
  <!-- END Left Section -->

  <!-- Right Section -->
  <div>

    <!-- User Dropdown -->
    <div class="dropdown d-inline-block">
      <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i>
        <i class="fa fa-angle-down opacity-50 ms-1"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
        <div class="rounded-top fw-semibold text-white bg-image" style="background-image: url({{ asset('assets/dashmix/src/assets/media/photos/photo20.jpg') }});">
          <div class="p-3 bg-black-50 rounded-top">
            <div class="d-flex align-items-center">
              <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ me()->getAvatar() }}" alt="">
              <div class="ms-3">
                <a class="text-white fw-semibold" href="{{ me()->hasRole(Constant::DONOR) ? route('donors.show', me()->donor->uuid) : route('users.show', me()->uuid) }}">{{ me()->name }}</a>
                <div class="fs-sm text-white-75">{{ me()->email }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="p-2">
          <a class="dropdown-item d-flex align-items-center" href="{{ me()->hasRole(Constant::DONOR) ? route('donors.show', me()->donor->uuid) : route('users.show', me()->uuid) }}">
            <i class="fa fa-fw fa-user-circle opacity-50 me-2"></i>
            {{ trans('Info Saya') }}
          </a>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('users.password', me()->uuid) }}">
            <i class="fa fa-fw fa-lock opacity-50 me-2"></i>
            {{ trans('Ubah Kata Sandi') }}
          </a>
          <div role="separator" class="dropdown-divider"></div>
          <a class="dropdown-item d-flex align-items-center mb-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-sign-out-alt text-danger me-2"></i>
            {{ trans('Keluar Aplikasi') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
    <!-- END User Dropdown -->
  </div>
  <!-- END Right Section -->
</div>