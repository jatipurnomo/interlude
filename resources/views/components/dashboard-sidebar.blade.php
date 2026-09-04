<aside class="dashboard-sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="dashboardSidebar" aria-labelledby="dashboardSidebarLabel">
    <div class="sidebar-inner">
        <div class="sidebar-brand">
            <span class="brand-mark"><i class="bi bi-book-half" aria-hidden="true"></i></span>
            <span id="dashboardSidebarLabel">Interlude</span>
            <button type="button" class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#dashboardSidebar" aria-label="Close navigation"></button>
        </div>
        <p class="sidebar-label">Workspace</p>
        <nav class="sidebar-nav" aria-label="Dashboard navigation">
            <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" @if(request()->routeIs('dashboard')) aria-current="page" @endif><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i><span>Dashboard</span></a>
            <a class="sidebar-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}" @if(request()->routeIs('admin.books.*')) aria-current="page" @endif><i class="bi bi-journal-bookmark" aria-hidden="true"></i><span>Books</span></a>
            <a class="sidebar-link" href="#"><i class="bi bi-bar-chart-line" aria-hidden="true"></i><span>Reports</span></a>
            <a class="sidebar-link" href="#"><i class="bi bi-sliders2" aria-hidden="true"></i><span>Settings</span></a>
        </nav>
        <div class="sidebar-footer">
            <a class="sidebar-link" href="{{ route('home') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i><span>Back to site</span></a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="sidebar-link sidebar-logout w-100 border-0" type="submit"><i class="bi bi-box-arrow-right" aria-hidden="true"></i><span>Logout</span></button>
            </form>
        </div>
    </div>
</aside>