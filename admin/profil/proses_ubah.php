<?php 
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $query = "UPDATE pengguna SET nama = '$nama', username = '$username', nomor_telepon = '$nomor_telepon'";

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $query .= ", password = '$password'";
    }

    $query .= " WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diperbarui';

        header("Location:profil.php?page=update");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data gagal diperbarui';
        header("Location:profil.php?page=update");
    }
}
