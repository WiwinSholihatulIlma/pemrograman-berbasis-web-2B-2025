<?php
$blog = [
    1 => [
        "judul" => "Belajar PHP Dasar",
        "tanggal" => "2025-05-16",
        "refleksi" => "Saya belajar dasar-dasar PHP, memahami sintaks, dan membuat form sederhana.",
        "gambar" => "img/artikel1.png",
        "sumber" => "https://www.petanikode.com/php-konsep/"
    ],
    2 => [
        "judul" => "Membangun Website Dinamis",
        "tanggal" => "2025-05-10",
        "refleksi" => "Saya membangun website interaktif menggunakan PHP embedded dan Tailwind CSS.",
        "gambar" => "img/artikel2.png",
        "sumber" => "https://www.petanikode.com/tailwind-dasar/"
    ]
];

function kutipanAcak() {
    $kutipan = [
        "“Belajar bukan tentang siapa yang paling cepat, tapi siapa yang paling konsisten.”",
        "“Jangan 
        takut gagal, karena gagal adalah bagian dari proses.”",
        "“Kode hari ini adalah fondasi kesuksesan esok.”"
    ];
    return $kutipan[rand(0, count($kutipan)-1)];
}

$id = $_GET['id'] ?? null;
$data = $id && isset($blog[$id]) ? $blog[$id] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog Reflektif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <nav class="mb-6">
        <a href="profil.php" class="text-blue-600 hover:underline">Profil Pribadi</a>
        <a href="timeline.php" class="text-blue-600 hover:underline">Timeline Kuliah</a>
        <?php if ($data): ?>
            <a href="blog.php" class="text-blue-600">← Kembali ke Daftar Artikel</a>
        <?php endif; ?>
    </nav>

    <?php if (!$data): ?>
        <!-- Tampilan Daftar Artikel -->
        <h1 class="text-2xl font-bold mb-4">Blog Reflektif</h1>
        <ul class="space-y-4">
            <?php foreach ($blog as $id => $artikel): ?>
                <li class="bg-white p-4 shadow rounded">
                    <a href="blog.php?id=<?= $id ?>" class="text-blue-600 font-semibold text-lg">
                        <?= $artikel['judul'] ?>
                    </a>
                    <p class="text-sm text-gray-600"><?= $artikel['tanggal'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <!-- Tampilan Detail Artikel -->
        <div class="bg-white p-6 shadow rounded">
            <h1 class="text-2xl font-bold"><?= $data['judul'] ?></h1>
            <p class="text-gray-600"><?= $data['tanggal'] ?></p>
            <img src="<?= $data['gambar'] ?>" alt="Gambar" class="w-1/2 h-64 object-cover my-4 rounded">
            <p class="mb-4"><?= $data['refleksi'] ?></p>
            <blockquote class="italic text-green-700 border-l-4 pl-4 border-green-500 mb-4">
                <?= kutipanAcak() ?>
            </blockquote>
            <a href="<?= $data['sumber'] ?>" target="_blank" class="text-blue-600 underline">Sumber Referensi</a>
        </div>
    <?php endif; ?>

</body>
</html>