<?php
include '../config/koneksi.php';
if (isset($_GET['page']) && $_GET['page'] == 'proses' && isset($_POST['tambah'])) {
    

    $karyawan_id = $_POST['karyawan_id']; 
    
    $tanggal     = $_POST['tanggal']; // YYYY-MM-DD
    $jam         = $_POST['jam'];     // HH:MM
    $keterangan  = $_POST['keterangan'];
    if($_SESSION['role'] == 'admin'){
        $catatan = $_POST['catatan'];
    }else{
        $catatan = '';
    }

    $waktu_absen = $tanggal . ' ' . $jam . ':00';

    $query_cek_shift = "SELECT id, jenis_shift FROM shift WHERE karyawan_id = '$karyawan_id' AND tanggal = '$tanggal'";
    $result_shift = mysqli_query($koneksi, $query_cek_shift);
    $data_shift = mysqli_fetch_assoc($result_shift);

    if ($data_shift) {
        $shift_id = $data_shift['id'];

        $cek_absen = mysqli_query($koneksi, "SELECT id FROM absensi WHERE shift_id = '$shift_id'");
        
        if (mysqli_num_rows($cek_absen) > 0) {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Data absensi sudah ada.';
        } else {
            // 3. INSERT DATA
            $query_insert = "INSERT INTO absensi (shift_id, waktu_absen, keterangan, catatan) 
                             VALUES ('$shift_id', '$waktu_absen', '$keterangan', '$catatan')";
            
            if (mysqli_query($koneksi, $query_insert)) {
                $_SESSION['result'] = 'success';
                $_SESSION['message'] = 'Data absensi berhasil ditambahkan!';
            } else {
                $_SESSION['result'] = 'error';
                $_SESSION['message'] = 'Gagal menyimpan database: ' . mysqli_error($koneksi);
            }
        }

    } else {
        // Jika Shift tidak ditemukan (Karyawan tidak punya jadwal di tanggal itu)
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal! harap pastikan jadwal/shift untuk tanggal tersebut tersedia';
    }

    // Redirect agar form bersih (PRG Pattern)
    echo "<script>window.location='absensi.php?page=tampil';</script>";
    exit;
}
?>
