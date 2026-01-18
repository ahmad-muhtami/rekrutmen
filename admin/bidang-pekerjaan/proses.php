<?php
include '../config/koneksi.php';

$bidang_pekerjaan = $_POST['bidang_pekerjaan'];
$jenis_pekerjaan = $_POST['jenis_pekerjaan'];
$gaji_pokok = $_POST['gaji_pokok'];
$jobdesk = $_POST['jobdesk'];

if (isset($_POST['tambah'])) {
    $querytransaksi = "INSERT INTO bidang_pekerjaan (bidang_pekerjaan, jenis_pekerjaan, gaji_pokok, jobdesk) 
                           VALUES ('$bidang_pekerjaan', '$jenis_pekerjaan', '$gaji_pokok', '$jobdesk')";
    $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

    if ($resulttransaksi) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan';
        header("Location: bidang-pekerjaan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: bidang-pekerjaan.php?page=tambah");
    }
}
