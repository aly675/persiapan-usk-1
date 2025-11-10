<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = "absensi";

    protected $fillable = [
        'id_siswa',
        'id_guru',
        'status',
        'alasam'
    ];

     /**
     * Relasi BelongsTo (Satu Absensi dimiliki oleh satu Siswa)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        // Relasi ke model Siswa, merujuk ke 'id_siswa'
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi BelongsTo (Satu Absensi dimiliki (dicatat) oleh satu Guru)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru(): BelongsTo
    {
        // Relasi ke model Guru, merujuk ke 'id_guru'
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
