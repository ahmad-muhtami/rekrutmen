<?php
include '../config/koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$nomor_telepon = $_POST['nomor_telepon'];
$role = $_POST['role'];



if (isset($_POST['tambah'])) {
    $querytransaksi = "INSERT INTO pengguna (nama, username, password, nomor_telepon, role) 
                           VALUES ('$nama', '$username', '$password', '$nomor_telepon', '$role')";
        $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

        if ($resulttransaksi) {
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data berhasil ditambahkan';
            header("Location: users.php?page=tampil");
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = mysqli_error($koneksi);
            header("Location: users.php?page=tambah");
        }
}

