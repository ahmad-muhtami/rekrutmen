<?php

ini_set('date.timezone', 'Asia/Makassar');
$pgn = $_SESSION['id'];
$rl = $_SESSION['role'];

if ($rl == 'pelamar') {
  echo "<script>alert('Maaf, halaman ini hanya dapat diakses oleh staf.');</script>";
  echo "<script>window.location='rekrutmen.php?page=lamar';</script>";
  exit();
}
?>


<div class="container-fluid h-100 p-4 bg-white">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Jadwal / Shift Kerja</h1>
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

      <?php
      include_once '../config/koneksi.php';

      $bulan_ini = date('m');
      $tahun_ini = date('Y');

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

      <div class="col-12">
        <table class="table table-bordered table-striped table-responsive" id="mytable" style="width: 100%;">
          <thead>
            <tr class="text-center">
              <th style="vertical-align: middle;">No</th>
              <th style="vertical-align: middle; min-width: 150px;">Nama</th>

              <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
                <th><?= $d ?></th>
              <?php endfor; ?>
<?php if ($_SESSION['role'] == 'admin') : ?>
  <th style="vertical-align: middle; min-width: 100px;" class="not-export-col">Aksi</th>
  <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query_karyawan = "SELECT karyawan.*, pengguna.nama, bidang_pekerjaan.bidang_pekerjaan AS jabatan FROM karyawan JOIN pengguna ON karyawan.pengguna_id = pengguna.id JOIN bidang_pekerjaan ON karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id WHERE status='aktif' ORDER BY nama ASC";
            $result_karyawan = mysqli_query($koneksi, $query_karyawan);

            while ($karyawan = mysqli_fetch_assoc($result_karyawan)) {
              $id_karyawan = $karyawan['id'];
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $karyawan['nama']; ?> <span class="d-block badge badge-success" style="width: max-content;"><?= $karyawan['jabatan'] ?></span></td>

                <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
                  <?php
                  if (isset($list_shift[$id_karyawan][$d])) {
                    $data_shift = $list_shift[$id_karyawan][$d];
                    $jenis = $data_shift['jenis_shift'];
                    $jam = $data_shift['jam_kerja'];

                    if ($jenis == 'Libur') {
                      $bg_class = 'bg-success text-white';
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
                  }
                  ?>

                  <td class="text-center <?= $bg_class ?>" style="font-size: 12px; white-space: nowrap; vertical-align: middle;">
                    <span class="d-block"><?= $ket ?></span>
                    <?= $konten ?>
                  </td>

                <?php endfor; ?>
<?php if ($_SESSION['role'] == 'admin') : ?>
                <td class="text-center not-export-col">
                  <a href="jadwal.php?page=ubah&id=<?= $id_karyawan; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="jadwal.php?page=hapus&id=<?= $id_karyawan; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
                </td>
        <?php endif; ?>


              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>