<nav id="sidebar" aria-label="Main Navigation">
  <div class="bg-header-dark">
    <div class="content-header bg-white-5">
      <a class="fw-semibold text-white tracking-wide" href="index.html">
        <span class="smini-visible">
          D<span class="opacity-75">x</span>
        </span>
        <span class="smini-hidden">
          {{ trans('Donor Darah') }}
        </span>
      </a>

      <div>
        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
          <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
        </button>

        <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
          <i class="fa fa-times-circle"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="js-sidebar-scroll">
    <div class="content-side">
      <ul class="nav-main">

        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="nav-main-link-icon fa fa-home"></i>
            <span class="nav-main-link-name">{{ trans('Dashboard') }}</span>
          </a>
        </li>

        @canany(['roles.index', 'users.index'])
          <li class="nav-main-heading">{{ trans('Management') }}</li>
          <li class="nav-main-item {{ Request::is('settings*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}" href="#">
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

        <li class="nav-main-item mt-5">
          <a class="nav-main-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-main-link-icon text-danger far fa-arrow-alt-circle-left"></i>
            <span class="nav-main-link-name">{{ trans('Keluar Aplikasi') }}</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>

      </ul>
    </div>
  </div>
</nav>