<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $bidang_pekerjaan_id = $_POST['bidang_pekerjaan_id'];
    $tunjangan_id = $_POST['tunjangan_id'];

if ($tunjangan_id == '') {
    $tunjangan_id = "NULL";
}
    $nomor_telepon = $_POST['nomor_telepon'];
    $status = $_POST['status'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];

    $query = "
UPDATE karyawan SET 
    bidang_pekerjaan_id = '$bidang_pekerjaan_id',
    tunjangan_id = " . ($tunjangan_id === NULL ? "NULL" : "'$tunjangan_id'") . ",
    nomor_telepon = '$nomor_telepon',
    status = '$status',
    tanggal_bergabung = '$tanggal_bergabung'
WHERE id = '$id'
";



    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diperbarui';

        header("Location:karyawan.php");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data gagal diperbarui';
        header("Location:karyawan.php?page=ubah&id=$id");
    }
}
