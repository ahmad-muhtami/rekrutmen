<?php
include '../config/koneksi.php';

$jenis_tunjangan = $_POST['jenis_tunjangan'];
$nominal = $_POST['nominal'];

if (isset($_POST['tambah'])) {
    $querytransaksi = "INSERT INTO tunjangan (jenis_tunjangan, nominal) 
                           VALUES ('$jenis_tunjangan', '$nominal')";
    $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

    if ($resulttransaksi) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan';
        header("Location: tunjangan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: tunjangan.php?page=tambah");
    }
}
