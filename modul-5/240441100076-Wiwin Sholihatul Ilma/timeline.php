<?php
$pengalaman = [
  "Semester 1" => "Mengenal dunia pemrograman dan logika dasar.",
  "Semester 2" => "Belajar dasar-dasar web development.",
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Timeline Kuliah</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #e2e2e2;
      padding: 30px;
      color: #333;
      min-height: 100vh;
    }
    h1 {
      text-align: center;
      margin-bottom: 50px;
      font-size: 2.4rem;
      font-weight: 700;
      color: #555555;
    }
    .timeline {
      position: relative;
      max-width: 600px;
      margin: 0 auto;
      padding-left: 30px;
      border-left: 5px solid #888888;
    }
    .timeline-item {
      position: relative;
      margin-bottom: 50px;
      padding-left: 30px;
    }
    .timeline-item::before {
      content: '';
      position: absolute;
      left: -35px;
      top: 8px;
      width: 20px;
      height: 20px;
      background-color: #888888;
      border-radius: 50%;
      border: 4px solid #e2e2e2;
      box-sizing: content-box;
      cursor: default;
    }
    .semester {
      font-weight: 700;
      font-size: 1.3rem;
      margin-bottom: 6px;
      color: #444444;
    }
    .kegiatan {
      font-size: 1rem;
      line-height: 1.5;
      color: #666666;
    }
    .nav-links {
      max-width: 600px;
      margin: 60px auto 0;
      display: flex;
      justify-content: space-between;
    }
    .nav-links a {
      color: #555555;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: color 0.3s ease;
    }
    .nav-links a:hover {
      color: #333333;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h1>Timeline Pengalaman Kuliah</h1>

  <div class="timeline">
    <?php foreach ($pengalaman as $semester => $kegiatan): ?>
      <div class="timeline-item">
        <div class="semester"><?= htmlspecialchars($semester); ?></div>
        <div class="kegiatan"><?= htmlspecialchars($kegiatan); ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="nav-links">
    <a href="profil.php">← Kembali ke Profil</a>
    <a href="blog.php">Menuju Blog →</a>
  </div>
</body>
</html>