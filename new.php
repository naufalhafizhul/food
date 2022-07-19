<nav class="navbar navbar-default">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Teras Bu Nunung</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">Home</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <?php
            // jika sudah login (ada session pelanggan)
            if (isset($_SESSION["pelanggan"])) : ?>
                <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <li><a href="logout.php">Logout</a></li>
                <!-- <button type="button" class="btn btn-primary navbar-btn">
                    <a href="logout.php">Logout</a>
                </button> -->
                <!-- selain itu blm login /blm ada session pelanggan -->
            <?php else : ?>
                <li><a href="login.php">Login</a></li>

                <!-- <button type="button" class="btn btn-default navbar-btn">
                    <a href="login.php">Login</a>
                </button> -->
                <!-- <li><a href="login.php">Login</a></li> -->
            <?php endif ?>
        </ul>

        <form action="pencarian.php" method="GET" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword">
            <button class="btn btn-primary">Cari</button>
        </form>
    </div>
</nav>