<?php
require '../config/db.php';
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: karyawan.php");
    exit;
}

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM karyawan_absensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    header("Location: karyawan.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jk = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    if (!$nip || !$nama || !$umur || !$jk || !$departemen || !$jabatan || !$kota || !$tanggal || !$jam_masuk || !$jam_pulang) {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = $conn->prepare("UPDATE karyawan_absensi SET nip=?, nama=?, umur=?, jenis_kelamin=?, departemen=?, jabatan=?, kota_asal=?, tanggal_absensi=?, jam_masuk=?, jam_pulang=? WHERE id=?");
        $stmt->bind_param("ssisssssssi", $nip, $nama, $umur, $jk, $departemen, $jabatan, $kota, $tanggal, $jam_masuk, $jam_pulang, $id);

        if ($stmt->execute()) {
            header("Location: karyawan.php?msg=updated");
            exit;
        } else {
            $error = "Gagal update data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Karyawan & Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Data Karyawan & Absensi</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form id="editForm" method="POST" class="space-y-4">
            <div>
                <label for="nip" class="block font-semibold mb-1">NIP</label>
                <input type="text" name="nip" id="nip" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['nip']) ?>" />
            </div>

            <div>
                <label for="nama" class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['nama']) ?>" />
            </div>

            <div>
                <label for="umur" class="block font-semibold mb-1">Umur</label>
                <input type="number" name="umur" id="umur" min="18" max="100" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['umur']) ?>" />
            </div>

            <div>
                <label class="block font-semibold mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div>
                <label for="departemen" class="block font-semibold mb-1">Departemen</label>
                <input type="text" name="departemen" id="departemen" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['departemen']) ?>" />
            </div>

            <div>
                <label for="jabatan" class="block font-semibold mb-1">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['jabatan']) ?>" />
            </div>

            <div>
                <label for="kota_asal" class="block font-semibold mb-1">Kota Asal</label>
                <input type="text" name="kota_asal" id="kota_asal" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['kota_asal']) ?>" />
            </div>

            <div>
                <label for="tanggal_absensi" class="block font-semibold mb-1">Tanggal Absensi</label>
                <input type="date" name="tanggal_absensi" id="tanggal_absensi" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['tanggal_absensi']) ?>" />
            </div>

            <div>
                <label for="jam_masuk" class="block font-semibold mb-1">Jam Masuk</label>
                <input type="time" name="jam_masuk" id="jam_masuk" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['jam_masuk']) ?>" />
            </div>

            <div>
                <label for="jam_pulang" class="block font-semibold mb-1">Jam Pulang</label>
                <input type="time" name="jam_pulang" id="jam_pulang" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?= htmlspecialchars($data['jam_pulang']) ?>" />
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Data</button>
            <a href="karyawan.php" class="ml-4 text-blue-600 underline hover:text-blue-800">Batal</a>
        </form>
    </div>

<script>
document.getElementById('editForm').addEventListener('submit', function(e) {
    const nip = document.getElementById('nip').value.trim();
    const nama = document.getElementById('nama').value.trim();
    const umur = parseInt(document.getElementById('umur').value, 10);
    const jk = document.getElementById('jenis_kelamin').value;
    const departemen = document.getElementById('departemen').value.trim();
    const jabatan = document.getElementById('jabatan').value.trim();
    const kota = document.getElementById('kota_asal').value.trim();
    const tanggal = document.getElementById('tanggal_absensi').value;
    const jamMasuk = document.getElementById('jam_masuk').value;
    const jamPulang = document.getElementById('jam_pulang').value;

    if (!nip || !nama || !umur || !jk || !departemen || !jabatan || !kota || !tanggal || !jamMasuk || !jamPulang) {
        alert('Semua field wajib diisi!');
        e.preventDefault();
        return;
    }

    if (umur < 18 || umur > 100) {
        alert('Umur harus antara 18 sampai 100 tahun.');
        e.preventDefault();
        return;
    }

    if (jamMasuk >= jamPulang) {
        alert('Jam pulang harus lebih besar dari jam masuk.');
        e.preventDefault();
        return;
    }
});
</script>
</body>
</html>