<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM pertanyaan WHERE id = '$id'";
        $resultDelete = mysqli_query($koneksi, $queryDelete);
        if ($resultDelete) {
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data berhasil dihapus.';
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal menghapus data: ' . mysqli_error($koneksi);
        }

    header("Location: pertanyaan.php?page=tampil");
}
?>
