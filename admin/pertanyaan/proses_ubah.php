<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $lowongan_id = $_POST['lowongan_id'];
    $pertanyaan = $_POST['pertanyaan'];
    

    
    $query = "UPDATE pertanyaan 
              SET lowongan_id = $lowongan_id, pertanyaan = '$pertanyaan' 
              WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diupdate.';
        header("Location: pertanyaan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
        header("Location: pertanyaan.php?page=ubah&id=$id");
    }
}
?>
