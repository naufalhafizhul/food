<h2>Detail Pembelian</h2>
<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();

$ambil2 = $koneksi->query("SELECT * FROM pembelian JOIN ongkir ON pembelian.id_ongkir=ongkir.id_ongkir WHERE pembelian.id_pembelian='$_GET[id]'");
$detail2 = $ambil2->fetch_assoc();
?>

<!-- <pre><?php //print_r($detail); 
            ?></pre> -->

<!-- Diatas Table -->
<div class="row">
    <div class="col-md-3">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
        Tanggal :<?php echo $detail['tanggal_pembelian']; ?> <br>
        <strong>Total : Rp. <?php echo number_format($detail['total_pembelian'], '0', ',', '.'); ?><br></strong>
    </div>
    <div class="col-md-3">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <?php echo $detail['telepon_pelanggan']; ?> <br>
        <?php echo $detail['email_pelanggan']; ?>
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
<section>
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

    <h4>Status : <?php echo $detail['status_pembelian']; ?></h4>
    <!-- Update Status -->
    <?php
    // mendapatkan id_pembelian dari url
    $id_pembelian = $_GET['id'];

    //mengambil data pembayaran berdasarkan id_pembelian
    $ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
    $detail = $ambil->fetch_assoc();
    ?>
    <h3>Update Status</h3>
    <form method="POST">
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" class="form-control">
                <option value="">Pilih Status</option>
                <option value="Pesanan Diterima">Pesanan Makanan Diterima</option>
                <option value="Makanan dikirim">Makanan dikirim</option>
                <option value="Makan Diterima">Makan Diterima Pelanggan</option>
                <option value="batal">Batal</option>
            </select>
        </div>
        <button class="btn btn-primary" name="proses">Proses</button>
    </form>

    <!-- Update status pelanggan ke database -->

    <?php
    if (isset($_POST["proses"])) {
        $status = $_POST["status"];
        $koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

        echo "<script>alert('data pembelian di update');</script>";
        echo "<script>location='index.php?halaman=pembelian';</script>";
    }
    ?>