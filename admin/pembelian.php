<h3>Data Pembelian</h3>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Pelanggan</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Status</th>
            <th class="text-center">Total</th>
            <th class="text-center">Bayar</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo date("d F Y", strtotime($pecah['tanggal_pembelian'])); ?></td>
                <td><?php echo $pecah['status_pembelian']; ?></td>
                <td>Rp. <?php echo number_format($pecah['total_pembelian'], '0', ',', '.'); ?></td>
                <td><?php echo $pecah['mode_bayar']; ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn-info btn">Details</a>

                    <!--  -->
                    <?php
                    if ($pecah['status_pembelian'] !== "pending" or $pecah['mode_bayar'] == "Bayar Di Tempat") : ?>
                        <a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>