<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penggajian Karyawan</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penggajian/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-penggajian/cetak.php';
    break;
  
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>