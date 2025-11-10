<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
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
            'nip'           => 'required|min:10|max:10',
            'password'      => 'required'
        ]);

        try{
               // HASH PASSWORD SEBELUM CREATE
            $validated['password'] = Hash::make($validated['password']);
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
        $guru = Guru::find($id);

        $validated = $request->validate([
            'nama'          => 'required',
            'nip'           => 'required|min:10|max:10',
            'password'      => 'required',
        ]);
        // HASH PASSWORD SEBELUM CREATE
        $validated['password'] = Hash::make($validated['password']);

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
            return redirect()->route('guru.daftar-guru-page')->with('succes', 'data berhasil dihapus');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', "gagal : ". $e->getMessage());
        }
    }

}
