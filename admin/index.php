<?php
include '../modules/header.php';

?>

<title>Beranda</title>

<div class="container-fluid h-100 p-4 bg-white">


    <h1 class="h3 mb-4 text-gray-800 text-capitalize">Selamat Datang, <?= $_SESSION['nama'] ?>!</h1>
    <p class="w-75">di Halaman Dashboard Aplikasi Rekrutmen dan Seleksi Karyawan Kedai Kopi Hatara berbasis Web. <span class="d-block">Silahkan pilih menu sesuai kebutuhan anda.</span></p>

</div>

<?php
include '../modules/footer.php';
?>