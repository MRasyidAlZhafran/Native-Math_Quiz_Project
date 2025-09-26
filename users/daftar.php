<?php
session_start();
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar ke Website</title>
  <link rel="stylesheet" href="../styles/daftar.css"> <!-- gunakan login.css -->
</head>

<body>
  <div class="fade-in">
    <div class="background">
      <form method="post">
        <h3>Pendaftaran User</h3>
        <table>
          <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username" required></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button type="submit" class="button-login">Daftar User</button>
              <a href="login.php" class="button-daftar">Login</a>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>

  <?php
  if (isset($_POST['username'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "INSERT INTO users(nama,username,password) VALUES('$nama','$username','$password')");
    if ($query) {
      echo "<script>
        alert('Berhasil mendaftar! Silakan login.');
        window.location.href = 'login.php';
      </script>";
    } else {
      echo "<script>alert('Gagal mendaftar.')</script>";
    }
  }
  ?>
</body>

</html>