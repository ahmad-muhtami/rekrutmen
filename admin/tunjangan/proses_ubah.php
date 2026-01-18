<?php
include '../config/koneksi.php';

$id = $_POST['id'];
    $jenis_tunjangan = $_POST['jenis_tunjangan'];
    $nominal = $_POST['nominal'];
    

    $queryUpdate = "UPDATE tunjangan SET 
                    jenis_tunjangan = '$jenis_tunjangan',
                    nominal = $nominal
                    WHERE id = $id";

    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if ($resultUpdate) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diubah';
        header("Location: tunjangan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: tunjangan.php?page=edit&id=$id");
    }