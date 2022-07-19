<h3>Data Kategori</h3>
<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Kategori</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $pecah['nama_kategori']; ?></td>
                <td>
                    <a href="index.php?halaman=editkategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-default">Tambah Data</a>