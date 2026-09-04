<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Interlude')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/dashboard.css'])
    <style>
        .dashboard-body,
        .dashboard-body .sidebar-brand,
        .dashboard-body .page-title,
        .dashboard-body h1,
        .dashboard-body h2,
        .dashboard-body h3,
        .dashboard-body h4,
        .dashboard-body h5,
        .dashboard-body h6,
        .dashboard-body .stat-value {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('styles')
</head>
<body class="dashboard-body">
    <div class="dashboard-shell">
        @include('components.dashboard-sidebar')
        <div class="dashboard-main">
            @include('components.dashboard-navbar')
            <main class="dashboard-content">@yield('content')</main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    @yield('scripts')
</body>
</html>