<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Selamat datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
            <a href="../auth/logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="karyawan.php" class="bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600 text-center">
                Manajemen Karyawan & Absensi
            </a>
            <a href="tambah.php" class="bg-green-500 text-white p-6 rounded-lg shadow hover:bg-green-600 text-center">
                Tambah Data Baru
            </a>
        </div>
    </div>
</body>
</html>
