<?php
session_start();
//Mendapatkan id porduk dari url
$id_produk = $_GET['id'];

//jiga sudah ada produk dikeranjang
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
} else {
    $_SESSION['keranjang'][$id_produk] = 1;
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

//pergi ke halaman keranjang
echo "<script>alert('Produk Berhasil Disimpan Di Keranjang');</script>";
echo "<script>location='index.php';</script>";
