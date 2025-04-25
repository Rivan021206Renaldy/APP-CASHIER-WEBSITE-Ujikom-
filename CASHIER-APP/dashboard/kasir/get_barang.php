<?php
include "../../function-s/functions.php";

if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $data = getBarangByBarcode($barcode); // Panggil fungsi dari functions.php

    echo json_encode($data);
}
?>
