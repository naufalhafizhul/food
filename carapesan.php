<?php
session_start();
include 'admin/dbconnect.php'
?>
<style>
    .service {
        width: 80%;
        margin: auto;
        text-align: center;
    }

    p {
        color: #777;
        font-size: 16px;
        font-weight: 300;
        line-height: 22px;
        padding: 10px;
    }

    .row {
        margin-top: 5%;
        display: flex;
        justify-content: space-between;
    }

    .service-col {
        flex-basis: 31%;
        background: #fff3f3;
        border-radius: 10px;
        margin-bottom: 5%;
        padding: 20px 12px;
        box-sizing: border-box;
        transition: 0.5s;
    }

    h3 {
        text-align: center;
        font-weight: 600;
        margin: 10px 0;
    }

    .service-col:hover {
        box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
    }

    @media(max-width: 700px) {
        .row {
            flex-direction: column;
        }
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Pemesanan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Isi -->
    <section class="page-section service">
        <h1 class="text-black text-center"> Cara Pemesanan Makanan</h1>
        <div class="row">
            <div class="service-col">
                <h3>1.Silahkan Login</h3>
                <p>Jika belum punya akun silahkan menuju menu login pada bagian atas dan tekan pada buat akun baru</p>
            </div>
            <div class="service-col">
                <h3>2.Pilih Makanan</h3>
                <p>Setelah Login anda dapat memesan makanan yang tersedia. Dengan tekan view pada bagian bawah menu makanan dan masukan jumlah pesanan. Pesanan otomatis akan ditambahkan pada halaman Keranjang</p>
            </div>
            <div class="service-col">
                <h3>3.Proses Pesan Makanan</h3>
                <p>Setelah memilih menu makanan yang akan dipesan silihakan pergi kehalaman keranjang. Lalu pastikan pesanan yang akan dibeli benar jika sudah tekan pesan</p>
            </div>
        </div>

        <div class="row" style="margin-top: auto;">
            <div class="service-col">
                <h3>4. Isikan Form Data Pelanggan</h3>
                <p>Pastikan isi dari form data pelanggan dengan benar. Karena admin akan melihat isi form tersebut untuk proses mengirim makanan.</p>
            </div>
            <div class="service-col">
                <h3>5. Menerima Nota</h3>
                <p>Setelah selesai mengisi form data pelanggan akan diperlihat nota hasil pembelian dan silhkan lakukan pembaran sesuai motode pembayaran yang anda pilih </p>
            </div>
            <div class="service-col">
                <h3>6. Silahkan Lakukan Konfirmasi Pembayaran</h3>
                <p>Setelah nota dan melakukan pembayaran silahkan kirim bukti pembayaran. Untuk melakukannya dengan cara pergi pada menu riwayat belanja dan pilih pesanan yang baru anda pesan dan tekan tombol pembayaran. Kemudian Isikan Form pembayaran. Setelah selesai tinggal tunggu konfirmasi dari admin dan makanan akan segera dikirimkan </p>
            </div>
        </div>

        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>