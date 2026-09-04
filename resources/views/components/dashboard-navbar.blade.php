<header class="dashboard-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="icon-button d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#dashboardSidebar" aria-controls="dashboardSidebar" aria-label="Open navigation"><i class="bi bi-list" aria-hidden="true"></i></button>
        <div><p class="eyebrow mb-1">Admin workspace</p><h1 class="page-title mb-0">Dashboard</h1></div>
    </div>
    <div class="navbar-actions">
        <form class="dashboard-search" role="search"><i class="bi bi-search" aria-hidden="true"></i><input type="search" placeholder="Search dashboard" aria-label="Search dashboard"></form>
        <button class="icon-button notification-button" type="button" aria-label="View notifications"><i class="bi bi-bell" aria-hidden="true"></i><span class="notification-dot"></span></button>
        <div class="dropdown">
            <button class="profile-trigger" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="avatar avatar-small">{{ auth()->user()->initials() }}</span><span class="d-none d-sm-block text-start"><strong>{{ auth()->user()->name }}</strong><small>{{ data_get(auth()->user(), 'role', 'Administrator') }}</small></span><i class="bi bi-chevron-down d-none d-sm-inline" aria-hidden="true"></i></button>
            <ul class="dropdown-menu dropdown-menu-end profile-menu">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2 me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form></li>
            </ul>
        </div>
    </div>
</header>