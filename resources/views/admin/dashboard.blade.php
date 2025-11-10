<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Inter Font -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navigasi Sederhana -->
    <nav class="bg-gray-800 text-white p-4 mb-8 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <span class="font-semibold text-lg">Admin Panel</span>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded bg-gray-700">Dashboard</a>
                <a href="{{ route('guru.daftar-guru-page') }}" class="px-3 py-2 rounded hover:bg-gray-700">Data Guru</a>
                <!-- TAMBAH LINK SISWA -->
                <a href="{{ route('siswa.daftar-siswa-page') }}" class="px-3 py-2 rounded hover:bg-gray-700">Data Siswa</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h1>
            <p class="text-gray-700">
                Selamat datang di Admin Panel. Silakan pilih menu di atas untuk mengelola data.
            </p>
        </div>
    </div>

</body>
</html>
