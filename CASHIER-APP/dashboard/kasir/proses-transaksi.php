<?php
session_start();
include '../../function-s.functions.php'; // sesuaikan path ke file koneksi lo

if (isset($_POST['submit'])) {
    $total = floatval($_POST['total']);
    $id_petugas = $_SESSION['id_petugas']; // pastikan lo simpan id_petugas saat login

    // Simpan ke tabel transaksi
    $tanggal = date('Y-m-d H:i:s');
    $query_transaksi = "INSERT INTO transaksi (tanggal, total, id_petugas) VALUES ('$tanggal', '$total', '$id_petugas')";
    mysqli_query($conn, $query_transaksi);

    // Ambil ID transaksi terakhir
    $id_transaksi = mysqli_insert_id($conn);

    // Simpan semua item ke tabel transaksi_detail
    foreach ($_SESSION['keranjang'] as $item) {
        $id_barang = $item['id_barang'];
        $qty = $item['qty'];
        $sub_total = $item['sub_total'];
        $diskon = $item['diskon'];

        $query_detail = "INSERT INTO transaksi_detail (qty, sub_total, diskon, id_barang, id_transaksi)
                         VALUES ('$qty', '$sub_total', '$diskon', '$id_barang', '$id_transaksi')";
        mysqli_query($conn, $query_detail);
    }

    // Kosongkan keranjang
    unset($_SESSION['keranjang']);

    // Redirect ke halaman sukses atau laporan
    echo "<script> alert ('Transaksi Berhasil '); window.location='transaksi-succes.php'; </script>";
    exit;
}
?>
