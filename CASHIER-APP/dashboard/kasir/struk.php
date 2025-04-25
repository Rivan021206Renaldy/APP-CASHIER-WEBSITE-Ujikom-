<?php
session_start();
include('../../function-s/functions.php');

if (!isset($_GET['id_transaksi'])) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}

$id_transaksi = $_GET['id_transaksi'];

// Query transaksi
$query_transaksi = "SELECT t.id_transaksi, t.total, t.tgl_transaksi, t.bayar, t.kembali, p.nama_petugas 
                    FROM transaksi t 
                    INNER JOIN petugas p ON t.id_petugas = p.id_petugas 
                    WHERE t.id_transaksi = '$id_transaksi'";
$result_transaksi = mysqli_query($conn, $query_transaksi);

if (!$result_transaksi) {
    echo "Query error: " . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($result_transaksi) == 0) {
    echo "Transaksi tidak ditemukan.";
    exit;
}

$transaksi = mysqli_fetch_assoc($result_transaksi);

// Query detail transaksi
$query_detail = "SELECT d.qty, d.sub_total, d.diskon, db.nama_barang, db.harga_barang 
                 FROM transaksi_detail d 
                 INNER JOIN data_barang db ON d.id_barang = db.id_barang 
                 WHERE d.id_transaksi = '$id_transaksi'";
$result_detail = mysqli_query($conn, $query_detail);

if (!$result_detail) {
    echo "Query error: " . mysqli_error($conn);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi #<?php echo $id_transaksi; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            max-width: 600px;
            margin: 20px auto;
            font-family: monospace, monospace;
        }
        .struk-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .struk-table th, .struk-table td {
            padding: 5px;
            border-bottom: 1px dashed #ccc;
        }
        .total-row {
            font-weight: bold;
        }
        .print-button {
            margin-top: 20px;
            text-align: center;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="struk-header">
        <h2>Struk Transaksi</h2>
        <p>ID Transaksi: <?php echo $id_transaksi; ?></p>
        <p>Tanggal: <?php 
            $tgl = $transaksi['tgl_transaksi'];
            if ($tgl == '0000-00-00 00:00:00' || empty($tgl)) {
                echo '-';
            } else {
                echo date('d-m-Y H:i:s', strtotime($tgl));
            }
        ?></p>
        <p>Kasir: <?php echo htmlspecialchars($transaksi['nama_petugas']); ?></p>
        <p>Pembayaran: Rp <?php echo isset($transaksi['bayar']) ? number_format($transaksi['bayar'], 0, ',', '.') : '0'; ?></p>
        <p>Kembalian: Rp <?php echo isset($transaksi['kembali']) ? number_format($transaksi['kembali'], 0, ',', '.') : '0'; ?></p>
    </div>

    <table class="table struk-table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Diskon</th>
                <th>PPN 12%</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($item = mysqli_fetch_assoc($result_detail)) {
                // Calculate PPN 12% for each item subtotal (assuming sub_total stored includes discount but not PPN)
                $ppn = $item['sub_total'] * 0.12;
                $subtotal_including_ppn = $item['sub_total'] + $ppn;

                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['nama_barang']) . "</td>";
                echo "<td>Rp " . number_format($item['harga_barang'], 0, ',', '.') . "</td>";
                echo "<td>" . $item['qty'] . "</td>";
                echo "<td>" . $item['diskon'] . "%</td>";
                echo "<td>Rp " . number_format($ppn, 0, ',', '.') . "</td>";
                echo "<td>Rp " . number_format($subtotal_including_ppn, 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
            <tr class="total-row">
                <td colspan="5" class="text-end">Total</td>
                <td>Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="print-button">
        <button onclick="window.print()" class="btn btn-primary">Cetak Struk</button>
        <a href="transaksi.php" class="btn btn-secondary">Kembali ke Kasir</a>
    </div>
</body>
</html>
