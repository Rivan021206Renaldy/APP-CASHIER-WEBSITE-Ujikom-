<?php 

include "../../function-s/functions.php";
$id = $_GET['id_barang'];

$query = "DELETE FROM data_barang WHERE id_barang = '$id'";
if(mysqli_query($conn, $query)){
    echo "<script> alert('Data berhasil Dihapus'); window.location='daftar_barang.php'; </script>";
} else {
    echo "<script> alert('Data gagal dihapus'); window.location='daftar_barang.php';</script>";
}

?>