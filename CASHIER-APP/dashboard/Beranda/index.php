<?php 

include "../../function-s/functions.php";

session_start();

if(! isset($_SESSION)){
  header('Location: ../form-login/login.php');
}

echo "Selamat Bertugas " .  $_SESSION['nama_petugas'] ;

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda</title>
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
        <li><a href="../Beranda/index.php" class="nav-link active"><img src="../../img/img/home.png" alt="Beranda" class="icon-img" /> Beranda</a></li>
        <li><a href="../data_barang/daftar_barang.php" class="nav-link"><img src="../../img/img/Data Barang.png" alt="Daftar Barang" class="icon-img" /> Daftar Barang</a></li>
        <li><a href="../kasir/transaksi.php" class="nav-link"><img src="../../img/img/Data Transaksi.png" alt="Kasir" class="icon-img" /> Kasir</a></li>
        <li><a href="../report_transaksi/form_transaksi.php" class="nav-link"><img src="../../img/img/Report-Transaksi .png" alt="Laporan Transaksi" class="icon-img" /> Laporan Transaksi</a></li>
        <li><a href="../Petugas/petugas.php" class="nav-link"><img src="../../img/img/Akun.png" alt="Data Petugas" class="icon-img" /> Data Petugas</a></li>
        <li><a href="../Akun/akun.php" class="nav-link"><img src="../../img/img/Akun.png" alt="Akun" class="icon-img" /> Akun</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="container mt-4">
        <h1>Selamat Bertugas, <?php echo $_SESSION['nama_petugas']; ?></h1>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
