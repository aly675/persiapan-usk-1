<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'nip',
        'password'
    ];

    public function absensi(): HasMany
    {
        // Relasi ke tabel absensi, merujuk ke 'id_guru'
        return $this->hasMany(Absensi::class, 'id_guru');
    }
}
