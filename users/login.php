<?php
session_start();
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login ke Website</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>

<body>

  <?php

  if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' and password='$password'");

    if (mysqli_num_rows($query) > 0) {
      $data = mysqli_fetch_array($query);
      $_SESSION['users'] = $data;
      echo '<script>alert("Welcome, ' . $data['nama'] . '"); location.href="../index.php" </script>';
    } else {
      echo "<script>alert('Username/Password Salah!');</script>";
    }
  }
  ?>
  <div class="fade-in">

    <form method="post">
      <div class="background">
        <table align="center">
          <tr>
            <td colspan="2" align="center">
              <h3>Login User</h3>
            </td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
          </tr>
          <tr>
          <tr>
            <td></td>
            <td>
              <button type="submit" class="button-login">Login</button>
              <a href="daftar.php" class="button-daftar">Daftar</a>
            </td>
          </tr>
          </tr>
        </table>
      </div>
    </form>
  </div>
</body>

</html>