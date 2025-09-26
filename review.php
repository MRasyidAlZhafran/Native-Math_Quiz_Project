<?php
session_start();
if (!isset($_SESSION['review'])) {
  echo "Data review tidak tersedia.";
  exit;
}

$soal = $_SESSION['review']['soal'];
$jawaban_user = $_SESSION['review']['jawaban_user'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Review Jawaban</title>
  <link rel="stylesheet" href="styles/review.css">
</head>

<body>
  <h2>Review Jawaban</h2>
  <?php foreach ($soal as $item):
    $id = $item['id'];
    $pertanyaan = $item['pertanyaan'];
    $jawaban_benar = $item['jawaban'];
    $jawaban_input = isset($jawaban_user[$id]) ? trim($jawaban_user[$id]) : '';
    $is_benar = is_numeric($jawaban_input) && $jawaban_input == $jawaban_benar;
  ?>
    <div class="soal-review <?= $is_benar ? 'benar' : 'salah' ?>">
      <p><strong><?= $pertanyaan ?></strong></p>
      <p>Jawaban kamu: <?= htmlspecialchars($jawaban_input) ?> <?= $is_benar ? '✅' : '❌' ?></p>
      <?php if (!$is_benar): ?>
        <p>Jawaban benar: <?= $jawaban_benar ?></p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  <a href="index.php" class="btn-back">
    < Kembali ke Beranda</a>
</body>

</html>