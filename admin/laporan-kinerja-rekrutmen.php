<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Kinerja Rekrutmen</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-kinerja-rekrutmen/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-kinerja-rekrutmen/cetak.php';
    break;
  
  case 'export':
    include 'laporan-kinerja-rekrutmen/export.php';
    break;
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>