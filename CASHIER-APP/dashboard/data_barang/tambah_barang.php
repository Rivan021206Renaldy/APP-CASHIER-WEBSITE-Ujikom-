<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../css/sidebar.css" />
  </head>
  <body class="bg-light">
    <div class="sidebar">
      <div class="brand">
        <img src="../../img/img/logo.png" alt="Logo Aplikasi Kasir" />
        <span class="brand-text">-Thrive Maket-</span>
      </div>
      <ul>
        <li><a href="../Beranda/index.php" class="nav-link"><span class="icon">&#8962;</span> Beranda</a></li>
        <li><a href="../data_barang/daftar_barang.php" class="nav-link"><span class="icon">&#128230;</span> Daftar Barang</a></li>
        <li><a href="../kasir/transaksi.php" class="nav-link"><span class="icon">&#128179;</span> Kasir</a></li>
        <li><a href="../report_transaksi/form_transaksi.php" class="nav-link"><span class="icon">&#128202;</span> Laporan Transaksi</a></li>
        <li><a href="../Akun/akun.php" class="nav-link"><span class="icon">&#128100;</span> Akun</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="container mt-4">
        <h2 class="mb-4 text-primary">Tambah Barang</h2>
        <form action="" method="POST" class="bg-white p-4 rounded shadow" style="max-width: 500px;">
          <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang :</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required />
          </div>
          <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang :</label>
            <input type="text" class="form-control" id="harga_barang" name="harga_barang" required />
          </div>
          <div class="mb-3">
            <label for="stok_barang" class="form-label">Stok Barang :</label>
            <input type="text" class="form-control" id="stok_barang" name="stok_barang" required />
          </div>
          <div class="mb-3">
            <label for="barcode" class="form-label">Barcode :</label>
            <input type="text" class="form-control" id="barcode" name="barcode" required />
          </div>
          <button type="submit" name="submit" class="btn btn-primary w-100">Tambah</button>
        </form>
      </div>
    </div>
<?php 
include "../../function-s/functions.php";
if ( isset ($_POST['submit'])){
  $result = tambahB($conn, $_POST);
  if ($result){
    echo "<script> alert ('Data berhasil ditambah'); window.location='daftar_barang.php';</script>";
  } else {
    echo "<script> alert('Data Gagal Ditambah'); window.location='tambah_barang.php';</script>";
  }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
