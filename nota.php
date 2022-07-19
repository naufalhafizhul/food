<?php
session_start();
include 'admin/dbconnect.php';
?>
<!DOCTYPE html>

<head>
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <section class="konten">
        <div class="container">
            <h2>Nota Detail Pembelian</h2>
            <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            // <!-- Tambah disi -->
            $ambil2 = $koneksi->query("SELECT * FROM pembelian JOIN ongkir ON pembelian.id_ongkir=ongkir.id_ongkir WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail2 = $ambil2->fetch_assoc();
            // <!-- sampe sini -->
            ?>

            <!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login maka akan dialihkan ke riwayat.php karena tidak berhak liat nota orang lain  -->
            <!-- pelanggan yang beli harus pelanggan yang login -->
            <?php
            // mendapatkan id_pelanggan yang beli
            $idpelangganyangbeli = $detail["id_pelanggan"];

            // mendapatkan id_pelanggan yang login
            $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

            if ($idpelangganyangbeli !== $idpelangganyanglogin) {
                echo "<script>alert('Jangan Nakal Ya Kawan!!!');</script>";
                echo "<script>location='riwayat.php';</script>";
                exit();
            }

            ?>

            <!-- Isi Atas Pembelian -->
            <div class="row">
                <div class="col-md-3">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
                    <p>
                        Tanggal :<?php echo $detail['tanggal_pembelian']; ?> <br>
                        <strong>Total : Rp. <?php echo number_format($detail['total_pembelian'], '0', ',', '.'); ?><br></strong>
                    </p>
                </div>
                <div class="col-md-3">
                    <h3>Pelanggan</h3>
                    <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
                    <p>
                        <?php echo $detail['telepon_pelanggan']; ?> <br>
                        <?php echo $detail['email_pelanggan']; ?>
                    </p>
                </div>
                <div class="col-md-3">
                    <h3>Pengiriman</h3>
                    <strong><?php echo $detail2['nama_kota']; ?></strong><br>
                    Ongkos Kirim: Rp. <?php echo number_format($detail2['tarif'], '0', ',', '.'); ?><br>
                    <strong>Mode Bayar: <?php echo $detail['mode_bayar']; ?></strong><br>
                </div>
                <div class="col-md-3">
                    <h3>Alamat Tujuan</h3>
                    <strong><?php echo $detail['alamat_pengiriman']; ?></strong><br>
                </div>
            </div>

            <!-- Membuat Table -->
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    // $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
                    $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE id_pembelian='$_GET[id]'");
                    ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $pecah['nama_produk']; ?></td>
                            <td>Rp. <?php echo number_format($pecah['harga_produk'], '0', ',', '.'); ?></td>
                            <td><?php echo number_format($pecah['jumlah'], '0', ',', '.'); ?></td>
                            <td>
                                Rp. <?php echo number_format($pecah['subharga'], '0', ',', '.'); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            <strong>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian'], '0', ',', '.'); ?></strong> ke <br>
                            <strong>Untuk Trasfer Bank :Mandiri 137-001088-3276 Anril Pratama</strong><br>
                            <strong>Untuk OVO : 081933826600</strong><br>
                            <strong>Untuk Bayar Ditempat : Silahkan Tunggu Pesanan anda</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>