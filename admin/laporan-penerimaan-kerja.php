<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penerimaan Kerja</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penerimaan-kerja/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-penerimaan-kerja/cetak.php';
    break;
  
  case 'export':
    include 'laporan-penerimaan-kerja/export.php';
    break;
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>