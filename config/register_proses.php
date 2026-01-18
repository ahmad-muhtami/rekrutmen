<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Validasi jika username sudah ada
    $queryCheck = "SELECT * FROM users WHERE username = '$username'";
    $resultCheck = mysqli_query($koneksi, $queryCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Username sudah digunakan, silahkan pilih username lain.';
        header('Location: ../register.php');
    } else {
        // Hash password sebelum menyimpan
        $hashedPassword = md5($password);

        // Simpan ke tabel users
        $queryInsert = "INSERT INTO users (nama, username, password, no_telp) VALUES ('$nama', '$username', '$hashedPassword', '$no_telp')";
        $resultInsert = mysqli_query($koneksi, $queryInsert);

        if ($resultInsert) {
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Registrasi berhasil! Silahkan login.';
            header('Location: ../index.php');
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Terjadi kesalahan, coba lagi.';
            header('Location: ../register.php');
        }
    }
}
?>
