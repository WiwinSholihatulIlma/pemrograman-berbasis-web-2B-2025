<?php
require '../config/db.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$username || !$password || !$confirm_password) {
        $error = "Semua field wajib diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak sama!";
    } else {
        // Cek username sudah dipakai atau belum
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Hash password dan simpan user baru
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password_hash);
            if ($stmt->execute()) {
                header("Location: login.php?msg=registered");
                exit;
            } else {
                $error = "Gagal registrasi, coba lagi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Register - Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Register Akun</h1>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form id="registerForm" method="POST" class="space-y-5">
            <div>
                <label for="username" class="block font-semibold mb-1">Username</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" minlength="6" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>

            <div>
                <label for="confirm_password" class="block font-semibold mb-1">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="6" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Daftar</button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Sudah punya akun? <a href="login.php" class="text-blue-600 underline hover:text-blue-800">Login di sini</a>
        </p>
    </div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const pwd = document.getElementById('password').value;
    const confirmPwd = document.getElementById('confirm_password').value;

    if (pwd.length < 6) {
        alert('Password minimal 6 karakter');
        e.preventDefault();
        return;
    }

    if (pwd !== confirmPwd) {
        alert('Password dan konfirmasi password harus sama');
        e.preventDefault();
    }
});
</script>
</body>
</html>