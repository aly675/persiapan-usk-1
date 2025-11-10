<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_page()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required|digits:10', // Sesuaikan validasinya
            'password' => 'required',
        ]);

        // Di sini kamu cek manual NIP dan Password (karena GuruController-mu pakai Hash)
        $guru = Guru::where('nip', $credentials['nip'])->first();

        if ($guru && Hash::check($credentials['password'], $guru->password)) {
            session(['guru' => $guru]);
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal
        return back()->with('error', 'NIP atau Password salah, bro.');
    }
}
