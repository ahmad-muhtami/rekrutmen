<?php
include '../config/koneksi.php';


$bidang_pekerjaan_id = $_POST['bidang_pekerjaan_id'];
$tunjangan_id = $_POST['tunjangan_id'];
    if ($tunjangan_id === '' || $tunjangan_id === null) {
        $tunjangan_id_sql = "NULL";
    } else {
        $tunjangan_id_sql = "'$tunjangan_id'";
    }
$pengguna_id = $_POST['pengguna_id'];
$nomor_telepon = $_POST['nomor_telepon'];
$status = $_POST['status'];
$tanggal_bergabung = $_POST['tanggal_bergabung'];


if (isset($_POST['tambah'])) {

    $querytransaksi = "
        INSERT INTO karyawan 
        (bidang_pekerjaan_id, tunjangan_id, pengguna_id, nomor_telepon, status, tanggal_bergabung)
        VALUES 
        ('$bidang_pekerjaan_id', $tunjangan_id_sql, '$pengguna_id', '$nomor_telepon', '$status', '$tanggal_bergabung')
    ";

    $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

    if ($resulttransaksi) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan';
        header("Location: karyawan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: karyawan.php?page=tambah");
    }
}
