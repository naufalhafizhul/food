<h3>Ubah kategori</h3>
<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_kategori']; ?>">
        </div>
        <button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama]' WHERE id_kategori='$_GET[id]'");

    echo "<div class='alert alert-info'>Data Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
}
?>