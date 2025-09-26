<?php
session_start();
if (!isset($_SESSION['users'])) {
  header('location:users/login.php');
  exit;
}

function generateSoal($level, $jumlah = 5)
{
  $soal = [];
  for ($i = 0; $i < $jumlah; $i++) {
    $a = rand(1, 20);
    $b = rand(1, 20);
    $operator = '+';
    $jawaban = 0;

    switch ($level) {
      case 'easy':
        $operator = rand(0, 1) ? '+' : '-';
        $jawaban = $operator === '+' ? $a + $b : $a - $b;
        break;
      case 'medium':
        $operator = rand(0, 1) ? '*' : '/';
        if ($operator === '*') {
          $jawaban = $a * $b;
        } else {
          $a = $a * $b;
          $jawaban = $a / $b;
        }
        break;
      case 'hard':
        $operator = '^';
        $jawaban = pow($a, 2);
        $b = 2;
        break;
    }

    $pertanyaan = "$a $operator $b = ?";
    $soal[] = ['id' => $i, 'pertanyaan' => $pertanyaan, 'jawaban' => $jawaban];
  }
  return $soal;
}

// Ambil level dari URL
$level = $_GET['level'] ?? 'easy';
$jumlah_soal = 5;

// Generate soal
$soal_terpilih = generateSoal($level, $jumlah_soal);
$_SESSION['soal'] = $soal_terpilih;
$_SESSION['level'] = $level;
$_SESSION['start_time'] = time();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Kuis Level <?= ucfirst($level) ?></title>
  <link rel="stylesheet" href="styles/quiz.css">
  <link rel="stylesheet" href="styles/quiz.css">
</head>

<body>
  <div class="container">
    <h1>Kuis Matematika - Level <?= ucfirst($level) ?></h1>
    <div id="timer">Sisa waktu: 60 detik</div>

    <form action="result.php" method="post">
      <?php foreach ($soal_terpilih as $index => $item): ?>
        <div class="soal">
          <p><strong>Soal <?= $index + 1 ?>:</strong> <?= $item['pertanyaan'] ?></p>
          <input type="number" name="jawaban[<?= $item['id'] ?>]" required>
        </div>
      <?php endforeach; ?>
      <button type="submit">Kirim Jawaban</button>
    </form>
  </div>

  <script>
    let waktu = <?= $level === 'easy' ? 60 : ($level === 'medium' ? 90 : 120) ?>;
    const timerEl = document.getElementById('timer');
    const form = document.querySelector('form');

    const countdown = setInterval(() => {
      if (waktu <= 0) {
        clearInterval(countdown);
        alert("Waktu habis! Jawaban akan dikirim.");
        form.submit();
      } else {
        timerEl.textContent = `Sisa waktu: ${waktu} detik`;
        waktu--;
      }
    }, 1000);
  </script>
</body>

</html>