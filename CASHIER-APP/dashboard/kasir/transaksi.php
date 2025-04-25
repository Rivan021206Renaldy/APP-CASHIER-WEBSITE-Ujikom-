ap<?php 
session_start();

if (isset($_POST['submit'])) {
    $id = $_POST['id_barang'];
    $nama = $_POST['nama_barang'];
    $harga = floatval($_POST['harga_barang']);
    $qty = intval($_POST['qty']);
    $diskon = floatval($_POST['diskon']);

    // Hitung subtotal setelah diskon
    $sub_total = $harga * $qty;
    $diskon_nominal = ($sub_total * $diskon) / 100;
    $sub_total_setelah_diskon = $sub_total - $diskon_nominal;

    // Hitung pajak 12% dari subtotal setelah diskon
    $ppn = $sub_total_setelah_diskon * 0.12;

    // Total subtotal termasuk pajak
    $sub_total_termasuk_ppn = $sub_total_setelah_diskon + $ppn;

    // Simpan ke keranjang
    $item = [
        'id_barang' => $id,
        'nama_barang' => $nama,
        'harga_barang' => $harga,
        'qty' => $qty,
        'diskon' => $diskon,
        'ppn' => $ppn,
        'sub_total' => $sub_total_termasuk_ppn
    ];

    $_SESSION['keranjang'][] = $item;

    // Hitung total pembayaran dari keranjang
    $total_bayar = 0;
    foreach ($_SESSION['keranjang'] as $cart_item) {
        $total_bayar += $cart_item['sub_total'];
    }
    $_SESSION['total_bayar'] = $total_bayar;

    header("Location: transaksi.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transaksi</title>
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
        <li><a href="../kasir/transaksi.php" class="nav-link active"><img src="../../img/img/Data Transaksi.png" alt="Kasir" class="icon-img" /> Kasir</a></li>
        <li><a href="../report_transaksi/report-transaksi.php" class="nav-link"><img src="../../img/img/Report-Transaksi .png" alt="Laporan Transaksi" class="icon-img" /> Laporan Transaksi</a></li>
        <li><a href="../Petugas/petugas.php" class="nav-link"><img src="../../img/img/Akun.png" alt="Data Petugas" class="icon-img" /> Data Petugas</a></li>
        <li><a href="../Akun/akun.php" class="nav-link"><img src="../../img/img/Akun.png" alt="Akun" class="icon-img" /> Akun</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="container mt-4">
        <h2 class="mb-4 text-primary">Transaksi</h2>
      <form action="" method="POST" class="bg-white p-4 rounded shadow mx-auto" style="max-width: 600px;">
          <div class="mb-3">
            <label for="barcode" class="form-label">Scan Barcode :</label>
            <input type="text" class="form-control" name="id_barang" id="barcode" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label for="id_barang" class="form-label">ID Barang :</label>
            <input type="text" class="form-control" name="id_barang" id="id_barang" readonly />
          </div>
          <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang :</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly />
          </div>
          <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang :</label>
            <input type="text" class="form-control" name="harga_barang" id="harga_barang" readonly />
          </div>
          <div class="mb-3">
            <label for="qty" class="form-label">Jumlah :</label>
            <input type="number" class="form-control" name="qty" id="qty" min="1" value="1" />
          </div>
          <div class="mb-3">
          <label for="diskon" class="form-label">Diskon per Barang (%) :</label>
            <input type="number" class="form-control" name="diskon" id="diskon" min="0" max="100" value="0" />
          </div>
          <div class="mb-3">
            <label for="sub_total" class="form-label">Subtotal :</label>
            <input type="text" class="form-control" name="sub_total" id="sub_total" readonly />
          </div>
          
          <button type="submit" name="submit" class="btn btn-primary w-100">Tambah Keranjang</button>
        </form>

      <!-- Menampilkan keranjang belanja -->
      <h3 class="mt-5">Keranjang Belanja</h3>
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Diskon (%)</th>
            <th>PPN 12%</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $total = 0;
          if (isset($_SESSION['keranjang'])) {
              foreach ($_SESSION['keranjang'] as $item) {
                  $total += $item['sub_total'];
                  echo "<tr>
                        <td>{$item['nama_barang']}</td>
                        <td>{$item['qty']}</td>
                        <td>{$item['diskon']}</td>
                        <td>" . number_format($item['ppn'], 0, ',', '.') . "</td>
                        <td>" . number_format($item['sub_total'], 0, ',', '.') . "</td>
                      </tr>";
              }
          }
          ?>
          <tr>
            <td colspan="4" class="text-end fw-bold">Total</td>
            <td class="fw-bold"><?= number_format($total, 0, ',', '.'); ?></td>
          </tr>
        </tbody>
      </table>

      <!-- Submit form untuk proses transaksi -->
      <form action="simpan-transaksi.php" method="POST" id="formTransaksi" class="mt-4">
        <input type="hidden" name="total" value="<?= $total; ?>" id="total" />
        <div class="mb-3">
          <label for="bayar" class="form-label">Pembayaran (Bayar):</label>
          <input type="number" class="form-control" name="bayar" id="bayar" min="<?= $total; ?>" required />
        </div>
        <button type="submit" name="submit" class="btn btn-success w-100">Checkout</button>
      </form>

      <script>
      document.getElementById('barcode').addEventListener('input', function() {
          const barcode = this.value;

          if (barcode.length >= 5) { 
              fetch('get_barang.php?barcode=' + barcode)
                  .then(res => res.json())
                  .then(data => {
                      if (data) {
                          document.getElementById('id_barang').value = data.id_barang;
                          document.getElementById('nama_barang').value = data.nama_barang;
                          document.getElementById('harga_barang').value = data.harga_barang;
                      } else {
                          document.getElementById('id_barang').value = '';
                          document.getElementById('nama_barang').value = 'Tidak ditemukan';
                          document.getElementById('harga_barang').value = '';
                      }
                  });
          }
      });

      function calculateSubtotal() {
          const harga = parseFloat(document.getElementById('harga_barang').value) || 0;
          const qty = parseInt(document.getElementById('qty').value) || 1;
          const diskon = parseFloat(document.getElementById('diskon').value) || 0;

          const subTotal = harga * qty;
          const diskonNominal = (subTotal * diskon) / 100;
          const subTotalSetelahDiskon = subTotal - diskonNominal;

          document.getElementById('sub_total').value = subTotalSetelahDiskon.toFixed(2);
      }

      document.getElementById('qty').addEventListener('input', calculateSubtotal);
      document.getElementById('diskon').addEventListener('input', calculateSubtotal);
      document.getElementById('harga_barang').addEventListener('input', calculateSubtotal);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
