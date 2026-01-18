<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Pertanyaan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'pertanyaan/tampil.php';
    break;
  case 'tambah':
    include 'pertanyaan/tambah.php';
    break;
  case 'ubah':
    include 'pertanyaan/update.php';
    break;
  case 'proses':
    include 'pertanyaan/proses.php';
    break;
  case 'proses_ubah':
    include 'pertanyaan/proses_ubah.php';
    break;
  case 'hapus':
    include 'pertanyaan/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>