<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <h4 class="mt-4">{{ config('app.name') }}</h4>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="50" class="me-2">
                <span class="text-white" style="font-size: 1.5rem; line-height: 22px;">{{ config('app.name') }}</span>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('menu*') ? ' active' : '' }}" href="{{ route('menu.index') }}">
                        <i class="ri-menu-line"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('content*') ? ' active' : '' }}" href="{{ route('content.index') }}">
                        <i class="ri-file-text-line"></i> Konten
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('user*') ? ' active' : '' }}" href="{{ route('users.index') }}">
                        <i class="ri-user-line"></i> User
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('posts*') ? ' active' : '' }}" href="{{ route('posts.index') }}">
                        <i class="ri-shuffle-line"></i> Post
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>