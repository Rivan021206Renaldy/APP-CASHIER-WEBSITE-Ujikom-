<?php 

session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Akun</title> 
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
          <li><a href="../Beranda/index.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'index.PHP') echo ' active'; ?>"><img src="../../img/img/home.png" alt="Beranda" class="icon-img" /> Beranda</a></li>
          <li><a href="../data_barang/daftar_barang.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'daftar_barang.php') echo ' active'; ?>"><img src="../../img/img/Data Barang.png" alt="Daftar Barang" class="icon-img" /> Daftar Barang</a></li>
          <li><a href="../kasir/transaksi.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'transaksi.php') echo ' active'; ?>"><img src="../../img/img/Data Transaksi.png" alt="Kasir" class="icon-img" /> Kasir</a></li>
          <li><a href="../report_transaksi/form_transaksi.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'form_transaksi.php') echo ' active'; ?>"><img src="../../img/img/Report-Transaksi .png" alt="Laporan Transaksi" class="icon-img" /> Laporan Transaksi</a></li>
          <li><a href="../Petugas/petugas.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'petugas.php') echo ' active'; ?>"><img src="../../img/img/Akun.png" alt="Data Petugas" class="icon-img" /> Data Petugas</a></li>
          <li><a href="../Akun/akun.php" class="nav-link<?php if(basename($_SERVER['PHP_SELF']) == 'akun.php') echo ' active'; ?>"><img src="../../img/img/Akun.png" alt="Akun" class="icon-img" /> Akun</a></li>
        </ul>
    </div>
    <div class="main-content">
      <div class="container mt-5">
        <h2 class="mb-4 text-primary">Akun</h2>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<div class="alert alert-info">';
            echo '<h5>Informasi Akun Aktif:</h5>';
            echo '<p>Nama: ' . htmlspecialchars($_SESSION['user']['nama_petugas']) . '</p>';
            echo '<p>Username: ' . htmlspecialchars($_SESSION['user']['username']) . '</p>';
            echo '<p>Level: ' . htmlspecialchars($_SESSION['user']['level']) . '</p>';
            echo '</div>';
        } else {
            echo '<p class="text-warning">Tidak ada akun yang sedang aktif.</p>';
        }
        ?>
        <a href="logout.php" class="btn btn-danger mb-3">Log Out</a>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
