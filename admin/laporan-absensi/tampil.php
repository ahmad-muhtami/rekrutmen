<?php

ini_set('date.timezone', 'Asia/Makassar');

$bulan_ini = date('m');
$tahun_ini = date('Y');
?>

<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Absensi Karyawan <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <div class="d-flex justify-content-end">
      <div>
        <button type="button" class="btn btn-danger fs-5" data-toggle="modal" data-target="#exportBulanModal">
          <i class="fas fa-file-pdf"></i> Cetak
        </button>

      </div>
    </div>
  </div>


  <div class="card card-body border-0 p-0 mt-2">
    <div class="row">
      <div class="col-12">
        <?php
        if (isset($_SESSION['result'])) {
          if ($_SESSION['result'] == 'success') {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong><?= $_SESSION['message'] ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
          } else {
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><?= $_SESSION['message'] ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <?php
          }
          unset($_SESSION['result']);
          unset($_SESSION['message']);
        }
        ?>

      </div>
      <div class="col-12">
        <?php
        include_once '../config/koneksi.php';
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan_ini, (int)$tahun_ini);
        // $nama_bulan  = $bulan;

        // 2. Ambil Data Absensi & Susun ke Array
        // Kita perlu join: absensi -> shift -> karyawan
        $query_absen = "SELECT absensi.*, shift.tanggal, shift.karyawan_id 
                    FROM absensi 
                    JOIN shift ON absensi.shift_id = shift.id 
                    WHERE MONTH(shift.tanggal) = '$bulan_ini' 
                    AND YEAR(shift.tanggal) = '$tahun_ini'";

        $result_absen = mysqli_query($koneksi, $query_absen);

        // Format Array: $data_absen[id_karyawan][tanggal] = 'Hadir'/'Sakit'/dll
        $data_absen = [];
        while ($row = mysqli_fetch_assoc($result_absen)) {
          $tgl = (int)date('j', strtotime($row['tanggal']));
          $data_absen[$row['karyawan_id']][$tgl] = $row['keterangan'];
        }
        ?>
        <table class="table table-bordered table-striped table-responsive" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Nama Karyawan</th>
              <th colspan="<?= $jumlah_hari ?>" class="text-center">Tanggal</th>
              <th colspan="4">Total</th>
            </tr>
            <tr>
              <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
                <th><?= $d ?></th>
              <?php endfor; ?>
              <th>Hadir</th>
              <th>Sakit</th>
              <th>Izin</th>
              <th>Alpha</th>
            </tr>
          </thead>
          <tbody>
            <?php
        $no = 1;
        // Ambil Karyawan Aktif
        $q_karyawan = mysqli_query($koneksi, "SELECT karyawan.*, pengguna.nama as nama
        FROM karyawan 
        join pengguna on karyawan.pengguna_id = pengguna.id
        WHERE status='aktif' ORDER BY nama ASC");

        while ($k = mysqli_fetch_assoc($q_karyawan)) {
          $id = $k['id'];

          // Inisialisasi Counter
          $tot_h = 0;
          $tot_s = 0;
          $tot_i = 0;
          $tot_a = 0;
        ?>
              <tr>
            <td><?= $no++ ?></td>
            <td class="text-left"><?= $k['nama'] ?></td>

            <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
              <?php
              $status = '';
              $class = '';
              $kode = '';

              // Cek Data Absensi
              if (isset($data_absen[$id][$d])) {
                $status = $data_absen[$id][$d];

                if ($status == 'Hadir') {
                  $class = 'bg-hadir';
                  $kode = 'Hadir'; // Centang
                  $tot_h++;
                } elseif ($status == 'Sakit') {
                  $class = 'bg-sakit';
                  $kode = 'Sakit';
                  $tot_s++;
                } elseif ($status == 'Izin') {
                  $class = 'bg-izin';
                  $kode = 'Izin';
                  $tot_i++;
                } elseif ($status == 'Tidak Hadir') {
                  $class = 'bg-alpha';
                  $kode = 'Alpha';
                  $tot_a++;
                }
              }
              // Jika tidak absen, cek apakah itu hari libur (Opsional, perlu query shift)
              // Untuk simpelnya, jika kosong kita beri tanda strip
              else {
                $kode = '<span style="color:#ccc">-</span>';
              }
              ?>
              <td class="<?= $class ?>"><?= $kode ?></td>
            <?php endfor; ?>

            <td ><?= $tot_h ?></td>
            <td ><?= $tot_s ?></td>
            <td ><?= $tot_i ?></td>
            <td><?= $tot_a ?></td>
          </tr>
            <?php } ?>
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
        <h5 class="modal-title" id="exportBulanModalLabel">Pilih Bulan <span class="d-block font-weight-normal" style="font-size: 14px;">Pilih untuk mencetak data berdasarkan bulan dan tahun</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="laporan-absensi.php?page=cetak" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="cetak">
          <div class="form-group">
            <label for="Pilih Bulan">Bulan</label>
            <select class="custom-select" name="bulan">
              <option selected value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>

          <div class="form-group">
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" value="<?= date('Y') ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" form="print"><i class="fas fa-file-pdf"></i> Print</button>
      </div>
    </div>
  </div>
</div>