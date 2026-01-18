<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Absensi Karyawan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-absensi/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-absensi/cetak.php';
    break;
  
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>