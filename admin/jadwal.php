<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Jadwal / Shift</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'jadwal/tampil.php';
    break;
  
  case 'ubah':
    include 'jadwal/update.php';
    break;
  
  case 'hapus':
    include 'jadwal/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>