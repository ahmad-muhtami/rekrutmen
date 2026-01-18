<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Penggajian</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'penggajian/tampil.php';
    break;
  case 'tambah':
    include 'penggajian/tambah.php';
    break;
  case 'ubah':
    include 'penggajian/update.php';
    break;
  case 'proses':
    include 'penggajian/proses.php';
    break;
  case 'proses_ubah':
    include 'penggajian/proses_ubah.php';
    break;
  case 'hapus':
    include 'penggajian/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>