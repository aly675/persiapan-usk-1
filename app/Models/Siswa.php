<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

    protected $fillble = [
        "nama",
        "password",
        "nis",
        "kelas",
        "jurusan",
        "jenis_kelamin",
        "alamat"
    ];
}
