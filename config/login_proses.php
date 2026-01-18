<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($koneksi, $query);

// cek apkh username + password cocok
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id_pengguna = $row['id'];
    session_start();

    $querykaryawan = "SELECT * FROM karyawan WHERE pengguna_id = '$id_pengguna' LIMIT 1";
    $resultkaryawan = mysqli_query($koneksi, $querykaryawan);

    if (mysqli_num_rows($resultkaryawan) > 0) {
        $data_karyawan = mysqli_fetch_assoc($resultkaryawan);
        $_SESSION['karyawan_id'] = $data_karyawan['id'];
    }

    $_SESSION['login'] = true;
    $_SESSION['id'] = $row['id'];


    $_SESSION['nama'] = $row['nama'];
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];
    $_SESSION['nomor_telepon'] = $row['nomor_telepon'];

    header("Location: cek_login.php");
    exit();
} else {
    echo '<script>alert("Username atau Password Salah!");</script>';
    echo '<script>window.location.href = "../login.php";</script>';
}
