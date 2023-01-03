<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item  {{ $set_active == 'perdinku' ? 'active' : '' }}">
        <a href="{{ url('perdinku') }}" class='sidebar-link'>
            <i class="icon dripicons dripicons-stack"></i>
            <span>PERDINKU</span>
        </a>
    </li>
    <hr>
    <li class="sidebar-item">
        <a href="#" class='sidebar-link text-danger fw-bold'>
            <i class="icon dripicons dripicons-exit text-danger"></i>
            <span>Logout</span>
        </a>
        <h5>Hello , {{ $user }}</h5>
    </li>
</ul>