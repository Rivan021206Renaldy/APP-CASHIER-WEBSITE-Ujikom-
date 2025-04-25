<?php 

include "../../function-s/functions.php";

if ( !isset ($_GET)){
    echo "<script> alert('Data tidak ditemukan'); window.location='petugas.php'; </script>";
}

$id = $_GET['id_petugas'];
$query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id");

$data = mysqli_fetch_assoc($query);

if ( isset ($_POST['submit'])){
    edtPetugas($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Petugas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../../img/img/logo.png" alt="Logo Aplikasi Kasir" style="max-height: 40px;" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="../Beranda/index.php">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="../data_barang/daftar_barang.php">Daftar Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="../kasir/transaksi.php">Kasir</a></li>
            <li class="nav-item"><a class="nav-link" href="../report_transaksi/form_transaksi.php">Laporan Transaksi</a></li>
            <li class="nav-item"><a class="nav-link" href="../Petugas/petugas.php">Data Petugas</a></li>
            <li class="nav-item"><a class="nav-link" href="../Akun/akun.php">Akun</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-4">
      <h2 class="mb-4 text-primary">Edit Petugas</h2>
      <form action="" method="POST" class="bg-white p-4 rounded shadow" style="max-width: 500px;">
        <input type="hidden" name="id_petugas" value="<?= htmlspecialchars($data['id_petugas']); ?>" />
        <div class="mb-3">
          <label for="nama_petugas" class="form-label">Nama Petugas :</label>
          <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama Petugas" value="<?= htmlspecialchars($data['nama_petugas']); ?>" />
        </div>
        <div class="mb-3">
          <label for="email_petugas" class="form-label">Email Petugas :</label>
          <input type="text" class="form-control" id="email_petugas" name="email_petugas" placeholder="Email Petugas" value="<?= htmlspecialchars($data['email_petugas']); ?>" />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username :</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= htmlspecialchars($data['username']); ?>" />
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Ubah</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
