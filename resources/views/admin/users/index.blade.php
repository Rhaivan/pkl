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
        <div class="overview-item"><span class="overview-icon mint"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg></span><div><span>Total pengguna</span><strong>1.284</strong></div></div>
        <span class="overview-divider"></span>
        <div class="overview-item"><span class="overview-icon blue"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13h4l3-9 4 16 3-7h2"/></svg></span><div><span>Aktif bulan ini</span><strong>1.092 <small>85%</small></strong></div></div>
        <span class="overview-divider"></span>
        <div class="overview-item"><span class="overview-icon violet"><svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg></span><div><span>Pengguna baru</span><strong>86 <small class="positive-small">+12,8%</small></strong></div></div>
    </div>

    <section class="panel directory-panel">
        <div class="directory-toolbar">
            <div class="directory-title"><h2>Semua pengguna <span class="count-chip">1.284</span></h2><p>Daftar lengkap pengguna yang terdaftar.</p></div>
            <div class="table-tools">
                <label class="search-field">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 4.5 4.5"/></svg>
                    <input type="search" placeholder="Cari nama atau email..." aria-label="Cari nama atau email">
                </label>
                <button class="filter-button" type="button"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M7 12h10m-7 5h4"/></svg> Filter <span class="filter-dot"></span></button>
            </div>
        </div>
        <div class="table-scroll">
            <table class="user-table directory-table">
                <thead><tr><th><label class="check-wrap"><input type="checkbox" aria-label="Pilih semua pengguna"><span></span></label></th><th>PENGGUNA</th><th>EMAIL</th><th>JENIS KELAMIN</th><th>MINAT BIDANG</th><th>TANGGAL DAFTAR</th><th></th></tr></thead>
                <tbody>
                    <tr><td><label class="check-wrap"><input type="checkbox" aria-label="Pilih Nadia Aulia"><span></span></label></td><td><div class="user-cell"><div class="avatar avatar-lavender">NA</div><strong>Nadia Aulia</strong></div></td><td>nadia.aulia@email.com</td><td>Perempuan</td><td><span class="interest-pill pill-tech">Teknologi</span></td><td>12 Agu 2024</td><td><div class="row-actions"><a class="row-action" href="{{ route('users.edit', ['user' => 1]) }}" aria-label="Edit Nadia Aulia"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg></a><button class="row-action" type="button" aria-label="Hapus Nadia Aulia"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg></button></div></td></tr>
                    <tr><td><label class="check-wrap"><input type="checkbox" aria-label="Pilih Rizky Firmansyah"><span></span></label></td><td><div class="user-cell"><div class="avatar avatar-orange">RF</div><strong>Rizky Firmansyah</strong></div></td><td>rizky.f@email.com</td><td>Laki-laki</td><td><span class="interest-pill pill-design">Desain</span></td><td>11 Agu 2024</td><td><div class="row-actions"><a class="row-action" href="{{ route('users.edit', ['user' => 2]) }}" aria-label="Edit Rizky Firmansyah"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg></a><button class="row-action" type="button" aria-label="Hapus Rizky Firmansyah"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg></button></div></td></tr>
                    <tr><td><label class="check-wrap"><input type="checkbox" aria-label="Pilih Salsabila Putri"><span></span></label></td><td><div class="user-cell"><div class="avatar avatar-blue">SP</div><strong>Salsabila Putri</strong></div></td><td>salsa.putri@email.com</td><td>Perempuan</td><td><span class="interest-pill pill-business">Bisnis</span></td><td>10 Agu 2024</td><td><div class="row-actions"><a class="row-action" href="{{ route('users.edit', ['user' => 3]) }}" aria-label="Edit Salsabila Putri"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg></a><button class="row-action" type="button" aria-label="Hapus Salsabila Putri"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg></button></div></td></tr>
                    <tr><td><label class="check-wrap"><input type="checkbox" aria-label="Pilih Dimas Pratama"><span></span></label></td><td><div class="user-cell"><div class="avatar avatar-green">DP</div><strong>Dimas Pratama</strong></div></td><td>dimas.pratama@email.com</td><td>Laki-laki</td><td><span class="interest-pill pill-marketing">Pemasaran</span></td><td>09 Agu 2024</td><td><div class="row-actions"><a class="row-action" href="{{ route('users.edit', ['user' => 4]) }}" aria-label="Edit Dimas Pratama"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg></a><button class="row-action" type="button" aria-label="Hapus Dimas Pratama"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg></button></div></td></tr>
                    <tr><td><label class="check-wrap"><input type="checkbox" aria-label="Pilih Intan Maharani"><span></span></label></td><td><div class="user-cell"><div class="avatar avatar-pink">IM</div><strong>Intan Maharani</strong></div></td><td>intan.maharani@email.com</td><td>Perempuan</td><td><span class="interest-pill pill-tech">Teknologi</span></td><td>08 Agu 2024</td><td><div class="row-actions"><a class="row-action" href="{{ route('users.edit', ['user' => 5]) }}" aria-label="Edit Intan Maharani"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3a2.1 2.1 0 0 0-3-3L5.2 16.1 4 20Z"/></svg></a><button class="row-action" type="button" aria-label="Hapus Intan Maharani"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3"/></svg></button></div></td></tr>
                </tbody>
            </table>
        </div>
        <div class="table-pagination"><span>Menampilkan <strong>1–5</strong> dari <strong>1.284</strong> pengguna</span><div class="pagination-controls"><button type="button" disabled aria-label="Halaman sebelumnya">←</button><button type="button" class="current-page">1</button><button type="button">2</button><button type="button">3</button><span>...</span><button type="button">257</button><button type="button" aria-label="Halaman berikutnya">→</button></div></div>
    </section>
    
@endsection
