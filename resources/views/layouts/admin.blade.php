<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#10110f">
    <title>@yield('title', 'Admin') — ErgoJob</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ url('/') }}" aria-label="ErgoJob dashboard">
                <span class="brand-mark" role="img" aria-label="Logo ErgoJob"></span>
                <span class="brand-name">ergo<span>job</span><small>ADMIN CONSOLE</small></span>
            </a>

            <div class="nav-caption">MENU UTAMA</div>
            <nav class="side-nav" aria-label="Navigasi utama">
                <a class="nav-link {{ ($activePage ?? '') === 'overview' ? 'active' : '' }}" href="{{ url('/') }}">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/></svg>
                    <span>Ringkasan</span>
                </a>
                <a class="nav-link {{ ($activePage ?? '') === 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg>
                    <span>Pengguna</span>
                    <span class="nav-count">128</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                
                <div class="admin-profile">
                    <div class="avatar avatar-admin">AD</div>
                    <div class="profile-copy"><strong>Admin ErgoJob</strong><span>Administrator</span></div>
                    <button class="more-button" type="button" aria-label="Opsi profil">···</button>
                </div>
            </div>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <div class="breadcrumb"><span>ErgoJob</span><span class="crumb-divider">/</span><strong>@yield('section', 'Dashboard')</strong></div>
                <div class="topbar-actions">
                    <div class="avatar avatar-admin top-avatar">AD</div>
                </div>
            </header>
            <section class="page-content">
                @yield('content')
            </section>
            <footer class="page-footer"></footer>
        </main>
    </div>
</body>
</html>
