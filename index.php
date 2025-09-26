<?php
session_start();

if (!isset($_SESSION['users'])) {
  header('location:users/login.php');
  exit;
}

$nama = $_SESSION['users']['nama'];
if (is_array($nama)) {
  $nama = isset($nama['nama']) ? $nama['nama'] : 'Pengguna';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Math Quiz Project</title>
  <link rel="stylesheet" href="styles/home.css">
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
    <main>
      <h2>Selamat datang, <?php echo htmlspecialchars($nama); ?>!</h2>
      <p>Siap untuk menguji keahlian matematikamu?</p>
      <form action="quiz.php" method="get">
        <label for="level">Pilih tingkat kesulitan:</label><br>
        <select name="level" id="level" required>
          <option value="easy">Mudah</option>
          <option value="medium">Sedang</option>
          <option value="hard">Sulit</option>
        </select><br><br>
        <button type="submit" class="btn">Mulai Kuis</button>
      </form>
      <a href="leaderboard.php" class="leaderboard">Lihat Leaderboard</a>
    </main>
  </div>

</body>

</html>