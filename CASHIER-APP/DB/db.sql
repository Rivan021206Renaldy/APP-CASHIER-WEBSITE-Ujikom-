CREATE DATABASE thrivemarket;
USE thrivemarket;

CREATE TABLE petugas (
    id_petugas INT AUTO_INCREMENT PRIMARY KEY,
    nama_petugas VARCHAR(255) NOT NULL,
    email_petugas VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE data_barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(50) NOT NULL,
    harga_barang DECIMAL(10, 2) NOT NULL, 
    stok_barang INT NOT NULL, 
    barcode VARCHAR(50) NOT NULL
);

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    tgl_transaksi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    bayar DECIMAL(10, 2) NOT NULL,
    total INT NOT NULL,
    kembali INT NOT NULL,
    id_petugas INT,
    FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas)
);

CREATE TABLE transaksi_detail (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    qty INT NOT NULL, 
    sub_total DECIMAL(10, 2) NOT NULL,
    diskon DECIMAL(5, 2) NOT NULL,
    id_barang INT,
    id_transaksi INT,
    FOREIGN KEY (id_barang) REFERENCES data_barang(id_barang),
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi)
);
