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
}