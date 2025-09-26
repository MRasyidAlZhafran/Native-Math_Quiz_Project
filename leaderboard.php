<?php
require_once 'koneksi.php';

$result = $koneksi->query("SELECT username, level, score, created_at FROM leaderboard ORDER BY score DESC, created_at ASC LIMIT 10");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Leaderboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles/leaderboard.css">
</head>

<body>
  <h2><i class="fas fa-trophy"></i> Leaderboard</h2>
  <table>
    <tr>
      <th>Username</th>
      <th>Level</th>
      <th>Score</th>
      <th>Waktu</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= ucfirst($row['level']) ?></td>
        <td><?= $row['score'] ?>%</td>
        <td><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <footer>
    <a href="index.php" class="btn-back">
      < Kembali ke Beranda</a>
  </footer>
</body>

</html>