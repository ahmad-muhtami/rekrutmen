<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {

    $id         = $_POST['id'];
    $pelamar_id = $_POST['pelamar_id'];
    $status     = $_POST['status'];
    $catatan    = $_POST['catatan'];

    // update status rekrutmen
    $queryUpdate = "
        UPDATE rekrutmen 
        SET status = '$status',
            catatan = '$catatan',
            updated_at = NOW()
        WHERE id = '$id'
    ";
    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if ($resultUpdate && $status === 'diterima') {

        $queryRekrutmen = "
            SELECT 
                rekrutmen.pelamar_id,
                lowongan_kerja.bidang_pekerjaan_id,
                pengguna.nomor_telepon
            FROM rekrutmen
            JOIN pengguna 
                ON rekrutmen.pelamar_id = pengguna.id
            JOIN lowongan_kerja on rekrutmen.lowongan_id = lowongan_kerja.id
            WHERE rekrutmen.id = '$id'
        ";

        $resultRekrutmen = mysqli_query($koneksi, $queryRekrutmen);
        $rekrutmen = mysqli_fetch_assoc($resultRekrutmen);

        $bidang_pekerjaan_id = $rekrutmen['bidang_pekerjaan_id'];
        $nomor_telepon       = $rekrutmen['nomor_telepon'];

        // cek apakah sudah menjadi karyawan
        $cekKaryawan = mysqli_query(
            $koneksi,
            "SELECT id FROM karyawan WHERE pengguna_id = '$pelamar_id'"
        );

        if (mysqli_num_rows($cekKaryawan) == 0) {

            $queryInsertKaryawan = "
                INSERT INTO karyawan 
                (pengguna_id, bidang_pekerjaan_id, nomor_telepon)
                VALUES 
                ('$pelamar_id', '$bidang_pekerjaan_id', '$nomor_telepon')
            ";
            mysqli_query($koneksi, $queryInsertKaryawan);

            $queryUpdateRole = "
                UPDATE pengguna 
                    SET role = 'karyawan',
                WHERE id = '$pelamar_id'
            ";
        }
    }

    if ($resultUpdate) {
        $_SESSION['result']  = 'success';
        $_SESSION['message'] = 'Data berhasil diupdate.';
        header("Location: rekrutmen.php?page=tampil");
    } else {
        $_SESSION['result']  = 'error';
        $_SESSION['message'] = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
        header("Location: rekrutmen.php?page=ubah&id=$id");
    }
}
