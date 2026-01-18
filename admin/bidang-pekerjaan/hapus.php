<?php
include '../config/koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM bidang_pekerjaan WHERE id = '$id'";

$result = mysqli_query($koneksi, $query);
if ($result) {
  $_SESSION['result'] = 'success';
  $_SESSION['message'] = 'Data berhasil dihapus';

  header("Location: bidang-pekerjaan.php?page=tampil");
} else {
  $_SESSION['result'] = 'error';
  $_SESSION['message'] = 'Data gagal dihapus';
  //refresh page
  header("Location: bidang-pekerjaan.php?page=tampil");
}
