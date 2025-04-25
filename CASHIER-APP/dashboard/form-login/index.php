<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <form action="" method="POST" class="p-5 bg-white rounded shadow" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <div class="mb-3">
          <label for="username" class="form-label">Username :</label>
          <input type="text" class="form-control" id="username" name="username" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password :</label>
          <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        <div class="text-center mt-3">
          <a href="../form-registrasi/registrasi.php">Belum Punya akun? Silahkan Daftar</a>
        </div>
      </form>
    </div>
<?php 
include "../../function-s/functions.php";
if(isset($_POST['login'])){
  $result = sign($conn, $_POST);
  $_SESSION['role'] = $data['role'];
  if ($_SESSION['role'] != $data['admin']) {
    header("Location: ../kasir/transaksi.php");
    exit;
  }
}
?>
  </body>
</html>
