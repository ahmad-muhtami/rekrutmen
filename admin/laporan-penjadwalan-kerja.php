<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penjadwalan Kerja</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penjadwalan-kerja/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-penjadwalan-kerja/cetak.php';
    break;
  
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>