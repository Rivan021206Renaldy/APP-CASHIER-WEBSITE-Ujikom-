<?php
session_start();
session_unset(); // hapus semua variabel session
session_destroy(); // hancurkan session

echo "<script> alert('Anda Telah Log out'); window.location.href = '../form-login/index.php';</script>";
exit;
?>
