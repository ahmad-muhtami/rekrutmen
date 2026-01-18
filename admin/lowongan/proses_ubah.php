<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $bidang_pekerjaan_id = $_POST['bidang_pekerjaan_id'];
    
    $deskripsi = $_POST['deskripsi'];
    $tanggal_buka = $_POST['tanggal_buka'];
    $tanggal_berakhir = $_POST['tanggal_berakhir'];
    $persyaratan = $_POST['persyaratan'];
    

    
    $query = "UPDATE lowongan_kerja 
              SET bidang_pekerjaan_id = $bidang_pekerjaan_id, judul = '$judul', deskripsi = '$deskripsi', tanggal_buka = '$tanggal_buka', tanggal_berakhir = '$tanggal_berakhir', persyaratan = '$persyaratan' 
              WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diupdate.';
        header("Location: lowongan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
        header("Location: lowongan.php?page=ubah&id=$id");
    }
}
?>
