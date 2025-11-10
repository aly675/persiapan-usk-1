<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
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
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen Data Siswa</h1>

            <!-- Tombol Tambah -->
            <div class="mb-6">
                <a href="{{ route('siswa.tambah-siswa-page') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    + Tambah Siswa
                </a>
            </div>

            <!-- Notifikasi Sukses/Error -->
            @if(session('succes'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                    {{ session('succes') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel Data Siswa -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($datas as $key => $data)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->nis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->kelas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->jurusan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('siswa.edit-siswa-page', $data->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('siswa.delete-siswa', $data->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
