            <aside id="layout-menu"
                class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ url('/') }}"
                        class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset($settings->logo ?? '/frontend/images/logo.png') }}"
                                alt=""
                                class="img-fluid">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Page -->
                    <li
                        class="menu-item {{ (request()->routeIs('dashboard') ? 'active' : '' || request()->routeIs('home')) ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"
                            class="menu-link">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('backend.user*') ? 'active' : '' }}">
                        <a href="{{ route('backend.user.list') }}"
                            class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div>User List</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('backend.pages*') ? 'active' : '' }}">
                        <a href="{{ route('backend.pages.list') }}"
                            class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div>Dynamic Pages</div>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="menu-item {{ request()->routeIs('backend.admin.profile*') ? 'open' : '' }}">
                        <a href="javascript:void(0);"
                            class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="Settings">Settings</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('admin.settings.edit') }}"
                                    class="menu-link">
                                    <div data-i18n="System Settings">System Settings</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('backend.admin.profile*') ? 'active' : '' }}">
                                <a href="{{ route('backend.admin.profile') }}"
                                    class="menu-link">
                                    <div data-i18n="My Profile">My Profile</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </aside>
