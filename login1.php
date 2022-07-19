<?php
session_start();



include 'admin/dbconnect.php'
?>
<!DOCTYPE html>
<html>

<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Username</h5>
						<input type="email" class="form-control input" name="email">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" class="form-control input" name="password">
					</div>
				</div>
				<a href="#">Forgot Password?</a>
				<a href="#">Belum Punya Akun? Daftar</a>
				<button type="submit" class="btn login" name="simpan" value="Login">Login</button>
			</form>
		</div>
	</div>
	<?php
	//jika ada tombol simpan ditekan
	if (isset($_POST["simpan"])) {
		//buat variable untuk mengambil email dan password yang diinpun lenggan
		$email = $_POST["email"];
		$password = $_POST["password"];

		// Lalu Cek akun Di database
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
		// ngitung akun yg terambil
		$akuncocok = $ambil->num_rows;
		//Jika 1 akun yang cocok, maka diloginkan
		if ($akuncocok == 1) {
			//anda sudah login
			// mendapatkan akun dalam bentuk array
			$akun = $ambil->fetch_assoc();
			// simpan akun yg login
			$_SESSION["pelanggan"] = $akun;
			echo "<script>alert('anda succes login');</script>";
			echo "<script>location='index.php';</script>";
		} else {
			//gagal login
			echo "<script>alert('anda gagal login, Periksa akun anda kebali');</script>";
			echo "<script>location='login.php';</script>";
		}
	}
	?>



	<script type="text/javascript" src="js/main.js"></script>
</body>

</html>