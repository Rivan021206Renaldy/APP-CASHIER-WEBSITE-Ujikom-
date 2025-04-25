<?php
session_start();
include('../../function-s/functions.php');

// Query untuk mendapatkan riwayat transaksi
$query = "SELECT t.id_transaksi, t.tgl_transaksi, t.total, t.bayar, t.kembali, p.nama_petugas 
          FROM transaksi t 
          INNER JOIN petugas p ON t.id_petugas = p.id_petugas 
          ORDER BY t.tgl_transaksi DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/sidebar.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Riwayat Transaksi</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Kembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_transaksi']) ?></td>
                    <td><?= date('d-m-Y H:i:s', strtotime($row['tgl_transaksi'])) ?></td>
                    <td><?= htmlspecialchars($row['nama_petugas']) ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['bayar'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['kembali'], 0, ',', '.') ?></td>
                    <td>
                        <a href="../kasir/struk.php?id_transaksi=<?= urlencode($row['id_transaksi']) ?>" class="btn btn-primary btn-sm" target="_blank">Lihat Struk</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../Beranda/index.php" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
    </div>
</body>
</html>
