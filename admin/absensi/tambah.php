<?php
ini_set('date.timezone', 'Asia/Makassar');
include_once '../config/koneksi.php';
$pgn = $_SESSION['id'];
$rl = $_SESSION['role'];

if ($rl == 'pelamar') {
  echo "<script>alert('Maaf, halaman ini hanya dapat diakses oleh staf.');</script>";
  echo "<script>window.location='rekrutmen.php?page=lamar';</script>";
  exit();
}


?>

<div class="container-fluid bg-white h-100 pt-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Tambah Data Absensi</h1>
  </div>

  <div class="card card-body border">
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
        <form action="absensi.php?page=proses" method="post">
          <div class="row">
            <?php if ($_SESSION['role'] == 'admin') : ?>

              <div class="col-md-6 mb-3">
                <label>Nama Karyawan</label>
                <select name="karyawan_id" class="form-control" required>
                  <option value="">-- Pilih Karyawan --</option>
                  <?php
                  $q_karyawan = mysqli_query($koneksi, "
            SELECT DISTINCT
                karyawan.id,
                pengguna.nama,
                bidang_pekerjaan.bidang_pekerjaan
            FROM karyawan
            JOIN pengguna 
                ON karyawan.pengguna_id = pengguna.id
            JOIN bidang_pekerjaan 
                ON karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id
            WHERE karyawan.status = 'aktif'
            ORDER BY pengguna.nama ASC
        ");

                  while ($k = mysqli_fetch_assoc($q_karyawan)) {
                    echo "<option value='{$k['id']}'>
                    {$k['nama']} - {$k['bidang_pekerjaan']}
                  </option>";
                  }
                  ?>
                </select>
                <small class="text-muted">Pilih karyawan yang akan diabsen.</small>
              </div>

            <?php endif; ?>


            <?php if ($_SESSION['role'] == 'karyawan') : ?>
              <div class="col-md-6 mb-3">
                <label>Nama Karyawan</label>
                <input type="hidden" name="karyawan_id" class="form-control" value="<?= $_SESSION['karyawan_id'] ?>" readonly>
                <input type="text" name="nama" class="form-control" value="<?= $_SESSION['nama'] ?>" readonly>

              </div>
            <?php endif; ?>





            <div class="col-md-3 mb-3">
              <label>Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>"
                <?php if ($_SESSION['role'] == 'karyawan') : ?>
                readonly
                <?php endif; ?>>
            </div>

            <div class="col-md-3 mb-3">
              <label>Jam Absen</label>
              <input type="time" name="jam" class="form-control" value="<?= date('H:i') ?>"
                <?php if ($_SESSION['role'] == 'karyawan') : ?>
                readonly
                <?php endif; ?>>
            </div>

            <div class="col-md-6 mb-3">
              <label>Keterangan</label>
              <select name="keterangan" class="form-control">
                <option value="Hadir">Hadir</option>
                <option value="Sakit">Sakit</option>
                <option value="Izin">Izin</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
              </select>
            </div>

            <?php if ($_SESSION['role'] == 'admin') : ?>
              <div class="col-md-6 mb-3">
                <label>Catatan (Opsional)</label>
                <textarea name="catatan" class="form-control" placeholder="Contoh: Datang terlambat 15 menit, atau Sakit Demam" rows="1"></textarea>
              </div>
            <?php endif; ?>


          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" name="tambah" value="tambah" class="btn btn-primary px-4">Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>