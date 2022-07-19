<?php
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
$status = "";
if (isset($_POST["kirim"])) {
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $status = $_POST["status"];
    //pm inisial dari table pembelian dan pl table pelanggan
    $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

<h2>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h2>
<br>

<!-- buat fommulir -->

<form action="" method="POST">
    <div class="row">
        <div class="col-md-3">
            <label for="">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
        </div>
        <div class="col-md-3">
            <label for="">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
        </div>
        <div class="col-md-3">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="">Pilih Status</option>
                <option value="pending" <?php echo $status == "pending" ? "selected" : "";  ?>>pending</option>
                <option value="Pesan Diterima" <?php echo $status == "Pesan Diterima" ? "selected" : ""; ?>>Pesan Diterima</option>
                <option value="Makanan dikirim" <?php echo $status == "Makanan dikirim" ? "selected" : ""; ?>>Makanan dikirim</option>
                <option value="Makan Diterima" <?php echo $status == "Makan Diterima" ? "selected" : ""; ?>>Makan Diterima</option>
                <option value="batal" <?php echo $status == "batal" ? "selected" : ""; ?>>Batal</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>

<!-- membuat table -->
<div style="margin-top: 30px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($semuadata as $key => $value) : ?>
                <?php $total += $value['total_pembelian']; ?>
                <tr>
                    <th><?php echo $key + 1 ?></th>
                    <th><?php echo $value["nama_pelanggan"] ?></th>
                    <th><?php echo date("d F Y", strtotime($value["tanggal_pembelian"])) ?></th>
                    <th><?php echo number_format($value["total_pembelian"]) ?></th>
                    <th><?php echo $value["status_pembelian"] ?></th>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>Rp. <?php echo number_format($total) ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>