@extends('layouts.admin')

@php
    $isEdit = $mode === 'edit';
    $values = [
        'nama' => old('nama', $pengguna->nama),
        'email' => old('email', $pengguna->email),
        'jenis_kelamin' => old('jenis_kelamin', $pengguna->jenis_kelamin),
        'alamat' => old('alamat', $pengguna->alamat),
        'no_telepon' => old('no_telepon', $pengguna->no_telepon),
        'minat' => old('minat', $pengguna->minat),
    ];
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
            <form class="visual-form" method="POST" action="{{ $isEdit ? route('users.update', $pengguna) : route('users.store') }}">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="form-field">
                    <label for="nama">Nama pengguna <span>*</span></label>
                    <input id="nama" name="nama" type="text" maxlength="100" placeholder="Contoh: Nadia Aulia" value="{{ $values['nama'] }}" required>
                    @error('nama')<small class="field-error">{{ $message }}</small>@else<small>Masukkan nama lengkap pengguna.</small>@enderror
                </div>

                <div class="form-field">
                    <label for="email">Alamat email <span>*</span></label>
                    <div class="input-with-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3.5" y="5" width="17" height="14" rx="2"/><path d="m4.5 7 7.5 6 7.5-6"/></svg><input id="email" name="email" type="email" maxlength="100" placeholder="nama@email.com" value="{{ $values['email'] }}" required></div>
                    @error('email')<small class="field-error">{{ $message }}</small>@else<small>Gunakan email aktif dan unik.</small>@enderror
                </div>

                <div class="form-field">
                    <label for="no_telepon">Nomor telepon</label>
                    <div class="input-with-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7.2 3.5h2.4l1.2 4.2-1.8 1.8a14.4 14.4 0 0 0 5.5 5.5l1.8-1.8 4.2 1.2v2.4a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 5.2 5.7a2 2 0 0 1 2-2.2Z"/></svg><input id="no_telepon" name="no_telepon" type="tel" maxlength="15" placeholder="Contoh: 081234567890" value="{{ $values['no_telepon'] }}"></div>
                    @error('no_telepon')<small class="field-error">{{ $message }}</small>@else<small>Maksimal 15 karakter.</small>@enderror
                </div>

                <div class="form-field">
                    <label for="alamat">Alamat pengguna</label>
                    <textarea id="alamat" name="alamat" maxlength="255" placeholder="Masukkan alamat lengkap pengguna">{{ $values['alamat'] }}</textarea>
                    @error('alamat')<small class="field-error">{{ $message }}</small>@else<small>Maksimal 255 karakter.</small>@enderror
                </div>

                <div class="form-field">
                    <label>Jenis kelamin <span>*</span></label>
                    <div class="gender-options">
                        <label class="radio-card"><input type="radio" name="jenis_kelamin" value="Perempuan" @checked($values['jenis_kelamin'] === 'Perempuan') required><span class="radio-dot"></span><span>Perempuan</span><span class="gender-symbol">♀</span></label>
                        <label class="radio-card"><input type="radio" name="jenis_kelamin" value="Laki-laki" @checked($values['jenis_kelamin'] === 'Laki-laki') required><span class="radio-dot"></span><span>Laki-laki</span><span class="gender-symbol">♂</span></label>
                    </div>
                    @error('jenis_kelamin')<small class="field-error">{{ $message }}</small>@enderror
                </div>

                <div class="form-field">
                    <label for="minat">Minat bidang pekerjaan</label>
                    <div class="select-wrap">
                        <select id="minat" name="minat">
                            <option value="">Pilih bidang yang diminati</option>
                            @foreach (['Teknologi', 'Desain', 'Bisnis', 'Pemasaran', 'Pendidikan', 'Kesehatan', 'Lainnya'] as $interest)
                                <option value="{{ $interest }}" @selected($values['minat'] === $interest)>{{ $interest }}</option>
                            @endforeach
                            @if ($values['minat'] && ! in_array($values['minat'], ['Teknologi', 'Desain', 'Bisnis', 'Pemasaran', 'Pendidikan', 'Kesehatan', 'Lainnya'], true))
                                <option value="{{ $values['minat'] }}" selected>{{ $values['minat'] }}</option>
                            @endif
                        </select>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m7 10 5 5 5-5"/></svg>
                    </div>
                    @error('minat')<small class="field-error">{{ $message }}</small>@else<small>Bidang minat bersifat opsional.</small>@enderror
                </div>

                <div class="form-actions">
                    <a class="button button-secondary" href="{{ route('users.index') }}">Batal</a>
                    <button class="button button-primary" type="submit">{{ $isEdit ? 'Simpan perubahan' : 'Simpan pengguna' }} <span>→</span></button>
                </div>
            </form>
        </section>
        <aside class="form-aside">
            <div class="form-tip">
                <span class="tip-icon">✳</span><h3>Profil yang lengkap,<br>peluang yang lebih baik.</h3>
                <p>Informasi yang akurat membantu pengguna menemukan peluang kerja yang paling sesuai dengan minat dan potensinya.</p>
                <div class="tip-decoration"><span></span><span></span><span></span></div>
            </div>
            <div class="form-note"><span>ⓘ</span><p>Perubahan akan disimpan langsung ke tabel pengguna di database.</p></div>
        </aside>
    </div>
@endsection