<?php
session_start();

if (!isset($_SESSION['users'])) {
  header('location:users/login.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Math Quiz Project</title>
  <link rel="stylesheet" href="styles/home.css">
  <link rel="stylesheet" href="styles/about.css">
  <link rel="stylesheet" href="styles/notification.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="container">
    <header>
      <h1>Math Quiz Project</h1>
      <nav>
        <a href="index.php" class="btn-select"><i class="fas fa-home"></i>&nbsp;Home</a>
        <a href="about.php" class="btn-select">
          <i class="fas fa-info-circle"></i> Tentang Kuis
        </a>
        <a href="users/logout.php" class="btn-select"><i class="fa-solid fa-door-open"></i>&nbsp;Logout</a>
      </nav>
    </header>
    <div class="info-container">
      <div class="info-box">
        <h3>Tentang Aplikasi</h3>
        <p>Aplikasi ini adalah kuis matematika interaktif yang dirancang untuk melatih kemampuan berhitung secara menyenangkan dan menantang.</p>
      </div>

      <div class="info-box">
        <h3><i class="fas fa-sliders-h"></i> Tingkat Kesulitan</h3>
        <p>Tersedia tiga level: <br><strong>Easy</strong> (penjumlahan/pengurangan), <br><strong>Medium</strong> (perkalian/pembagian), <br><strong>Hard</strong> (kuadrat dan logika).</p>
      </div>

      <div class="info-box">
        <h3>
          <i class="fas fa-gears"></i> Fitur Utama
        </h3>
        <p style="font-weight: bold;">
          Soal acak dari database<br>
          Timer otomatis <br>
          Feedback jawaban <br>
          Leaderboard <br>
          Review jawaban <br>
        </p>
      </div>
    </div>
  </div>

</body>

</html>