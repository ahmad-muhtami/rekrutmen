<?php
if (isset($_POST['update'])) {
    $id_absensi  = $_POST['id_absensi'];
    $karyawan_id = $_POST['karyawan_id'];
    $tanggal     = $_POST['tanggal'];
    $jam         = $_POST['jam'];
    $keterangan  = $_POST['keterangan'];
    $catatan     = $_POST['catatan'];

    $waktu_absen_baru = $tanggal . ' ' . $jam . ':00';

    $query_cek_shift = "SELECT id FROM shift WHERE karyawan_id = '$karyawan_id' AND tanggal = '$tanggal'";
    $result_shift = mysqli_query($koneksi, $query_cek_shift);
    $data_shift = mysqli_fetch_assoc($result_shift);

    if ($data_shift) {
        $shift_id_baru = $data_shift['id'];

        $query_update = "UPDATE absensi SET 
                         shift_id = '$shift_id_baru',
                         waktu_absen = '$waktu_absen_baru',
                         keterangan = '$keterangan',
                         catatan = '$catatan'
                         WHERE id = '$id_absensi'";

        if (mysqli_query($koneksi, $query_update)) {
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data absensi berhasil diperbarui!';
            echo "<script>window.location='absensi.php?page=tampil';</script>";
            exit;
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal update data: ' . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Gagal! Karyawan tidak memiliki jadwal shift pada tanggal $tanggal. Silakan atur jadwal terlebih dahulu.');</script>";
    }
}



$id_absensi = $_GET['id'];
$query_data = "SELECT 
                absensi.*,
                shift.karyawan_id,
                pengguna.nama AS nama_karyawan,
                bidang_pekerjaan.bidang_pekerjaan AS jabatan
              FROM absensi
              JOIN shift ON absensi.shift_id = shift.id
              JOIN karyawan ON shift.karyawan_id = karyawan.id
              JOIN pengguna ON karyawan.pengguna_id = pengguna.id
              JOIN bidang_pekerjaan ON karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id
              WHERE absensi.id = '$id_absensi'";
$result_data = mysqli_query($koneksi, $query_data);
$row = mysqli_fetch_assoc($result_data);

$datetime_split = strtotime($row['waktu_absen']);
$val_tanggal    = date('Y-m-d', $datetime_split);
$val_jam        = date('H:i', $datetime_split);
?>

<div class="container-fluid bg-white h-100 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Edit Data Absensi</h1>
    </div>

    <div class="card card-body border">
        <form action="" method="post">
            <input type="hidden" name="id_absensi" value="<?= $row['id'] ?>">
            <input type="hidden" name="karyawan_id" value="<?= $row['karyawan_id'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Karyawan</label>
                    <input type="text" class="form-control" value="<?= $row['nama_karyawan'] ?> - <?= $row['jabatan'] ?>" readonly disabled>
                    <small class="text-muted">Nama karyawan tidak dapat diubah dari menu edit absensi.</small>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Tanggal Absen</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $val_tanggal ?>" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Jam Absen</label>
                    <input type="time" name="jam" class="form-control" value="<?= $val_jam ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Keterangan</label>
                    <select name="keterangan" class="form-control">
                        <option value="Hadir" <?= $row['keterangan'] == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
                        <option value="Sakit" <?= $row['keterangan'] == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
                        <option value="Izin" <?= $row['keterangan'] == 'Izin' ? 'selected' : '' ?>>Izin</option>
                        <option value="Tidak Hadir" <?= $row['keterangan'] == 'Tidak Hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2"><?= $row['catatan'] ?></textarea>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" name="update" value="update" class="btn btn-primary px-4 text-white">Simpan
                </button>
            </div>
        </form>
    </div>
</div>