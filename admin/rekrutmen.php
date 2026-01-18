<?php
include '../modules/header.php';
?>

<title>Data Lamaran Kerja</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'status-rekrutmen':
    include 'rekrutmen/status-rekrutmen.php';
    break;
  case 'tampil':
    include 'rekrutmen/tampil.php';
    break;
  case 'ubah':
    include 'rekrutmen/update.php';
    break;
  case 'hapus':
    include 'rekrutmen/hapus.php';
    break;
  case 'proses_ubah':
    include 'rekrutmen/proses_ubah.php';
    break;
  case 'lamar':
    include 'rekrutmen/lamar.php';
    break;
  case 'lamar-kerja':
    include 'rekrutmen/lamar-kerja.php';
    break;

    case 'seleksi':
    include 'rekrutmen/tes-seleksi.php';
    break;
 case 'kirim-jawaban':
    include 'rekrutmen/kirim-jawaban.php';
    break;
  case 'proses-lamar':
    include 'rekrutmen/proses-lamar.php';
    break;
  
  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>