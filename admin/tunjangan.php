<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Tunjangan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'tunjangan/tampil.php';
    break;
  case 'tambah':
    include 'tunjangan/tambah.php';
    break;
  case 'ubah':
    include 'tunjangan/update.php';
    break;
  case 'proses':
    include 'tunjangan/proses.php';
    break;
  case 'proses_ubah':
    include 'tunjangan/proses_ubah.php';
    break;
  case 'hapus':
    include 'tunjangan/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>