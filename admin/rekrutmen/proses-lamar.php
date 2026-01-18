<?php
include '../config/koneksi.php';
session_start();

$pelamar_id = $_SESSION['id'];

if (isset($_POST['proses'])) {

    $lowongan_id    = $_POST['lowongan_id'];
    $no_ktp         = $_POST['no_ktp'];
    $tempat_lahir   = $_POST['tempat_lahir'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $usia           = $_POST['usia'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $agama          = $_POST['agama'];
    $alamat         = $_POST['alamat'];
    $email          = $_POST['email'];

    $errors = [];
    $cvName = $_FILES['cv']['name'];
    $cvTmp  = $_FILES['cv']['tmp_name'];

    if (empty($cvName)) {
        $errors[] = "CV wajib diupload.";
    } else {
        $allowed_ext = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($cvName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            $errors[] = "Format CV tidak valid (pdf, doc, docx, jpg, png).";
        }
    }

    if (empty($no_ktp))         $errors[] = "NIK harus diisi.";
    if (empty($tempat_lahir))   $errors[] = "Tempat lahir harus diisi.";
    if (empty($tanggal_lahir))  $errors[] = "Tanggal lahir harus diisi.";
    if (empty($usia))           $errors[] = "Usia harus diisi.";
    if (empty($jenis_kelamin))  $errors[] = "Jenis kelamin harus diisi.";
    if (empty($agama))          $errors[] = "Agama harus diisi.";
    if (empty($alamat))         $errors[] = "Alamat harus diisi.";
    if (empty($email))          $errors[] = "Email harus diisi.";

    if (empty($errors)) {

        $cvNewName = time() . "_" . $cvName;
        $cvPath = "./uploads/" . $cvNewName;

        move_uploaded_file($cvTmp, $cvPath);

        $query = "INSERT INTO rekrutmen 
                (pelamar_id, lowongan_id, no_ktp, tempat_lahir, tanggal_lahir, usia, jenis_kelamin, agama, alamat_domisili, email, cv, status, tanggal)
                VALUES 
                ('$pelamar_id', '$lowongan_id', '$no_ktp', '$tempat_lahir', '$tanggal_lahir', '$usia', '$jenis_kelamin', '$agama', '$alamat', '$email', '$cvNewName', 'menunggu', NOW())";

        $result = mysqli_query($koneksi, $query);

        if ($result) {

            $rekrutmen_id = mysqli_insert_id($koneksi);

            
            if (!empty($_FILES['lampiran']['name'][0])) {

                $totalFiles = count($_FILES['lampiran']['name']);

                for ($i = 0; $i < $totalFiles; $i++) {

                    $fileName   = $_FILES['lampiran']['name'][$i];
                    $fileTmp    = $_FILES['lampiran']['tmp_name'][$i];
                    $newName    = time() . "_" . $fileName;
                    $lampPath   = "./uploads/" . $newName;

                    move_uploaded_file($fileTmp, $lampPath);

                    $sqlLamp = "INSERT INTO lampiran (pelamar_id, rekrutmen_id, lampiran)
                                VALUES ('$pelamar_id', '$rekrutmen_id', '$newName')";
                    mysqli_query($koneksi, $sqlLamp);
                }
            }

            $_SESSION['result']  = 'success';
            $_SESSION['message'] = 'Lamaran berhasil dikirim!';
            header("Location: rekrutmen.php?page=seleksi");
            exit;

        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal menambahkan data: ' . mysqli_error($koneksi);
            header("Location: rekrutmen.php?page=lamar-kerja&id=$lowongan_id");
            exit;
        }

    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = implode("<br>", $errors);
        header("Location: rekrutmen.php?page=lamar-kerja&id=$lowongan_id");
        exit;
    }
}
?>
