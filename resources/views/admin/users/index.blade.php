@extends('layouts.admin')

@section('title', 'Pengguna')
@section('section', 'Pengguna')

@section('content')
    <div class="page-heading users-page-heading">
        <div>
            <h1>Data pengguna</h1>
            <p>Kelola informasi dan minat karier pengguna ErgoJob.</p>
        </div>
        <a class="button button-primary" href="{{ route('users.create') }}">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            Tambah pengguna
        </a>
    </div>

    <div class="user-overview">
        <div class="overview-item"><span class="overview-icon mint"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg></span><div><span>Total pengguna</span><strong>{{ number_format($totalPengguna, 0, ',', '.') }}</strong></div></div>
        <span class="overview-divider"></span>
        <div class="overview-item"><span class="overview-icon blue"><svg viewBox="0 0 24 24" fill="none"><path d="M12 4v16M4 12h16"/></svg></span><div><span>Perempuan</span><strong>{{ number_format($totalPerempuan, 0, ',', '.') }}</strong></div></div>
        <span class="overview-divider"></span>
        <div class="overview-item"><span class="overview-icon violet"><svg viewBox="0 0 24 24" fill="none"><path d="M12 4v16M4 12h16"/></svg></span><div><span>Laki-laki</span><strong>{{ number_format($totalLakiLaki, 0, ',', '.') }}</strong></div></div>
    </div>

    <section class="panel directory-panel">
        <div class="directory-toolbar">
            <div class="directory-title">
                <h2>Semua pengguna <span class="count-chip">{{ number_format($pengguna->total(), 0, ',', '.') }}</span></h2>
                <p>Daftar pengguna yang tersimpan di database.</p>
            </div>
            <div class="table-tools">
                <form class="search-field" method="GET" action="{{ route('users.index') }}">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 4.5 4.5"/></svg>
                    <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama, email, atau minat..." aria-label="Cari pengguna">
                </form>
            </div>
        </div>

        @if (session('status'))
            <div class="crud-flash" role="status">{{ session('status') }}</div>
        @endif

        <div class="table-scroll">
            <table class="user-table directory-table">
                <thead>
                    <tr><th>PENGGUNA</th><th>EMAIL</th><th>JENIS KELAMIN</th><th>NO. TELEPON</th><th>MINAT</th><th>ALAMAT</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($pengguna as $item)
                        @php
                            $initials = collect(explode(' ', trim($item->nama)))
                                ->filter()
                                ->take(2)
                                ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                ->implode('');
                            $avatarColors = ['avatar-lavender', 'avatar-orange', 'avatar-blue', 'avatar-green', 'avatar-pink'];
                            $interestClass = match (mb_strtolower($item->minat ?? '')) {
                                'teknologi' => 'pill-tech',
                                'desain' => 'pill-design',
                                'bisnis' => 'pill-business',
                                'pemasaran' => 'pill-marketing',
                                default => '',
                            };
                        @endphp
                        <tr>
                            <td><div class="user-cell"><div class="avatar {{ $avatarColors[$item->id_pengguna % count($avatarColors)] }}">{{ $initials ?: '?' }}</div><strong>{{ $item->nama }}</strong></div></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->no_telepon ?: '—' }}</td>
                            <td>
                                @if ($item->minat)
                                    <span class="interest-pill {{ $interestClass }}">{{ $item->minat }}</span>
                                @else
                                    <span class="table-muted">Belum diisi</span>
                                @endif
                            </td>
                            <td class="address-cell" title="{{ $item->alamat }}">{{ $item->alamat ?: '—' }}</td>
                            <td>
                                <div class="row-actions">
                                    <a class="row-action" href="{{ route('users.edit', $item) }}" aria-label="Edit {{ $item->nama }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $item) }}" onsubmit="return confirm('Hapus data {{ addslashes($item->nama) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="row-action row-action-danger" type="submit" aria-label="Hapus {{ $item->nama }}">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="empty-state">{{ $search ? 'Tidak ada pengguna yang cocok dengan pencarian.' : 'Belum ada data pengguna.' }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-pagination">
            <span>Menampilkan <strong>{{ $pengguna->firstItem() ?? 0 }}–{{ $pengguna->lastItem() ?? 0 }}</strong> dari <strong>{{ $pengguna->total() }}</strong> pengguna</span>
            <div class="pagination-controls">{{ $pengguna->onEachSide(1)->links('pagination::simple-tailwind') }}</div>
        </div>
    </section>
@endsection