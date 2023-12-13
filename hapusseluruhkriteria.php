<?php
//untuk koneksi ke database
session_start();
include ("koneksi.php");

//proses delete
$sql     = "DELETE FROM tab_kriteria";
$hapus   = $koneksi->query($sql);

if ($hapus) {
  echo "<script>alert('Hapus Semua Data Berhasil') </script>";
  echo "<script>window.location.href = \"kriteria.php\" </script>";
} else {
  echo "Maaf Tidak Dapat Menghapus !";
}
?>
