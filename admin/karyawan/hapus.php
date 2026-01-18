<?php
include '../config/koneksi.php';
$id = $_GET['id'];

mysqli_begin_transaction($koneksi);

try {
    
    $queryUser = "DELETE FROM karyawan WHERE id = '$id'";
    $resultUser = mysqli_query($koneksi, $queryUser);
    if (!$resultUser) {
        throw new Exception('Gagal menghapus data karyawan.');
    }

    mysqli_commit($koneksi);

    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Data berhasil dihapus';

    header("Location: karyawan.php?page=tampil");

} catch (Exception $e) {
    mysqli_rollback($koneksi);

    $_SESSION['result'] = 'error';
    $_SESSION['message'] = $e->getMessage();

    header("Location: karyawan.php?page=tampil");
}
?>
