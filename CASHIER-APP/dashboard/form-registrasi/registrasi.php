<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <form action="" method="POST" class="p-5 bg-white rounded shadow" style="width: 100%; max-width: 450px;">
        <h2 class="text-center mb-4">Registrasi</h2>
        <div class="mb-3">
          <label for="nama_petugas" class="form-label">Nama Petugas :</label>
          <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required />
        </div>
        <div class="mb-3">
          <label for="email_petugas" class="form-label">Email Petugas :</label>
          <input type="email" class="form-control" id="email_petugas" name="email_petugas" required />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username :</label>
          <input type="text" class="form-control" id="username" name="username" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password :</label>
          <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role :</label>
          <select class="form-select" id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Daftar</button>
        <div class="text-center mt-3">
          <a href="../form-login/index.php">Sudah punya akun? Silahkan Login</a>
        </div>
      </form>
    </div>


<?php 
include "../../function-s/functions.php";
if (isset($_POST['submit'])){
  $query = regis($conn, $_POST);
  if ($query) {
    echo "<script> alert('Kamu Berhasil Daftar'); window.location='../form-login/index.php';</script>";
  } else {
    echo "<script> alert('Kamu Gagal Daftar'); window.location='registrasi.php';</script>";
  }
}
?>
  </body>
</html>
