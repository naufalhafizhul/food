<h2>Data Pembayaran</h2>

<?php
// mendapatkan id_pembelian dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>"
?>

<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td><?php echo $detail['nama'] ?></td>
            </tr>
            <tr>
                <th>Mode Bayar</th>
                <td><?php echo $detail['bank'] ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><?php echo number_format($detail['jumlah'], '0', ',', '.') ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?php echo $detail['tanggal'] ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_bayar/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
    </div>
</div>

<form method="POST">
    <div class="form-group">
        <label for="">Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih Status</option>
            <option value="Pesan Diterima">Pesanan Makanan Diterima</option>
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