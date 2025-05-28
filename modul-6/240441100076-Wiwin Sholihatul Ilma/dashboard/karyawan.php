<?php
require '../config/db.php';
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM karyawan_absensi ORDER BY tanggal_absensi DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan & Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-full mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Data Karyawan & Absensi</h2>

        <!-- Tambahan pesan sukses hapus -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                Data berhasil dihapus!
            </div>
        <?php endif; ?>

        <a href="tambah.php" class="mb-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Data</a>
        <a href="index.php" class="ml-2 text-sm text-blue-600 underline">← Kembali ke Dashboard</a>

        <div class="overflow-x-auto mt-4">
            <table class="w-full table-auto border border-collapse border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">NIP</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Umur</th>
                        <th class="border px-4 py-2">JK</th>
                        <th class="border px-4 py-2">Departemen</th>
                        <th class="border px-4 py-2">Jabatan</th>
                        <th class="border px-4 py-2">Kota</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Masuk</th>
                        <th class="border px-4 py-2">Pulang</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center">
                            <td class="border px-2 py-1"><?= $no++ ?></td>
                            <td class="border px-2 py-1"><?= htmlspecialchars($row['nip']) ?></td>
                            <td class="border px-2 py-1"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="border px-2 py-1"><?= $row['umur'] ?></td>
                            <td class="border px-2 py-1"><?= $row['jenis_kelamin'] ?></td>
                            <td class="border px-2 py-1"><?= $row['departemen'] ?></td>
                            <td class="border px-2 py-1"><?= $row['jabatan'] ?></td>
                            <td class="border px-2 py-1"><?= $row['kota_asal'] ?></td>
                            <td class="border px-2 py-1"><?= $row['tanggal_absensi'] ?></td>
                            <td class="border px-2 py-1"><?= $row['jam_masuk'] ?></td>
                            <td class="border px-2 py-1"><?= $row['jam_pulang'] ?></td>
                            <td class="border px-2 py-1 space-x-1">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="bg-yellow-400 px-2 py-1 text-sm rounded hover:bg-yellow-500 text-white">Edit</a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="bg-red-500 px-2 py-1 text-sm rounded hover:bg-red-600 text-white" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
