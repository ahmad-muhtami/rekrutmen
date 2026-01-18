<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Lowongan Kerja</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'lowongan/tampil.php';
    break;
  case 'tambah':
    include 'lowongan/tambah.php';
    break;
  case 'ubah':
    include 'lowongan/update.php';
    break;
  case 'proses':
    include 'lowongan/proses.php';
    break;
  case 'proses_ubah':
    include 'lowongan/proses_ubah.php';
    break;
  case 'hapus':
    include 'lowongan/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>