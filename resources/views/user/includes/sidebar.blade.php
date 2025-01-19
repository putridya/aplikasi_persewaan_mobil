    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('user.dashboard') }}">
                <span class="align-middle">{{ env('APP_NAME', 'AdminPanel') }}</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Pages
                </li>

                <li class="sidebar-item {{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::routeIs('user.transaction') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.transaction') }}">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> <span class="align-middle">Sewa/Pengembalian</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::routeIs('user.car') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.car') }}">
                        <i class="fa fa-car" aria-hidden="true"></i> <span class="align-middle">Mobil</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::routeIs('user.customer') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.customer') }}">
                        <i class="fa fa-users" aria-hidden="true"></i> <span class="align-middle">Customers</span>
                    </a>
                </li>

                

            </ul>

        </div>
    </nav>
