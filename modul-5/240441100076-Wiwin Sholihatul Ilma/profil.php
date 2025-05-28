<?php
$showForm = true;
$hasError = false;
$bahasa = $software = $os = $tingkat = $pengalaman = [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-500 min-h-screen p-10 font-sans text-black">

  <div class="max-w-3xl mx-auto bg-gray-200 shadow-xl rounded-xl p-8 border border-black">
    <h1 class="text-3xl font-bold mb-6 text-center text-black">Profil Mahasiswa</h1>

    <table class="table-auto border border-black mb-6 w-full text-sm text-black bg-gray-100">
      <tr class="bg-gray-300">
        <td class="border border-black px-4 py-2 font-semibold">Nama</td><td class="border border-black px-4 py-2">Wiwin Sholihatul Ilma</td>
      </tr>
      <tr>
        <td class="border border-black px-4 py-2 font-semibold">NIM</td><td class="border border-black px-4 py-2">240441100076</td>
      </tr>
      <tr class="bg-gray-300">
        <td class="border border-black px-4 py-2 font-semibold">Tempat, Tanggal Lahir</td><td class="border border-black px-4 py-2">Gresik, 28 April 2006</td>
      </tr>
      <tr>
        <td class="border border-black px-4 py-2 font-semibold">Email</td><td class="border border-black px-4 py-2">wiwinsholihatulilma@gmail.com</td>
      </tr>
      <tr class="bg-gray-300">
        <td class="border border-black px-4 py-2 font-semibold">Nomor HP</td><td class="border border-black px-4 py-2">082132653725</td>
      </tr>
    </table>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      function isFilled($field) {
        return isset($_POST[$field]) && !empty($_POST[$field]);
      }

      if (
        isFilled('bahasa') &&
        isFilled('pengalaman') &&
        isset($_POST['software']) &&
        isset($_POST['os']) &&
        isFilled('php')
      ) {
        $bahasa = $_POST['bahasa'];
        $pengalaman = htmlspecialchars($_POST['pengalaman']);
        $software = implode(", ", $_POST['software']);
        $os = $_POST['os'];
        $tingkat = $_POST['php'];
        $showForm = false;
      } else {
        $hasError = true;
        echo "<p class='text-red-600 mb-4 font-semibold'>⚠ Semua input wajib diisi!</p>";
      }
    }

    if (!$showForm): ?>
      <div class="mt-6 bg-gray-100 border border-black rounded-lg p-4 shadow-md text-black">
        <h2 class="text-xl font-semibold mb-4">Hasil Input:</h2>
        <table class="table-auto border border-black mb-4 w-full text-sm bg-gray-200 text-black">
          <tr><td class="border border-black px-4 py-2 font-medium">Bahasa Pemrograman</td><td class="border border-black px-4 py-2"><?= implode(", ", $bahasa); ?></td></tr>
          <tr><td class="border border-black px-4 py-2 font-medium">Software</td><td class="border border-black px-4 py-2"><?= $software; ?></td></tr>
          <tr><td class="border border-black px-4 py-2 font-medium">Sistem Operasi</td><td class="border border-black px-4 py-2"><?= $os; ?></td></tr>
          <tr><td class="border border-black px-4 py-2 font-medium">Tingkat PHP</td><td class="border border-black px-4 py-2"><?= $tingkat; ?></td></tr>
        </table>
        <p><strong>Pengalaman Proyek:</strong> <?= $pengalaman; ?></p>
        <?php if (count($bahasa) > 2): ?>
          <p class="text-green-700 font-semibold mt-2">Anda cukup berpengalaman dalam pemrograman!</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($showForm): ?>
      <form action="profil.php" method="POST" class="space-y-5 mt-6">
        <div>
          <label class="block font-semibold mb-1">Bahasa Pemrograman yang Dikuasai:</label>
          <div class="flex gap-2">
            <input type="text" name="bahasa[]" class="border border-black p-2 rounded w-full bg-gray-100 text-black" placeholder="Contoh: PHP">
            <input type="text" name="bahasa[]" class="border border-black p-2 rounded w-full bg-gray-100 text-black" placeholder="Contoh: JavaScript">
            <input type="text" name="bahasa[]" class="border border-black p-2 rounded w-full bg-gray-100 text-black" placeholder="Contoh: Python (opsional)">
          </div>
        </div>
        <div>
          <label class="block font-semibold mb-1">Pengalaman Proyek Pribadi:</label>
          <textarea name="pengalaman" class="w-full border border-black p-2 rounded bg-gray-100 text-black" rows="3" placeholder="Ceritakan proyekmu..."></textarea>
        </div>
        <div>
          <label class="block font-semibold mb-1">Software yang Sering Digunakan:</label>
          <div class="flex flex-wrap gap-4 text-sm text-gray-900">
            <label><input type="checkbox" name="software[]" value="VS Code"> VS Code</label>
            <label><input type="checkbox" name="software[]" value="XAMPP"> XAMPP</label>
            <label><input type="checkbox" name="software[]" value="Git"> Git</label>
            <label><input type="checkbox" name="software[]" value="Figma"> Figma</label>
          </div>
        </div>
        <div>
          <label class="block font-semibold mb-1">Sistem Operasi yang Digunakan:</label>
          <div class="flex gap-4 text-sm text-gray-900">
            <label><input type="radio" name="os" value="Windows"> Windows</label>
            <label><input type="radio" name="os" value="Linux"> Linux</label>
            <label><input type="radio" name="os" value="Mac"> Mac</label>
          </div>
        </div>
        <div>
          <label class="block font-semibold mb-1">Tingkat Penguasaan PHP:</label>
          <select name="php" class="border border-black p-2 rounded w-full bg-gray-100 text-black">
            <option value="">-- Pilih --</option>
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Mahir">Mahir</option>
          </select>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded shadow-md transition">Kirim</button>
      </form>
    <?php endif; ?>

    <a href="timeline.php" class="text-black-700 hover:underline mt-6 inline-block">➡ Menuju Timeline</a>
  </div>
</body>
</html>