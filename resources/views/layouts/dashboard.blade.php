<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Interlude')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <style>
        .alert-fade {
            transition: opacity 0.6s ease;
        }
        .alert-fade.fade-out {
            opacity: 0;
        }
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
            min-height: calc(1.5em + 0.75rem + 2px) !important;
            padding: 0.375rem 0.75rem !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #86b7fe !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }
        .select2-container--bootstrap-5 .select2-selection--single {
            height: auto !important;
        }
        .select2-container--bootstrap-5 .select2-selection__rendered {
            padding: 0 !important;
            line-height: 1.5 !important;
        }
        .select2-container--bootstrap-5 .select2-selection__arrow {
            height: calc(1.5em + 0.75rem) !important;
            right: 0.5rem !important;
        }
        .select2-container--bootstrap-5 .select2-selection__clear {
            right: 1.5rem !important;
            font-size: 1rem !important;
            color: #6c757d !important;
        }
        .select2-container--open {
            z-index: 9999 !important;
        }
        .select2-dropdown {
            border-color: #dee2e6 !important;
            border-radius: 0.375rem !important;
            z-index: 9999 !important;
        }
        .select2-search--dropdown .select2-search__field {
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
            padding: 0.375rem 0.5rem !important;
        }
        .select2-results__option {
            padding: 0.5rem 0.75rem !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
            background-color: #0d6efd !important;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
    <script>
        document.querySelectorAll('.alert-fade').forEach(function(el) {
            setTimeout(function() { el.classList.add('fade-out'); }, 3000);
            setTimeout(function() { el.remove(); }, 3700);
        });
    </script>
</body>
</html>