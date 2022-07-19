<?php
session_start();
include 'admin/dbconnect.php';

//jika tidak ada session pelanggan(blm Login), mk dilarikan ke login.php
if (!isset($_SESSION["pelanggan"])) {
  echo "<script>alert('Silahkan Login');</script>";
  echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>

<head>
  <title>Document</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<!-- Navbar -->
<?php include 'navbar.php'; ?>



<section class="konten">
  <div class="container">
    <h1>Keranjang Belanja</h1>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor = 1; ?>
        <?php $totalbelanja = 0; ?>
        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
          <!-- Menampilkan Produk yang sedang diulang berdasarkan id produk -->
          <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
          $pecah = $ambil->fetch_assoc();
          $total = $pecah['harga_produk'] * $jumlah;
          ?>

          <tr>
            <td><?php echo $nomor++ ?></td>
            <td><?php echo $pecah['nama_produk'] ?></td>
            <td><?php echo "Rp. " . number_format($pecah['harga_produk'], '0', ',', '.') ?></td>
            <td><?php echo $jumlah ?></td>
            <td><?php echo "Rp. " . number_format($total, '0', ',', '.') ?></td>
          </tr>
          <?php $totalbelanja += $total; ?>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4">Total Belanja</th>
          <th><?php echo number_format($totalbelanja, '0', ',', '.') ?></th>
        </tr>
      </tfoot>
    </table>

    <form method="POST">
      <h3>Data Pelanggan</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label> No Handphone</label>
            <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <label> Pilih Wilayah Pengiriman</label>
          <select name="id_ongkir" class="form-control">
            <option value="">Pilih Ongkos Kirim</option>
            <?php
            $ambil = $koneksi->query("SELECT * FROM ongkir");
            while ($perongkir = $ambil->fetch_assoc()) {
            ?>
              <option value="<?php echo $perongkir['id_ongkir'] ?>">
                <?php echo $perongkir['nama_kota'] ?> -
                Rp. <?php echo number_format($perongkir['tarif'], '0', ',', '.') ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>Alamat Lengkap Pengirim</label>
            <textarea name="alamat_pengiriman" placeholder="Masukan Alamat Lengkap pengiriman" class="form-control"></textarea>
          </div>
        </div>
        <div class="col-md-4">
          <label> Pilih Mode Bayar</label>
          <select name="id_mode" class="form-control">
            <option value="">Pilih Mode Bayar</option>
            <?php
            $ambil = $koneksi->query("SELECT * FROM mode_bayar");
            while ($perongkir = $ambil->fetch_assoc()) {
            ?>
              <option value="<?php echo $perongkir['id_mode'] ?>">
                <?php echo $perongkir['mode_bayar'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <button class="btn btn-primary" name="checkout">Pesan</button>
    </form>

    <!-- Mengimput hasil pesanan pelanggan ke database -->
    <?php
    if (isset($_POST["checkout"])) {
      $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
      $id_ongkir = $_POST["id_ongkir"];
      $id_mode = $_POST["id_mode"];
      $tanggal_pembelian = date("Y-m-d");
      $alamat_pengiriman = $_POST['alamat_pengiriman'];

      // Ambil Tarif dan nama kota dari database
      $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
      $arrayongkir = $ambil->fetch_assoc();
      // $nama_kota = $arrayongkir['nama_kota'];
      $tarif = $arrayongkir['tarif'];

      $total_pembelian = $totalbelanja + $tarif;

      // Ambil Mode Bayar Dari Data base
      $ambil = $koneksi->query("SELECT * FROM mode_bayar WHERE id_mode='$id_mode'");
      $arraymode_bayar = $ambil->fetch_assoc();
      $mode_bayar = $arraymode_bayar['mode_bayar'];
      //  1. Menyimpan data ke tabel pembelian
      $ambil = $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir, tanggal_pembelian,total_pembelian,mode_bayar,alamat_pengiriman) VALUE ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$mode_bayar','$alamat_pengiriman')");

      //mendapatkan id_pembelian barusan terjadi
      $id_pembelian_barusan = $koneksi->insert_id;

      foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {

        //  Mendapatkan data produk berdasarkan id_produk
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $perproduk = $ambil->fetch_assoc();

        // $nama = $perproduk['nama_produk'];
        $harga = $perproduk['harga_produk'];
        $subharga = $perproduk['harga_produk'] * $jumlah;

        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$subharga','$jumlah')");

        // code untuk mengurangi stok ketika dibeli pelanggan
        $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
      }
      // mengkosongkan keranjang belanja
      unset($_SESSION["keranjang"]);
      // tampilan dialihkan ke halaman nota, nota dari pembelian barusan
      echo "<script>alert('Pembelian Sukses');</script>";
      echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
    }
    ?>
  </div>
</section>

<body>

</body>

</html>