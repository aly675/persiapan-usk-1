<?php

namespace App\Models;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = "siswa";

    protected $fillable = [
        "nama",
        "nis",
        "kelas",
        "jurusan",
        "jenis_kelamin",
        "alamat"
    ];

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }
}
