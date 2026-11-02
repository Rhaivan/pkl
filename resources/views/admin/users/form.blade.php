@extends('layouts.admin')

@php
    $isEdit = $mode === 'edit';
@endphp

@section('title', $isEdit ? 'Edit pengguna' : 'Tambah pengguna')
@section('section', 'Pengguna')

@section('content')
    <div class="form-back"><a href="{{ route('users.index') }}">← <span>Kembali ke data pengguna</span></a></div>
    <div class="page-heading form-page-heading">
        <div>
            <div class="eyebrow"><span class="eyebrow-line"></span> MANAJEMEN PENGGUNA</div>
            <h1>{{ $isEdit ? 'Edit pengguna' : 'Tambah pengguna' }}</h1>
            <p>{{ $isEdit ? 'Perbarui informasi pengguna yang terdaftar di ErgoJob.' : 'Lengkapi informasi pengguna untuk menambahkannya ke ErgoJob.' }}</p>
        </div>
    </div>

    <div class="form-layout">
        <section class="panel user-form-panel">
            <div class="form-panel-title"><span class="form-title-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H7.4A3.4 3.4 0 0 0 4 18.4V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.7M20 20v-1.6a3.4 3.4 0 0 0-2.5-3.3"/></svg></span><div><h2>Informasi pengguna</h2><p>Informasi dasar dan preferensi karier pengguna.</p></div></div>
            <form class="visual-form">
                <div class="form-field">
                    <label for="full-name">Nama pengguna <span>*</span></label>
                    <input id="full-name" type="text" placeholder="Contoh: Nadia Aulia" value="{{ $isEdit ? 'Nadia Aulia' : '' }}" required>
                    <small>Masukkan nama lengkap pengguna.</small>
                </div>
                <div class="form-field">
                    <label for="email">Alamat email <span>*</span></label>
                    <div class="input-with-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3.5" y="5" width="17" height="14" rx="2"/><path d="m4.5 7 7.5 6 7.5-6"/></svg><input id="email" type="email" placeholder="nama@email.com" value="{{ $isEdit ? 'nadia.aulia@email.com' : '' }}" required></div>
                    <small>Gunakan email aktif yang dapat dihubungi.</small>
                </div>
                <div class="form-field">
                    <label for="phone">Nomor telepon <span>*</span></label>
                    <div class="input-with-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7.2 3.5h2.4l1.2 4.2-1.8 1.8a14.4 14.4 0 0 0 5.5 5.5l1.8-1.8 4.2 1.2v2.4a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 5.2 5.7a2 2 0 0 1 2-2.2Z"/></svg><input id="phone" type="tel" placeholder="Contoh: 0812 3456 7890" value="{{ $isEdit ? '0812 3456 7890' : '' }}" required></div>
                    <small>Masukkan nomor telepon aktif pengguna.</small>
                </div>
                <div class="form-field">
                    <label for="address">Alamat pengguna <span>*</span></label>
                    <textarea id="address" placeholder="Masukkan alamat lengkap pengguna" required>{{ $isEdit ? 'Jl. Melati No. 12, Jakarta Selatan' : '' }}</textarea>
                    <small>Masukkan alamat tempat tinggal pengguna.</small>
                </div>
                <div class="form-field">
                    <label>Jenis kelamin <span>*</span></label>
                    <div class="gender-options">
                        <label class="radio-card"><input type="radio" name="gender" value="perempuan" {{ $isEdit ? 'checked' : '' }}><span class="radio-dot"></span><span>Perempuan</span><span class="gender-symbol">♀</span></label>
                        <label class="radio-card"><input type="radio" name="gender" value="laki-laki"><span class="radio-dot"></span><span>Laki-laki</span><span class="gender-symbol">♂</span></label>
                    </div>
                </div>
                <div class="form-field">
                    <label for="interest">Minat bidang pekerjaan <span>*</span></label>
                    <div class="select-wrap"><select id="interest" required><option value="" disabled {{ $isEdit ? '' : 'selected' }}>Pilih bidang yang diminati</option><option {{ $isEdit ? 'selected' : '' }}>Teknologi</option><option>Desain</option><option>Bisnis</option><option>Pemasaran</option><option>Pendidikan</option><option>Kesehatan</option><option>Lainnya</option></select><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m7 10 5 5 5-5"/></svg></div>
                    <small>Pilih bidang pekerjaan yang paling sesuai dengan minat pengguna.</small>
                </div>
                <div class="form-actions">
                    <a class="button button-secondary" href="{{ route('users.index') }}">Batal</a>
                    <button class="button button-primary" type="button">{{ $isEdit ? 'Simpan perubahan' : 'Simpan pengguna' }} <span>→</span></button>
                </div>
            </form>
        </section>
        <aside class="form-aside">
            <div class="form-tip">
                <span class="tip-icon">✳</span><h3>Profil yang lengkap,<br>peluang yang lebih baik.</h3>
                <p>Informasi yang akurat membantu pengguna menemukan peluang kerja yang paling sesuai dengan minat dan potensinya.</p>
                <div class="tip-decoration"><span></span><span></span><span></span></div>
            </div>
            <div class="form-note"><span>ⓘ</span><p>Formulir ini masih berupa tampilan. Data belum disimpan ke database.</p></div>
        </aside>
    </div>
@endsection
