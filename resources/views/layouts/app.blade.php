<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Interlude - Penerbit Buku')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite(['resources/css/interlude.css'])
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/favicon-48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-180.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    @yield('styles')
</head>
<body>
    @unless (request()->routeIs('login'))
        <!-- Navigation Component -->
        @include('components.navbar')
    @endunless
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    @unless (request()->routeIs('login'))
        <!-- Footer Component -->
        @include('components.footer')
    @endunless

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('click', function (e) {
            const link = e.target.closest('.wishlist-btn');
            if (!link) return;

            e.preventDefault();

            const url = link.getAttribute('href');
            const scope = link.closest('.book-card, .book-detail-info') || document;
            const filledButton = link.classList.contains('btn-lg');

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const headers = {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
            };

            fetch(url, { method: 'POST', headers: headers, credentials: 'same-origin' })
                .then(function (response) {
                    if (!response.ok) throw new Error('Wishlist request failed');
                    return response.json();
                })
                .then(function (data) {
                    if (filledButton) {
                        link.classList.remove('btn-danger', 'btn-outline-danger');
                        link.classList.add(data.wished ? 'btn-danger' : 'btn-outline-danger');
                    }
                    const icon = link.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fas', 'far', 'text-danger');
                        icon.classList.add(data.wished ? 'fas' : 'far');
                        if (data.wished) icon.classList.add('text-danger');
                    }
                    scope.querySelectorAll('[data-wishlist-count]').forEach(function (el) {
                        el.textContent = Number(data.wishlist_count).toLocaleString('id-ID');
                    });
                })
                .catch(function () {
                    window.location.reload();
                });
        });
    </script>

    @yield('scripts')
</body>
</html>
