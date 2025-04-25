<?php 
include "../../function-s/functions.php";

$result = dftPetugas("SELECT * FROM petugas");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Petugas</title>
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
        <li><a href="../Beranda/index.php" class="nav-link"><img src="../../img/img/home.png" alt="Beranda" class="icon-img" /> Beranda</a></li>
        <li><a href="../data_barang/daftar_barang.php" class="nav-link"><img src="../../img/img/Data Barang.png" alt="Daftar Barang" class="icon-img" /> Daftar Barang</a></li>
        <li><a href="../kasir/transaksi.php" class="nav-link"><img src="../../img/img/Data Transaksi.png" alt="Kasir" class="icon-img" /> Kasir</a></li>
        <li><a href="../report_transaksi/report-transaksi.php" class="nav-link"><img src="../../img/img/Report-Transaksi .png" alt="Laporan Transaksi" class="icon-img" /> Laporan Transaksi</a></li>
        <li><a href="../Petugas/petugas.php" class="nav-link active"><img src="../../img/img/Akun.png" alt="Data Petugas" class="icon-img" /> Data Petugas</a></li>
        <li><a href="../Akun/akun.php" class="nav-link"><img src="../../img/img/Akun.png" alt="Akun" class="icon-img" /> Akun</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="container mt-4">
        <h2 class="mb-4 text-primary">Daftar Petugas</h2>
        <table class="table table-striped table-bordered align-middle">
          <thead class="table-primary">
            <tr>
              <th>ID Petugas</th>
              <th>Nama Petugas</th>
              <th>Email Petugas</th>
              <th>Username</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row) : ?>
            <tr>
              <td><?= htmlspecialchars($row['id_petugas']);?></td>
              <td><?= htmlspecialchars($row['nama_petugas']);?></td>
              <td><?= htmlspecialchars($row['email_petugas']);?></td>
              <td><?= htmlspecialchars($row['username']);?></td>
              <td><?= htmlspecialchars($row['role']);?></td>
              <td>
                <a href="edit-petugas.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-warning btn-sm me-2">Edit</a>
                <a href="hapus-petugas.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus?')">Hapus</a>
              </td>
            </tr>
            <?php endforeach ;?>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
