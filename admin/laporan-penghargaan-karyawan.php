<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penghargaan Karyawan Terbaik</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penghargaan-karyawan/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-penghargaan-karyawan/cetak.php';
    break;
  
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>