<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Data Karyawan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-data-karyawan/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-data-karyawan/cetak.php';
    break;
  
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>