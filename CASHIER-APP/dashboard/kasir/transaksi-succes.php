<?php
session_start();
// Pastikan keranjang sudah dikosongkan setelah transaksi

include "../../function-s/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transaksi Berhasil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="text-center">
    <h1 class="text-success">Transaksi Berhasil!</h1>
    <p class="lead">Terima kasih sudah melakukan pembelian.</p>
    <a href="struk.php?id_transaksi=<?php echo isset($_POST['id_transaksi']) ? $_POST['id_transaksi'] : ''; ?>" class="btn btn-primary">Lihat Struk</a>
    <a href="transaksi.php" class="btn btn-secondary ms-2">Kembali ke Halaman Kasir</a>
  </div>
</body>
</html>
