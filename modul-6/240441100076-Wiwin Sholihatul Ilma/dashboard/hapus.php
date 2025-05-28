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

// Hapus data
$stmt = $conn->prepare("DELETE FROM karyawan_absensi WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: karyawan.php?msg=deleted");
    exit;
} else {
    echo "Gagal menghapus data.";
}
?>
