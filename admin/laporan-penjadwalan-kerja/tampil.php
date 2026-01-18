<?php

ini_set('date.timezone', 'Asia/Makassar');

$bulan_ini = date('m');
$tahun_ini = date('Y');
?>

<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Penjadwalan Kerja <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
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



        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);

        $query_shift = "SELECT * FROM shift 
                        WHERE MONTH(tanggal) = '$bulan_ini' 
                        AND YEAR(tanggal) = '$tahun_ini'";
        $result_shift = mysqli_query($koneksi, $query_shift);

        $list_shift = [];
        while ($row_s = mysqli_fetch_assoc($result_shift)) {
          $tgl_angka = (int)date('j', strtotime($row_s['tanggal']));
          $list_shift[$row_s['karyawan_id']][$tgl_angka] = $row_s;
        }
        ?>
        <table class="table table-bordered table-striped table-responsive" id="mytable" style="width: 100%;">
          <thead>
            <tr class="text-center">
              <th style="vertical-align: middle;">No</th>
              <th style="vertical-align: middle; min-width: 150px;">Nama</th>

              <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
                <th><?= $d ?></th>
              <?php endfor; ?>

            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query_karyawan = "SELECT karyawan.*, pengguna.nama as nama
            FROM karyawan
                join pengguna on karyawan.pengguna_id = pengguna.id
             WHERE status='aktif' ORDER BY nama ASC";
            $result_karyawan = mysqli_query($koneksi, $query_karyawan);

            while ($karyawan = mysqli_fetch_assoc($result_karyawan)) {
              $id_karyawan = $karyawan['id'];
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $karyawan['nama']; ?></td>

                <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
                  <?php
                  if (isset($list_shift[$id_karyawan][$d])) {
                    $data_shift = $list_shift[$id_karyawan][$d];
                    $jenis = $data_shift['jenis_shift'];
                    $jam = $data_shift['jam_kerja'];

                    if ($jenis == 'Libur') {
                      $bg_class = 'bg-danger text-white';
                      $konten = 'Libur';
                      $ket = '';
                    } elseif ($jenis == 'Lembur') {
                      $bg_class = 'bg-primary text-white';
                      $ket = 'Lembur';
                      $konten = $jam;
                    } else {
                      $bg_class = 'bg-white text-black';
                      $ket = $jenis;
                      $konten = $jam;
                    }
                  } else {
                    $bg_class = '';
                    $konten = '-';
                    $ket = '';
                  }
                  ?>

                  <td class="text-center" style="font-size: 12px; white-space: nowrap; vertical-align: middle;">
                    <span class="d-block"><?= $ket ?></span>
                    <?= $konten ?>
                  </td>

                <?php endfor; ?>

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
        <form action="laporan-penjadwalan-kerja.php?page=cetak" method="get" id="print" target="_blank">
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