<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand d-flex align-items-center px-2">
            <img src="{{ asset('img/logo.png') }}" alt="logo" width="35" class="shadow-light rounded-circle mr-2">
            <div class="text-left">
                <div class="brand-title">Arsip</div>
                <div class="brand-subtext">Politeknik Negeri Bengkalis</div>
            </div>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank
                        Page</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank
                        Page</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank
                        Page</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank
                        Page</span></a>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
