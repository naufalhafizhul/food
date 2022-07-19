<?php
session_start();

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

include 'admin/dbconnect.php';

if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
  echo "<script>alert('Keranjang Kosong, Silahkan Belanja Terlebih Dahulu');</script>";
  echo "<script>location='produk.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
  <!-- Navbar -->
  <?php include 'navbar.php'; ?>

  <!-- Isi -->
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
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
              <td>
                <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <a href="produk.php" class="btn btn-default">Lanjutkan Belanja</a>
      <a href="checkout.php" class="btn btn-primary">Proses Pembelian</a>
    </div>
  </section>

</body>

</html>