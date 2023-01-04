<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ $set_active == 'dashboard' ? 'active' : '' }}">
        <a href="{{ url('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item  {{ $set_active == 'users' ? 'active' : '' }}">
        <a href="{{ url('dashboard/users') }}" class='sidebar-link'>
            <i class="icon dripicons dripicons-stack"></i>
            <span>Pengguna</span>
        </a>
    </li>
    <li class="sidebar-item {{ $set_active == 'cities' ? 'active' : '' }}">
        <a href="{{ url('dashboard/cities') }}" class='sidebar-link'>
            <i class="icon dripicons dripicons-article"></i>
            <span>Master Kota</span>
        </a>
    </li>
    <li class="sidebar-item {{ $set_active == 'trips' ? 'active' : '' }}">
        <a href="{{ url('dashboard/trips') }}" class='sidebar-link'>
            <i class="icon dripicons dripicons-article"></i>
            <span>Perjalanan Dinas</span>
        </a>
    </li>
    <hr>
    <li class="sidebar-item">
        <a href="{{ url('logout/auth') }}" class='sidebar-link text-danger fw-bold'>
            <i class="icon dripicons dripicons-exit text-danger"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
