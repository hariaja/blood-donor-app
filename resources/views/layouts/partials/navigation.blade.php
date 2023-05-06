<div class="content">
  <!-- Toggle Main Navigation -->
  <div class="d-lg-none push">
    <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
    <button type="button" class="btn w-100 btn-primary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
      Menu
      <i class="fa fa-bars"></i>
    </button>
  </div>
  <!-- END Toggle Main Navigation -->

  <!-- Main Navigation -->
  <div id="main-navigation" class="d-none d-lg-block push">
    <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-dark">

      <li class="nav-main-item">
        <a class="nav-main-link {{ Request::is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
          <i class="nav-main-link-icon fa fa-compass"></i>
          <span class="nav-main-link-name">{{ trans('Overview') }}</span>
        </a>
      </li>

      @can('registrations.index')
        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('registrations*') ? 'active' : '' }}" href="{{ route('registrations.index') }}">
            <i class="nav-main-link-icon fa fa-file"></i>
            <span class="nav-main-link-name">{{ trans('Pendaftaran') }}</span>
          </a>
        </li>
      @endcan

      @can('schedules.index')
        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('schedules*') ? 'active' : '' }}" href="{{ route('schedules.index') }}">
            <i class="nav-main-link-icon fa fa-calendar"></i>
            <span class="nav-main-link-name">{{ trans('Jadwal') }}</span>
          </a>
        </li>
      @endcan

      @canany(['roles.index', 'users.index'])
        <li class="nav-main-heading">{{ trans('Management') }}</li>
        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('settings*') ? 'active' : '' }} nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}" href="#">
            <i class="nav-main-link-icon fa fa-cog"></i>
            <span class="nav-main-link-name">{{ trans('Settings') }}</span>
          </a>
          <ul class="nav-main-submenu">
            @can('users.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                  <span class="nav-main-link-name">{{ trans('Pengguna') }}</span>
                </a>
              </li>
            @endcan
            @can('roles.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                  <span class="nav-main-link-name">{{ trans('Role & Permission') }}</span>
                </a>
              </li>
            @endcan
          </ul>
        </li>
      @endcan

      {{-- <li class="nav-main-item">
        <a class="nav-main-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-main-link-icon fa fa-undo text-danger"></i>
          <span class="nav-main-link-name">{{ trans('Log Out') }}</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li> --}}

    </ul>
  </div>
  <!-- END Main Navigation -->
</div>