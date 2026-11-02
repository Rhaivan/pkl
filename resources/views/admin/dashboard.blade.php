@extends('layouts.admin')

@section('title', 'Ringkasan')
@section('section', 'Ringkasan')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Selamat datang, Admin</h1>
            <p>Berikut ringkasan aktivitas pengguna ErgoJob hari ini.</p>
        </div>
        <a class="button button-primary" href="{{ route('users.create') }}">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            Tambah pengguna
        </a>
    </div>

    <div class="stats-grid">
        <article class="stat-card">
            <div class="stat-top"><span>Total pengguna</span><span class="stat-icon mint"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg></span></div>
            <div class="stat-value">1,284</div>
            <div class="stat-foot"><span class="trend-up">↗ 12,8%</span><span>dari bulan lalu</span></div>
            <div class="stat-spark spark-mint"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Pengguna aktif</span><span class="stat-icon blue"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13h4l3-9 4 16 3-7h2"/></svg></span></div>
            <div class="stat-value">1,092</div>
            <div class="stat-foot"><span class="trend-up">↗ 8,2%</span><span>dari bulan lalu</span></div>
            <div class="stat-spark spark-blue"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Pengguna baru</span><span class="stat-icon violet"><svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg></span></div>
            <div class="stat-value">+86</div>
            <div class="stat-foot"><span class="trend-up">↗ 4,6%</span><span>bulan ini</span></div>
            <div class="stat-spark spark-violet"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Minat terpopuler</span><span class="stat-icon amber"><svg viewBox="0 0 24 24" fill="none"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z"/></svg></span></div>
            <div class="stat-value stat-text">Teknologi <span>· 38%</span></div>
            <div class="stat-foot"><span class="stat-muted">492 pengguna tertarik</span></div>
            <div class="interest-track"><span></span></div>
        </article>
    </div>

    <div class="dashboard-grid">
        <section class="panel activity-panel">
            <div class="panel-heading">
                <div><h2>Aktivitas pengguna</h2><p>Tren pendaftaran dalam 7 hari terakhir</p></div>
                <button class="select-button" type="button">7 hari terakhir <span>⌄</span></button>
            </div>
            <div class="chart-summary"><strong>248</strong><span class="trend-up">↗ 14,2%</span><small>pendaftaran baru</small></div>
            <div class="chart-wrap">
                <div class="chart-y-labels"><span>80</span><span>60</span><span>40</span><span>20</span><span>0</span></div>
                <div class="chart">
                    <div class="chart-grid"><i></i><i></i><i></i><i></i><i></i></div>
                    <svg class="chart-line" viewBox="0 0 700 180" preserveAspectRatio="none" aria-label="Grafik pendaftaran meningkat dari Senin hingga Minggu">
                        <defs><linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#b8ef72" stop-opacity=".2"/><stop offset="100%" stop-color="#b8ef72" stop-opacity="0"/></linearGradient></defs>
                        <path d="M0 140 C36 135 55 113 100 122 S161 147 200 104 S260 91 300 108 S365 111 400 74 S460 83 500 68 S560 94 600 51 S660 45 700 20 L700 180 L0 180Z" fill="url(#chartFill)"/>
                        <path d="M0 140 C36 135 55 113 100 122 S161 147 200 104 S260 91 300 108 S365 111 400 74 S460 83 500 68 S560 94 600 51 S660 45 700 20" fill="none" stroke="#b8ef72" stroke-width="3" vector-effect="non-scaling-stroke"/>
                        <circle cx="700" cy="20" r="5" fill="#b8ef72" stroke="#1b2017" stroke-width="3" vector-effect="non-scaling-stroke"/>
                    </svg>
                    <div class="chart-x-labels"><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span></div>
                </div>
            </div>
        </section>

        <section class="panel interests-panel">
            <div class="panel-heading"><div><h2>Bidang diminati</h2><p>Distribusi minat pengguna</p></div><button class="dots-button" type="button" aria-label="Opsi">···</button></div>
            <div class="interest-chart">
                <div class="donut"><div><strong>1.284</strong><span>pengguna</span></div></div>
                <div class="legend">
                    <div><i class="legend-tech"></i><span>Teknologi</span><strong>38%</strong></div>
                    <div><i class="legend-design"></i><span>Desain</span><strong>26%</strong></div>
                    <div><i class="legend-business"></i><span>Bisnis</span><strong>20%</strong></div>
                    <div><i class="legend-other"></i><span>Lainnya</span><strong>16%</strong></div>
                </div>
            </div>
            <a class="text-link" href="{{ route('users.index') }}">Lihat data pengguna <span>→</span></a>
        </section>
    </div>

    <section class="panel recent-panel">
        <div class="panel-heading recent-heading">
            <div><h2>Pengguna terbaru</h2><p>Pengguna yang baru bergabung di ErgoJob</p></div>
            <a class="button button-secondary" href="{{ route('users.index') }}">Lihat semua <span>→</span></a>
        </div>
        <div class="table-scroll">
            <table class="user-table">
                <thead><tr><th>PENGGUNA</th><th>EMAIL</th><th>MINAT BIDANG</th><th>BERGABUNG</th><th>STATUS</th></tr></thead>
                <tbody>
                    <tr><td><div class="user-cell"><div class="avatar avatar-lavender">NA</div><strong>Nadia Aulia</strong></div></td><td>nadia.aulia@email.com</td><td><span class="interest-pill pill-tech">Teknologi</span></td><td>12 Agu 2024</td><td><span class="status-badge"><i></i>Aktif</span></td></tr>
                    <tr><td><div class="user-cell"><div class="avatar avatar-orange">RF</div><strong>Rizky Firmansyah</strong></div></td><td>rizky.f@email.com</td><td><span class="interest-pill pill-design">Desain</span></td><td>11 Agu 2024</td><td><span class="status-badge"><i></i>Aktif</span></td></tr>
                    <tr><td><div class="user-cell"><div class="avatar avatar-blue">SP</div><strong>Salsabila Putri</strong></div></td><td>salsa.putri@email.com</td><td><span class="interest-pill pill-business">Bisnis</span></td><td>10 Agu 2024</td><td><span class="status-badge"><i></i>Aktif</span></td></tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
