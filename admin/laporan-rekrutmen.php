<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Rekrutmen & Seleksi Karywan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-rekrutmen/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-rekrutmen/cetak.php';
    break;
  
  case 'export':
    include 'laporan-rekrutmen/export.php';
    break;
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>