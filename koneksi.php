<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "spk";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
  echo "Database Belum Terkoneksi";
} else {
  //echo "Sudah Konek";
}
 ?>
