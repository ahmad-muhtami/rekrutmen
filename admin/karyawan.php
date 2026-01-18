<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Karyawan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'karyawan/tampil.php';
    break;
  case 'tambah':
    include 'karyawan/tambah.php';
    break;
  case 'ubah':
    include 'karyawan/update.php';
    break;
  case 'proses':
    include 'karyawan/proses.php';
    break;
  case 'proses_ubah':
    include 'karyawan/proses_ubah.php';
    break;
  case 'hapus':
    include 'karyawan/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>