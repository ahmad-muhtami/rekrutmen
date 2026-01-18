<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Pengguna</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'users/tampil.php';
    break;
  case 'tambah':
    include 'users/tambah.php';
    break;
  case 'ubah':
    include 'users/update.php';
    break;
  case 'proses':
    include 'users/proses.php';
    break;
  case 'proses_ubah':
    include 'users/proses_ubah.php';
    break;
  case 'hapus':
    include 'users/hapus.php';
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>