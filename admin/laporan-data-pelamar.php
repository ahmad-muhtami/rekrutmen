<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penerimaan Lowongan Kerja</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-data-pelamar/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-data-pelamar/cetak.php';
    break;
  
  case 'export':
    include 'laporan-data-pelamar/export.php';
    break;
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>