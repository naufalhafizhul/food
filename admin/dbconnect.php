<!-- Koneksi Database -->
<?php

$koneksi = new mysqli('localhost', 'root', '', 'dbfood') or die("Could not connect to mysql" . mysqli_error($koneksi));
