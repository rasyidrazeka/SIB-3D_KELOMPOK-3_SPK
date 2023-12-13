<?php
//untuk koneksi ke database
session_start();
include ("koneksi.php");

//proses delete
$sql     = "DELETE FROM tab_alternatif";
$hapus   = $koneksi->query($sql);

if ($hapus) {
  echo "<script>alert('Hapus Semua Data Berhasil') </script>";
  echo "<script>window.location.href = \"alternatif.php\" </script>";
} else {
  echo "Maaf Tidak Dapat Menghapus !";
}
?>

