<?php
ini_set('date.timezone', 'Asia/Makassar');
include_once '../config/koneksi.php';

$bulan_ini = date('m');
$tahun_ini = date('Y');
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan_ini, (int)$tahun_ini);

// Array nama bulan
$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
$periode_str = $nama_bulan[$bulan_ini] . " " . $tahun_ini;

// ---------------------------------------------------------
// 1. AMBIL DATA ABSENSI
// ---------------------------------------------------------
$query_absen = "SELECT absensi.*, shift.tanggal, shift.karyawan_id 
                FROM absensi 
                JOIN shift ON absensi.shift_id = shift.id 
                WHERE MONTH(shift.tanggal) = '$bulan_ini' 
                AND YEAR(shift.tanggal) = '$tahun_ini'";

$result_absen = mysqli_query($koneksi, $query_absen);

$data_absen = [];
while ($row = mysqli_fetch_assoc($result_absen)) {
    $tgl = (int)date('j', strtotime($row['tanggal']));
    $data_absen[$row['karyawan_id']][$tgl] = $row['keterangan'];
}

// ---------------------------------------------------------
// 2. HITUNG TOTAL & CARI NILAI TERTINGGI (MAX)
// ---------------------------------------------------------
$q_karyawan = mysqli_query($koneksi, "SELECT karyawan.*, pengguna.nama as nama
                                      FROM karyawan 
                                      JOIN pengguna on karyawan.pengguna_id = pengguna.id
                                      WHERE status='aktif' ORDER BY nama ASC");

$list_semua_karyawan = [];
$max_hadir = 0;

// Loop 1: Hitung kehadiran semua orang dulu
while ($k = mysqli_fetch_assoc($q_karyawan)) {
    $id_kar = $k['id'];
    $total_hadir = 0;

    for ($d = 1; $d <= $jumlah_hari; $d++) {
        if (isset($data_absen[$id_kar][$d]) && $data_absen[$id_kar][$d] == 'Hadir') {
            $total_hadir++;
        }
    }

    $k['total_hadir_bulan_ini'] = $total_hadir;
    $list_semua_karyawan[] = $k;

    // Cari angka tertinggi
    if ($total_hadir > $max_hadir) {
        $max_hadir = $total_hadir;
    }
}

// Loop 2: FILTER -> Hanya ambil yang nilainya == max_hadir
$karyawan_terbaik = [];
if ($max_hadir > 0) { // Pastikan ada yang hadir minimal 1 hari
    foreach ($list_semua_karyawan as $k) {
        if ($k['total_hadir_bulan_ini'] == $max_hadir) {
            $karyawan_terbaik[] = $k;
        }
    }
}
?>

<div class="container-fluid p-4 h-100 bg-white">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 text-gray-800">Karyawan Terbaik <span class="d-block font-weight-normal" style="font-size: 14px;">Periode: <?= $periode_str ?></span></h1>
        </div>
        
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-danger fs-5" data-toggle="modal" data-target="#exportBulanModal">
                <i class="fas fa-file-pdf"></i> Cetak
            </button>
        </div>
    </div>

    <div class="card card-body border-0 p-0 mt-2">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
                    <thead class="">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Jumlah Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($karyawan_terbaik)) : ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data absensi bulan ini.</td>
                            </tr>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($karyawan_terbaik as $k) {
                            ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $no++ ?></td>
                                    <td class="text-center align-middle"><?= $periode_str ?></td>
                                    <td class="align-middle font-weight-bold">
                                        <?= $k['nama'] ?> <i class="fas fa-crown text-warning ml-1"></i>
                                    </td>
                                    <td class="text-center align-middle font-weight-bold"><?= $k['total_hadir_bulan_ini'] ?> Hari</td>
                                </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exportBulanModal" tabindex="-1" aria-labelledby="exportBulanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportBulanModalLabel">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="laporan-penghargaan-karyawan.php?page=cetak" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="cetak">
          <div class="form-group">
            <label>Bulan</label>
            <select class="custom-select" name="bulan">
              <option value="1" <?= $bulan_ini == '01' ? 'selected' : '' ?>>Januari</option>
              <option value="2" <?= $bulan_ini == '02' ? 'selected' : '' ?>>Februari</option>
              <option value="3" <?= $bulan_ini == '03' ? 'selected' : '' ?>>Maret</option>
              <option value="4" <?= $bulan_ini == '04' ? 'selected' : '' ?>>April</option>
              <option value="5" <?= $bulan_ini == '05' ? 'selected' : '' ?>>Mei</option>
              <option value="6" <?= $bulan_ini == '06' ? 'selected' : '' ?>>Juni</option>
              <option value="7" <?= $bulan_ini == '07' ? 'selected' : '' ?>>Juli</option>
              <option value="8" <?= $bulan_ini == '08' ? 'selected' : '' ?>>Agustus</option>
              <option value="9" <?= $bulan_ini == '09' ? 'selected' : '' ?>>September</option>
              <option value="10" <?= $bulan_ini == '10' ? 'selected' : '' ?>>Oktober</option>
              <option value="11" <?= $bulan_ini == '11' ? 'selected' : '' ?>>November</option>
              <option value="12" <?= $bulan_ini == '12' ? 'selected' : '' ?>>Desember</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" value="<?= date('Y') ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-danger" form="print"><i class="fas fa-file-pdf"></i> Cetak PDF</button>
      </div>
    </div>
  </div>
</div>