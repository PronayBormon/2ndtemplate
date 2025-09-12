            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="/frontend/images/logo.png" alt="" class="img-fluid">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Page -->
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div >Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('backend.user*') ? 'active' : '' }}">
                        <a href="{{ route('backend.user.list') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div>User List</div>
                        </a>
                    </li>

                </ul>
            </aside>
