<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $bidang_pekerjaan_id = $_POST['bidang_pekerjaan_id'];
    $tanggal_buka = $_POST['tanggal_buka'];
    $tanggal_berakhir = $_POST['tanggal_berakhir'];
    $persyaratan = $_POST['persyaratan'];

    $errors = [];

    
    if (empty($judul)) {
        $errors[] = "Judul harus diisi.";
    }
    if (empty($bidang_pekerjaan_id)) {
        $errors[] = "bidang pekerjaan harus diisi.";
    }
    
    if (empty($tanggal_buka)) {
        $errors[] = "Tanggal buka harus diisi.";
    }
    if (empty($tanggal_berakhir)) {
        $errors[] = "Tanggal berakhir harus diisi.";
    }

    if (empty($persyaratan)) {
        $errors[] = "Persyaratan harus diisi.";
    }

    
    

    if (empty($errors)) {
        $query = "INSERT INTO lowongan_kerja (judul, bidang_pekerjaan_id, tanggal_buka, tanggal_berakhir, persyaratan) 
                      VALUES ('$judul', $bidang_pekerjaan_id, '$tanggal_buka', '$tanggal_berakhir', '$persyaratan')";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                $_SESSION['result'] = 'success';
                $_SESSION['message'] = 'Data berhasil ditambahkan.';
                header("Location: lowongan.php?page=tampil");
            } else {
                $_SESSION['result'] = 'error';
                $_SESSION['message'] = 'Gagal menambahkan data: ' . mysqli_error($koneksi);
                header("Location: lowongan.php?page=tambah");
            }
        
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = implode('<br>', $errors);
        header("Location: lowongan.php?page=tambah");
    }
}
?>
