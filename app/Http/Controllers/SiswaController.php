<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
// Kita butuh ini untuk validasi unique di 'edit'
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /*
        daftar siswa
    */
    public function daftar_siswa_page()
    {
        $datas = Siswa::all();
        // GANTI KE VIEW SISWA
        return view('siswa.daftar-siswa', compact('datas'));
    }

    /*
        tambah siswa dan logic
    */
    public function tambah_siswa_page()
    {
        // GANTI KE VIEW SISWA
        return view('siswa.tambah-siswa');
    }

    public function tambah_siswa(Request $request)
    {
        // 1. PINDAHKAN VALIDASI KELUAR DARI TRY...CATCH
        $validated = $request->validate([
            'nama'          => 'required',
            // 'password'      => 'required', // <-- DIHAPUS BRO
            'nis'           => 'required|digits:10|unique:siswa,nis',
            'kelas'         => 'required',
            'jurusan'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);


        // 3. TRY...CATCH HANYA UNTUK OPERASI DATABASE
        try {
            Siswa::create($validated);
            return redirect()->route('siswa.daftar-siswa-page')->with('succes', 'data berhasil disimpan');
        } catch (\Exception $e) {
            // Ini akan menangkap error kalau database-nya mati, dll.
            return redirect()->back()->with('error', "gagal : " . $e->getMessage());
        };
    }

    /*
        edit siswa dan logic
    */
    public function edit_siswa_page($id)
    {
        $data = Siswa::find($id);
        // GANTI KE VIEW SISWA
        return view('siswa.edit-siswa', compact('data'));
    }

    public function edit_siswa(Request $request, $id)
    {
        // 1. PINDAHKAN VALIDASI KELUAR
        // Kita butuh $id untuk validasi unique
        $validated = $request->validate([
            'nama'          => 'required',
            // 'password'      => 'required', // <-- DIHAPUS BRO
            'nis'           => [
                'required',
                'digits:10',
                // Cek unique, TAPI abaikan (ignore) untuk $id siswa ini
                Rule::unique('siswa', 'nis')->ignore($id),
            ],
            'kelas'         => 'required',
            'jurusan'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);

        // 3. TRY...CATCH HANYA UNTUK OPERASI DATABASE
        try {
            // Cari siswa DULUAN, di luar try juga gapapa
            $siswa = Siswa::find($id);

            $siswa->update($validated);
            return redirect()->route('siswa.daftar-siswa-page')->with('succes', 'data berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "gagal : " . $e->getMessage());
        };
    }

    /*
        Delete Siswa
    */
    public function hapus_siswa($id)
    {
        $siswa = Siswa::find($id);

        try {
            $siswa->delete();
            // GANTI KE ROUTE SISWA
            return redirect()->route('siswa.daftar-siswa-page')->with('succes', 'data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "gagal : " . $e->getMessage());
        };
    }
}
