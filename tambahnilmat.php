<?php
//koneksi
session_start();
include("koneksi.php");

$alternatif = $_POST['alter'];
$kriteria   = $_POST['krit'];
$poin       = $_POST['nilai'];

$masuk = "INSERT INTO tab_topsis VALUES ('".$alternatif."','".$kriteria."','".$poin."')";
$buat  = $koneksi->query($masuk);

if ($buat) {
  echo "<script>alert('Input Data Berhasil') </script>";
  echo "<script>window.location.href = \"nilmat.php\" </script>";
} else {
  echo "<script>alert('Input Data Gagal') </script>";
}
?>