<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST['tambah'])) {

    $lowongan_id = $_POST['lowongan_id'] ?? null;
    $pertanyaan  = $_POST['pertanyaan'] ?? null;

    // Validasi lowongan_id
    if (empty($lowongan_id)) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Harap pilih lowongan kerja.';
        header("Location: pertanyaan.php?page=tambah");
        exit;
    }


    // Insert
    $query = "INSERT INTO pertanyaan (pertanyaan, lowongan_id) VALUES ('$pertanyaan', '$lowongan_id')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan.';
        header("Location: pertanyaan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal menambahkan data: ' . mysqli_error($koneksi);
        header("Location: pertanyaan.php?page=tambah");
    }
}
