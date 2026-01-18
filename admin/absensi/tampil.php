<?php
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
    <h1 class="h4 text-gray-800">Data Absensi </h1>
    <a href="absensi.php?page=tambah" class="btn btn-dark">Tambah</a>

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
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jam Kerja</th>
              <th>Jenis Shift</th>
              <th>Tanggal Absen</th>
              <th>Jam Absen</th>
              <th>Keterangan</th>
              <th>Catatan</th>
              <?php if ($_SESSION['role'] == 'admin') : ?>
                <th style="width: 150px;" class="not-export-col">Aksi</th>
                <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "
    SELECT 
        absensi.id,
        absensi.waktu_absen,
        absensi.keterangan,
        absensi.catatan,
        shift.jam_kerja,
        shift.jenis_shift,
        pengguna.nama AS nama_karyawan
    FROM absensi
    JOIN shift ON absensi.shift_id = shift.id
    JOIN karyawan ON shift.karyawan_id = karyawan.id
    JOIN pengguna ON karyawan.pengguna_id = pengguna.id
    ORDER BY absensi.id DESC
";

            $result = mysqli_query($koneksi, $query);

            if (!function_exists('format_date')) {
              function format_date($date)
              {
                if (empty($date) || $date === '0000-00-00') {
                  return '';
                }
                $ts = strtotime($date);
                if ($ts === false) {
                  return $date;
                }
                return date('d-m-Y', $ts);
              }
            }

            if (!function_exists('format_datetime')) {
              function format_datetime($datetime)
              {
                if (empty($datetime)) {
                  return '';
                }
                $ts = strtotime($datetime);
                if ($ts === false) {
                  return $datetime;
                }
                return date('H:i:s', $ts); // jam absen
              }
            }


            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td class="text-nowrap"><?= $row['nama_karyawan']; ?></td>
                <td class="text-nowrap"><?= $row['jam_kerja']; ?></td>
                <td class="text-nowrap"><?= $row['jenis_shift']; ?></td>
                <td class="text-nowrap"><?= format_date($row['waktu_absen']); ?></td>
                <td class="text-nowrap"><?= format_datetime($row['waktu_absen']); ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td><?= $row['catatan']; ?></td>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                <td class="not-export-col">
                  <a href="absensi.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="absensi.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                    onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
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

                
