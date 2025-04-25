<?php 
 
include "../../function-s/functions.php";

if( ! isset ($_GET['id_petugas'])){
    echo "<script> alert('Data tidak ditemukan'); window.location='petugas.php'; </script>";
}

$id = $_GET['id_petugas'];

$query = "DELETE  FROM petugas WHERE id_petugas = '$id'";
if(mysqli_query($conn, $query)){
    echo "<script> alert('Berhasil dihapus'); window.location='petugas.php';</script>";
} else {
    echo "<script> alert('Gagal dihapus'); window.location='petugas.php';</script>";
}

?>