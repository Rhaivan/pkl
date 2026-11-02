<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('q')->toString());

        $pengguna = Pengguna::query()
            ->when($search !== '', function ($query) use ($search) {
                $term = '%' . $search . '%';

                $query->where(function ($query) use ($term) {
                    $query->where('nama', 'ilike', $term)
                        ->orWhere('email', 'ilike', $term)
                        ->orWhere('minat', 'ilike', $term);
                });
            })
            ->orderByDesc('id_pengguna')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'pengguna' => $pengguna,
            'search' => $search,
            'totalPengguna' => Pengguna::count(),
            'totalPerempuan' => Pengguna::where('jenis_kelamin', 'Perempuan')->count(),
            'totalLakiLaki' => Pengguna::where('jenis_kelamin', 'Laki-laki')->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.form', [
            'mode' => 'create',
            'pengguna' => new Pengguna(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $pengguna = Pengguna::create($this->validatedData($request));

        return redirect()
            ->route('users.index')
            ->with('status', 'Pengguna ' . $pengguna->nama . ' berhasil ditambahkan.');
    }

    public function edit(Pengguna $pengguna): View
    {
        return view('admin.users.form', [
            'mode' => 'edit',
            'pengguna' => $pengguna,
        ]);
    }

    public function update(Request $request, Pengguna $pengguna): RedirectResponse
    {
        $pengguna->update($this->validatedData($request, $pengguna));

        return redirect()
            ->route('users.index')
            ->with('status', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(Pengguna $pengguna): RedirectResponse
    {
        $nama = $pengguna->nama;
        $pengguna->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'Pengguna ' . $nama . ' berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Pengguna $pengguna = null): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('pengguna', 'email')->ignore($pengguna?->id_pengguna, 'id_pengguna'),
            ],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:15'],
            'minat' => ['nullable', 'string', 'max:150'],
        ], [
            'nama.required' => 'Nama pengguna wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.unique' => 'Email tersebut sudah digunakan pengguna lain.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'no_telepon.max' => 'Nomor telepon maksimal 15 karakter.',
            'minat.max' => 'Minat maksimal 150 karakter.',
        ]);
    }
}