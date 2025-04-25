<?php 

$conn = mysqli_connect("localhost","root","","thrive_market");

// Fungsi Register & Login

function regis($conn, $data){
    global $conn;

    $nama = mysqli_real_escape_string($conn,$data['nama_petugas']);
    $email = mysqli_real_escape_string($conn,$data['email_petugas']);
    $username = mysqli_real_escape_string($conn,$data['username']);
    $password = mysqli_real_escape_string($conn,$data['password']);
    $role = $data['role'];

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO petugas (nama_petugas,email_petugas,username,password,role) VALUES ('$nama','$email','$username','$password_hashed','$role')";

    return mysqli_query($conn, $query);
}

function sign($conn,$data){
global $conn;

$username = mysqli_real_escape_string($conn, $data['username']);
$password = mysqli_real_escape_string($conn, $data['password']);

$query = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");


if(mysqli_num_rows($query) > 0){
    $result = mysqli_fetch_assoc($query);
}

if(password_verify($password,$result['password'])){
    startSession($result);
    echo "<script> alert('Berhasil Login'); window.location='../Beranda/index.php';</script>";
} else {
    echo "<script> alert('Silahkan Login Kembali'); window.location='login.php';</script>";
}

}
    
function startSession($data) {
    global $conn;
    
    $_SESSION['id_petugas'] = $data['id_petugas'];
    $_SESSION['nama_petugas'] = $data['nama_petugas'];
    $_SESSION['username'] = $data['username']; 
    $_SESSION['role'] = $data['role']; // Bisa jg klao pk  data lain    
}


// End Fungsi Register & Login

// Fungsi petugas

function dftPetugas($data){

    global $conn;

    $query = mysqli_query($conn,$data);
    $rows = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    return $rows;
}

function edtPetugas($data){
    
    global $conn;
    
    $id = $data['id_petugas'];
    $nama = mysqli_real_escape_string($conn, $data['nama_petugas']);
    $email = mysqli_real_escape_string($conn, $data['email_petugas']);
    $username = mysqli_real_escape_string($conn, $data['username']);

    $query = "UPDATE petugas SET 
              nama_petugas = '$nama',
              email_petugas = '$email',
              username = '$username'
              WHERE id_petugas = '$id'";

    if ( mysqli_query($conn, $query)) {
        echo "<script> alert('Data berhasil diubah'); window.location='petugas.php'; </script>";
    } else {
        echo "<script> alert('Data gagal diubah'); window.location='petugas.php'; </script>";
    }
}


// End Fungsi Petugas

// Fungsi Barang

function tambahB($conn,$data){
    global $conn;
    $nama = mysqli_real_escape_string($conn, $data['nama_barang']);
    $harga = mysqli_real_escape_string($conn, $data['harga_barang']);
    $stok = mysqli_real_escape_string($conn, $data['stok_barang']);
    $barcode = mysqli_real_escape_string($conn, $data['barcode']);

    $query = "INSERT INTO data_barang (nama_barang,harga_barang,stok_barang,barcode) VALUES ('$nama','$harga','$stok','$barcode')";
    
    return mysqli_query($conn, $query);
}

function daftarB($data){
    global $conn;

    $rows = [];
    $query = mysqli_query($conn, $data);

    while ($row = mysqli_fetch_assoc($query)){
        $rows[] = $row;       
    }
    return $rows;
}

function editB($data){
    global $conn;

    $id = $data['id_barang'];
    $nama = mysqli_real_escape_string($conn, $data['nama_barang']);
    $harga = mysqli_real_escape_string($conn, $data['harga_barang']);
    $stok = mysqli_real_escape_string($conn, $data['stok_barang']);
    $barcode = mysqli_real_escape_string($conn, $data['barcode']);

    $query = "UPDATE data_barang SET 
                nama_barang = '$nama', 
                harga_barang = '$harga', 
                stok_barang = '$stok', 
                barcode = '$barcode' 
              WHERE id_barang = $id";

    if(mysqli_query($conn,$query)){
        echo "<script> alert('Data berhasil diubah'); window.location='daftar_barang.php'; </script>";
    } else {
        echo "<script> alert('Data gagal diubah'); window.location='daftar_barang.php'; </script>";
    }
}

// End Fungsi Barang


// Fungsi Kasir

function getBarangByBarcode($barcode) {
    global $conn; // pakai koneksi global

    $query = mysqli_query($conn, "SELECT * FROM data_barang WHERE barcode = '$barcode'");
    if (!$query) {
        return null;
    }

    return mysqli_fetch_assoc($query);
}

function transaksi($data){

    global $conn;

    $bayar = mysqli_real_escape_string($conn, $data['bayar']);
    $total = mysqli_real_escape_string($conn, $data['total']);
    $kembali = mysqli_real_escape_string($conn, $data['kembali']);

    $query = mysqli_query($conn, "INSERT INTO transaksi (bayar, total, kembali) VALUES ('$bayar', '$total', '$kembali')");
    $result = mysqli_fetch_assoc($query);

    if (mysqli_query($conn, $result)){
        trans_detail($result['id_transaksi']);
    }
}   

function trans_detail($data){

}

// End Fungsi Kasir


?>