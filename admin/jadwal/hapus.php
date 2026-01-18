<?php
include '../config/koneksi.php';
if (isset($_GET['page']) && $_GET['page'] == 'hapus') {
    
    $id_karyawan = (int)$_GET['id'];
    
    $bulan_ini = date('m'); 
    $tahun_ini = date('Y');
    $query_hapus = "DELETE FROM shift 
                    WHERE karyawan_id = '$id_karyawan' 
                    AND MONTH(tanggal) = '$bulan_ini' 
                    AND YEAR(tanggal) = '$tahun_ini'";

    $execute = mysqli_query($koneksi, $query_hapus);

    if ($execute) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Seluruh jadwal karyawan tersebut di bulan ini berhasil dihapus.';
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal menghapus data: ' . mysqli_error($koneksi);
    }

    echo "<script>window.location='jadwal.php?page=tampil';</script>";
    exit;
}
?>
