<?php
include '../modules/header.php';

?>

<title>Pengaturan Profil</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'update';
}
switch ($page) {
  case 'update':
    include 'profil/update.php';
    break;
  case 'proses_ubah':
    include 'profil/proses_ubah.php';
    break;
  

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>