<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function guru_dashboard_page()
    {
        return view('guru.dashboard');
    }

    /*
        daftar siswa
    */
    public function daftar_siswa_page()
    {
        $datas = Siswa::all();
        return view('guru.daftar-siswa', compact('datas'));
    }

    /*
        tambah siswa dan logic
    */
    public function tambah_siswa_page()
    {
        return view('guru.tambah-siswa');
    }

    public function tambah_siswa(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required',
            'password'      => 'required',
            'nis'           => 'required|integer|min:10|max:10',
            'kelas'         => 'required',
            'jurusan'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);

        try{
            Siswa::create($validated);
            return redirect()->route('guru.daftar-siswa-page')->with('succes', 'data berhasil disimpan');
        } catch(\Exception $e){
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        };
    }

    /*
        edit siswa dan logic
    */
    public function edit_siswa_page($id)
    {
        $data = Siswa::find($id);
        return view('guru.edit-siswa', compact('data'));
    }

    public function edit_siswa(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $validated = $request->validate([
            'nama'          => 'required',
            'password'      => 'required',
            'nis'           => 'required|integer|min:10|max:10',
            'kelas'         => 'required',
            'jurusan'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);

        try{
            $siswa->update($validated);
            return redirect()->route('guru.daftar-siswa-page')->with('succes', 'data berhasil diedit');
        } catch(\Exception $e){
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        };
    }

    /*
        Delete Siswa
    */
    public function hapus_siswa($id)
    {
        $siswa = Siswa::find($id);

        try{
            $siswa->delete();
            return redirect()->route('guru.daftar-siswa-page')->with('succes', 'data berhasil dihapus');
        } catch(\Exception $e){
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        };
    }

    /*
        daftar guru page
    */
    public function daftar_guru_page()
    {
        $datas = Guru::all();
        return view('guru.daftar-guru', compact('datas'));
    }

    /*
        tambah guru dan logic
    */
    public function tambah_guru_page()
    {
        return view('guru.tambah-guru');
    }

    public function tambah_guru(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required',
            'nip'           => 'required|integer|min:10|max:10',
            'password'      => 'required'
        ]);

        try{
            Guru::create($validated);
            return redirect()->route('guru.daftar-guru-page')->with('succes', 'data berhasil disimpan');
        } catch(\Exception $e){
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        };
    }

    /*
        edit guru dan login
    */
    public function edit_guru_page($id)
    {
        $data = Guru::find($id);

        return view('guru.edit-guru', compact('data'));
    }

    public function edit_guru(Request $request, $id)
    {
        $guru = Siswa::find($id);

        $validated = $request->validate([
            'nama'          => 'required',
            'nip'           => 'required|integer|min:10|max:10',
            'password'      => 'required',
        ]);

        try{
            $guru->update($validated);
            return redirect()->route('guru.daftar-guru-page')->with('succes', 'data berhasil diedit');
        } catch(\Exception $e){
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        };
    }

    public function delete_guru($id)
    {
        $guru = Guru::find($id);
        try{
            $guru->delete();
            return redirect('guru.daftar-guru-page')->with('succes', 'data berhasil dihapus');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        }
    }

}
