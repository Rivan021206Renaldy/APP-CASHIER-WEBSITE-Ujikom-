<?php
session_start();
include('../../function-s/functions.php');

if (isset($_POST['submit'])) {
    // Ambil total transaksi dan pembayaran
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $tgl_transaksi = date('Y-m-d H:i:s'); // Tanggal transaksi, sesuaikan format jika perlu
    $id_petugas = 1; // Ganti dengan ID petugas yang sedang login jika ada

    // Validasi pembayaran cukup dan tidak berlebih
    if ($bayar < $total) {
        echo "Pembayaran kurang dari total. Silakan coba lagi.";
        exit;
    }
    $kembali = $bayar - $total;
    if ($kembali < 0) {
        $kembali = 0;
    }

    // Insert ke tabel transaksi
    $query = "INSERT INTO transaksi (total, bayar, kembali, tgl_transaksi, id_petugas) 
              VALUES ('$total', '$bayar', '$kembali', '$tgl_transaksi', '$id_petugas')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query error: " . mysqli_error($conn);
        exit;
    }

    if ($result) {
        // Ambil ID transaksi yang baru saja disimpan
        $id_transaksi = mysqli_insert_id($conn);

        // Loop untuk memasukkan detail transaksi ke tabel transaksi_detail
        foreach ($_SESSION['keranjang'] as $item) {
            $id_barang = $item['id_barang'];
            $qty = $item['qty'];
            $sub_total = $item['sub_total'];
            $diskon = $item['diskon'];

            // Insert ke tabel transaksi_detail
            $query_detail = "INSERT INTO transaksi_detail (qty, sub_total, diskon, id_barang, id_transaksi)
                             VALUES ('$qty', '$sub_total', '$diskon', '$id_barang', '$id_transaksi')";
            mysqli_query($conn, $query_detail);
        }

        // Setelah transaksi dan detail berhasil disimpan, kosongkan keranjang
        unset($_SESSION['keranjang']);

        // Redirect to receipt page with transaction ID
        header("Location: struk.php?id_transaksi=" . $id_transaksi);
        exit();
    } else {
        echo "Gagal memproses transaksi. Silakan coba lagi.<br>";
    }
}
?>
