<h3>Menu Makanan</h3>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Foto</th>
            <th class="text-center">Dekskripsi</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $pecah['nama_kategori']; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga_produk'], '0', ',', '.'); ?></td>
                <td>
                    <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100px">
                </td>
                <td><?php echo $pecah['des_produk']; ?></td>
                <td><?php echo $pecah['stok_produk']; ?></td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">Hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Tambah Data -->

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>