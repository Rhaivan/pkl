<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'minat',
    ];

    protected static function booted(): void
    {
        static::creating(function (Pengguna $pengguna): void {
            $pengguna->tanggal_daftar ??= now('Asia/Jakarta');
        });
    }
}