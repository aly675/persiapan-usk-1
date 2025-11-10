<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <!-- Navigasi Sederhana -->
    <nav class="bg-gray-800 text-white p-4 mb-8 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <span class="font-semibold text-lg">Admin Panel</span>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('guru.daftar-guru-page') }}" class="px-3 py-2 rounded hover:bg-gray-700">Data Guru</a>
                <a href="{{ route('siswa.daftar-siswa-page') }}" class="px-3 py-2 rounded bg-gray-700">Data Siswa</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Data Siswa</h1>

            <!-- Tampilkan Error Validasi (dari validate()) -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TAMBAHKAN INI: Tampilkan Error dari Catch (session 'error') -->
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Edit -->
            <form action="{{ route('siswa.edit-siswa', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <!-- Method spoofing untuk update -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $data->nama) }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS (Harus 10 digit)</label>
                        <input type="number" name="nis" id="nis" value="{{ old('nis', $data->nis) }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Kelas (DIRUBAH JADI SELECT) -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas" id="kelas" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="" disabled>Pilih Kelas</option>
                            <!-- Cek old() dulu, baru $data->kelas -->
                            <option value="x" {{ old('kelas', $data->kelas) == 'x' ? 'selected' : '' }}>X</option>
                            <option value="xi" {{ old('kelas', $data->kelas) == 'xi' ? 'selected' : '' }}>XI</option>
                            <option value="xii" {{ old('kelas', $data->kelas) == 'xii' ? 'selected' : '' }}>XII</option>
                        </select>
                    </div>

                    <!-- Jurusan (DIRUBAH JADI SELECT) -->
                    <div>
                        <!-- Ada typo di file sebelumnya 'font-mRPL', aku benerin jadi 'font-medium' -->
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <select name="jurusan" id="jurusan" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="" disabled>Pilih Jurusan</option>
                            <!-- Cek old() dulu, baru $data->jurusan -->
                            <option value="rpl" {{ old('jurusan', $data->jurusan) == 'rpl' ? 'selected' : '' }}>RPL</option>
                            <option value="ak" {{ old('jurusan', $data->jurusan) == 'ak' ? 'selected' : '' }}>AK</option>
                            <option value="br" {{ old('jurusan', $data->jurusan) == 'br' ? 'selected' : '' }}>BR</option>
                            <option value="mp" {{ old('jurusan', $data->jurusan) == 'mp' ? 'selected' : '' }}>MP</option>
                        </select>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Password (DIHAPUS) -->
                    <!--
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Masukkan password baru (wajib)">
                        <p class="mt-1 text-xs text-gray-500">Validasi-mu mewajibkan password diisi setiap kali edit.</p>
                    </div>
                    -->
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" required
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('alamat', $data->alamat) }}</textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('siswa.daftar-siswa-page') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
