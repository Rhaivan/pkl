@extends('layouts.admin')

@section('title', 'Ringkasan')
@section('section', 'Ringkasan')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Selamat datang, Admin</h1>
            <p>Ringkasan dihitung langsung dari data pengguna di database.</p>
        </div>
        <a class="button button-primary" href="{{ route('users.create') }}">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            Tambah pengguna
        </a>
    </div>

    <div class="stats-grid">
        <article class="stat-card">
            <div class="stat-top"><span>Total pengguna</span><span class="stat-icon mint"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg></span></div>
            <div class="stat-value">{{ number_format($totalPengguna, 0, ',', '.') }}</div>
            <div class="stat-foot"><span class="stat-muted">Data saat ini</span></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Perempuan</span><span class="stat-icon blue"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4"/><path d="M12 12v9m-4-4h8"/></svg></span></div>
            <div class="stat-value">{{ number_format($genderBreakdown[0]['count'], 0, ',', '.') }}</div>
            <div class="stat-foot"><span class="stat-muted">{{ number_format($genderBreakdown[0]['percent'], 1, ',', '.') }}% dari pengguna</span></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Laki-laki</span><span class="stat-icon violet"><svg viewBox="0 0 24 24" fill="none"><circle cx="10" cy="14" r="6"/><path d="m14.5 9.5 6-6m-5 0h5v5"/></svg></span></div>
            <div class="stat-value">{{ number_format($genderBreakdown[1]['count'], 0, ',', '.') }}</div>
            <div class="stat-foot"><span class="stat-muted">{{ number_format($genderBreakdown[1]['percent'], 1, ',', '.') }}% dari pengguna</span></div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span>Minat terpopuler</span><span class="stat-icon amber"><svg viewBox="0 0 24 24" fill="none"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z"/></svg></span></div>
            <div class="stat-value stat-text">{{ $topInterest['label'] ?? 'Belum ada data' }} <span>&middot; {{ number_format($topInterestPercent, 1, ',', '.') }}%</span></div>
            <div class="stat-foot"><span class="stat-muted">{{ number_format($topInterest['count'] ?? 0, 0, ',', '.') }} pengguna</span></div>
            <div class="interest-track"><span style="width: {{ min($topInterestPercent, 100) }}%"></span></div>
        </article>
    </div>

    <div class="dashboard-grid">
        <section class="panel activity-panel">
            <div class="panel-heading">
                <div><h2>Pendaftaran pengguna</h2><p>Pengguna yang mendaftar dalam 7 hari terakhir</p></div>
                <button class="select-button" type="button">7 hari terakhir</button>
            </div>
            <div class="chart-summary"><strong>{{ number_format($registrationTotal, 0, ',', '.') }}</strong><small>pendaftaran baru</small></div>
            <div class="chart-wrap">
                <div class="chart-y-labels">
                    @foreach ($chartYLabels as $label)
                        <span>{{ number_format($label, 0, ',', '.') }}</span>
                    @endforeach
                </div>
                <div class="chart">
                    <div class="chart-grid"><i></i><i></i><i></i><i></i><i></i></div>
                    @if ($registrationTotal > 0)
                        <svg class="chart-line" viewBox="0 0 700 180" preserveAspectRatio="none" role="img" aria-label="Grafik pendaftaran pengguna dalam 7 hari terakhir">
                            <defs><linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#b8ef72" stop-opacity=".2"/><stop offset="100%" stop-color="#b8ef72" stop-opacity="0"/></linearGradient></defs>
                            <path d="{{ $chartAreaPath }}" fill="url(#chartFill)"/>
                            <path d="{{ $chartLinePath }}" fill="none" stroke="#b8ef72" stroke-width="3" vector-effect="non-scaling-stroke"/>
                            @foreach ($chartPoints as $point)
                                <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4" fill="#b8ef72" stroke="#1b2017" stroke-width="3" vector-effect="non-scaling-stroke">
                                    <title>{{ $point['label'] }}: {{ $point['count'] }} pengguna</title>
                                </circle>
                            @endforeach
                        </svg>
                    @else
                        <div class="chart-empty">Belum ada pendaftaran bertanggal dalam 7 hari terakhir. Tanggal mulai tercatat untuk pendaftaran baru.</div>
                    @endif
                    <div class="chart-x-labels">
                        @foreach ($registrationDays as $day)
                            <span title="{{ $day['date'] }}">{{ $day['label'] }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="panel interests-panel">
            <div class="panel-heading"><div><h2>Bidang yang diminati</h2><p>Distribusi minat pengguna</p></div></div>
            <div class="interest-chart">
                <div class="donut" style="background: {{ $interestGradient }}">
                    <div><strong>{{ number_format($totalPengguna, 0, ',', '.') }}</strong><span>pengguna</span></div>
                </div>
                <div class="legend">
                    @forelse ($interestBreakdown as $item)
                        <div><i style="background: {{ $item['color'] }}"></i><span>{{ $item['label'] }}</span><strong>{{ number_format($item['percent'], 1, ',', '.') }}%</strong></div>
                    @empty
                        <p class="stat-muted">Belum ada data minat.</p>
                    @endforelse
                </div>
            </div>
            <a class="text-link" href="{{ route('users.index') }}">Lihat data pengguna <span>&rarr;</span></a>
        </section>
    </div>

    <section class="panel recent-panel">
        <div class="panel-heading recent-heading">
            <div><h2>Pengguna terbaru</h2><p>Diurutkan berdasarkan ID pengguna terbesar</p></div>
            <a class="button button-secondary" href="{{ route('users.index') }}">Lihat semua <span>&rarr;</span></a>
        </div>
        <div class="table-scroll">
            <table class="user-table">
                <thead><tr><th>PENGGUNA</th><th>EMAIL</th><th>JENIS KELAMIN</th><th>MINAT BIDANG</th><th>ID</th></tr></thead>
                <tbody>
                    @forelse ($latestPengguna as $item)
                        @php
                            $initials = collect(explode(' ', trim($item->nama)))
                                ->filter()
                                ->take(2)
                                ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                ->implode('');
                        @endphp
                        <tr>
                            <td><div class="user-cell"><div class="avatar avatar-lavender">{{ $initials ?: '?' }}</div><strong>{{ $item->nama }}</strong></div></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->minat ?: 'Belum diisi' }}</td>
                            <td>#{{ $item->id_pengguna }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">Belum ada data pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection