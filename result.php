<?php
session_start();
if (!isset($_SESSION['users']) || !isset($_SESSION['soal'])) {
  header('location:users/login.php');
  exit;
}

// koneksi ke database
require_once 'koneksi.php';

$jawaban_user = $_POST['jawaban'] ?? [];
$soal = $_SESSION['soal'];
$level = $_SESSION['level'] ?? 'easy';
$user_id = $_SESSION['users']['id_user'];
$username = $_SESSION['users']['username'];

$jumlah_benar = 0;

// cek jawaban
foreach ($soal as $item) {
  $id = $item['id'];
  $jawaban_benar = $item['jawaban'];
  $jawaban_input = isset($jawaban_user[$id]) ? trim($jawaban_user[$id]) : '';

  if (is_numeric($jawaban_input) && $jawaban_input == $jawaban_benar) {
    $jumlah_benar++;
  }
}

$total_soal = count($soal);
$skor = round(($jumlah_benar / $total_soal) * 100);

// simpan ke leaderboard
$stmt = $koneksi->prepare("INSERT INTO leaderboard (user_id, username, level, score) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $user_id, $username, $level, $skor);
$stmt->execute();

$_SESSION['review'] = [
  'soal' => $soal,
  'jawaban_user' => $jawaban_user
];
// membersihkan session soal
unset($_SESSION['soal']);
unset($_SESSION['start_time']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Hasil Kuis</title>
  <link rel="stylesheet" href="styles/result.css">
</head>

<body>
  <div class="hasil">
    <h2>Hasil Kuis Kamu</h2>
    <p>Level: <?= ucfirst($level) ?></p>
    <p>Jumlah soal: <?= $total_soal ?></p>
    <p>Jawaban benar: <?= $jumlah_benar ?></p>
    <p class="skor">Skor: <?= $skor ?>%</p>
    <a href="index.php">Ulangi Kuis</a>
    <a href="leaderboard.php">Lihat Leaderboard</a>
    <a href="review.php">Lihat Review Jawaban</a>
  </div>
</body>

</html>