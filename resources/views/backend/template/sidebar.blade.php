    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none" aria-label="Tertiary navigation">
        <a class="navbar-brand me-lg-5" href="{{ asset('backend') }}/index.html">
            <img class="navbar-brand-dark" src="{{ asset('backend') }}/assets/img/brand/light.svg" alt="Volt logo" />
            <img class="navbar-brand-light" src="{{ asset('backend') }}/assets/img/brand/dark.svg" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar aria-label="Sidebar">
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img class="avatar rounded-circle" alt=""
                                src="{{ auth()->user()->profile && auth()->user()->profile->image
                                    ? asset('storage/' . auth()->user()->profile->image)
                                    : asset('backend/assets/img/team/profile-picture-3.jpg') }}">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">Hi, {{ Auth::user()->username }}</h2>
                        <a href="{{ route('logout') }}"
                            class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-left me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <div class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('backend') }}/assets/img/brand/light.svg" height="20" width="20"
                                alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">Admin Panel</span>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('panel.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('panel.dashboard') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                {{-- Master --}}
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-app">
                        <span>
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9a2 2 0 002-2V5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Manage Loker</span>
                        </span>
                        <span class="link-arrow">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </span>

                    {{-- {{ request()->routeIs('panel.menu.*', 'panel.chef.*', 'panel.event.*') ? 'show' : '' }} --}}
                    <div class="multi-level collapse"
                        role="list" id="submenu-app">
                        <ul class="flex-column nav">
                            {{-- {{ request()->routeIs('panel.menu.*') ? 'active' : '' }} --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-text">Menu</span>
                                </a>
                            </li>

                            {{-- {{ request()->routeIs('panel.chef.*') ? 'active' : '' }} --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-text">Chef</span>
                                </a>
                            </li>

                            {{-- {{ request()->routeIs('panel.event.*') ? 'active' : '' }} --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-text">Event</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Gallery --}}
                <li class="nav-item">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-gallery">
                        <span>
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm1 9.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15 5.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Kelola Lamaran</span>
                        </span>
                        <span class="link-arrow">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </span>

                    {{-- {{ request()->routeIs('panel.image.*', 'panel.video.*') ? 'show' : '' }} --}}
                    <div class="multi-level collapse"
                        role="list" id="submenu-gallery" >
                        <ul class="flex-column nav">
                            {{-- {{ request()->routeIs('panel.image.*') ? 'active' : '' }} --}}
                            <li class="nav-item">
                                {{-- {{ route('panel.image.index') }} --}}
                                <a class="nav-link" href="">
                                    <span class="sidebar-text">Image</span>
                                </a>
                            </li>

                            {{-- {{ request()->routeIs('panel.video.*') ? 'active' : '' }} --}}
                            <li class="nav-item">
                                {{-- {{ route('panel.video.index') }} --}}
                                <a class="nav-link" href="">
                                    <span class="sidebar-text">Video</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li role="separator" class="dropdown-divider pt-1 mt-3 border-gray-700"></li>

                <li class="nav-item {{ request()->routeIs('panel.profile.edit') ? 'active' : '' }}">
                    <a href="{{ route('panel.profile.edit') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0A7 7 0 0123 9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">My Profile</span>
                    </a>
                </li>

                {{-- <li role="separator" class="dropdown-divider pt-1 border-gray-700"></li>

                <li class="nav-item">
                    <a href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/getting-started/quick-start/"
                        target="_blank" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Report <span
                                class="badge badge-sm bg-secondary ms-1 text-gray-800">v1.4</span></span>
                    </a>
                </li> --}}

                <li class="nav-item d-none d-md-block">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
                        <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-left me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                        </span>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
