<header id="page-header">
  <div class="content-header">
    <div class="space-x-1">
      <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
        <i class="fa fa-fw fa-bars"></i>
      </button>
    </div>

    <div class="space-x-1">
      <div class="dropdown d-inline-block">
        <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-user d-sm-none"></i>
          <span class="d-none d-sm-inline-block">{{ me()->name }}</span>
          <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
          <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
            {{ trans('Opsi') }}
          </div>
          <div class="p-2">

            <a class="dropdown-item" href="{{ route('users.show', me()->uuid) }}">
              <i class="far fa-fw fa-user me-1"></i>
              {{ trans('Profil Saya') }}
            </a>

            <div role="separator" class="dropdown-divider"></div>

            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i>
              {{ trans('Keluar Aplikasi') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>