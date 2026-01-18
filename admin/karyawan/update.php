<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "
  SELECT 
    k.id,
    k.pengguna_id,
    k.bidang_pekerjaan_id,
    k.tunjangan_id,
    k.nomor_telepon,
    k.status,
    k.tanggal_bergabung,
    p.nama,
    bp.gaji_pokok
  FROM karyawan k
  JOIN pengguna p ON k.pengguna_id = p.id
  JOIN bidang_pekerjaan bp ON k.bidang_pekerjaan_id = bp.id
  WHERE k.id = $id
";

$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

  if (!$row) {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'Data tidak ditemukan!';
    header("Location: karyawan.php?page=tampil");
    exit;
  }
} else {
  $_SESSION['result'] = 'error';
  $_SESSION['message'] = 'ID tidak ditemukan!';
  header("Location: karyawan.php?page=tampil");
  exit;
}
?>
<div class="container-fluid bg-white h-100 pt-4">

  <h1 class="h3 mb-4 text-gray-800">Ubah Data Karyawan</h1>

  <div class="card card-body">
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
        <form action="karyawan.php?page=proses_ubah" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($row['nama']); ?>" readonly>

              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control " id="nomor_telepon"  value="<?= $row['nomor_telepon'] ?>" placeholder="Nomor Telepon">
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label>Bidang Pekerjaan</label>
                <select class="form-control" name="bidang_pekerjaan_id" id="bidang_pekerjaan">
  <option value="">Pilih</option>
  <?php
  $qBP = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
  $rBP = mysqli_query($koneksi, $qBP);
  while ($bp = mysqli_fetch_assoc($rBP)) {
    $selected = ($bp['id'] == $row['bidang_pekerjaan_id']) ? 'selected' : '';
  ?>
    <option value="<?= $bp['id']; ?>" data-gaji="<?= $bp['gaji_pokok']; ?>" <?= $selected; ?>>
      <?= $bp['bidang_pekerjaan']; ?> - <?= $bp['jenis_pekerjaan']; ?>
    </option>
  <?php } ?>
</select>

              </div>
            </div>
            
            <div class="col-6">
              <div class="form-group">
                <label>Gaji Pokok</label>
                <input type="text" 
       name="gaji_pokok" 
       class="form-control" 
       id="gaji_pokok" 
       value="<?= 'Rp. ' . number_format($row['gaji_pokok'], 0, ',', '.'); ?>" 
       readonly>

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Tunjangan</label>
                <select class="form-control" name="tunjangan_id">
  <option value="">Pilih</option>
  <?php
  $qt = "SELECT * FROM tunjangan ORDER BY id DESC";
  $rt = mysqli_query($koneksi, $qt);
  while ($t = mysqli_fetch_assoc($rt)) {
    $selected = ($t['id'] == $row['tunjangan_id']) ? 'selected' : '';
  ?>
    <option value="<?= $t['id']; ?>" <?= $selected; ?>>
      <?= $t['jenis_tunjangan']; ?> - Rp. <?= number_format($t['nominal'], 0, ',', '.'); ?>
    </option>
  <?php } ?>
</select>

              </div>
            </div>

            

            <div class="col-6">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                  <option value="aktif" <?= $row['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                  <option value="tidak aktif" <?= $row['status'] == 'tidak aktif' ? 'selected' : ''; ?>>Tidak aktif</option>
                </select>
              </div>
            </div>


            <div class="col-6">
               <div class="form-group">
                 <label>Tanggal Bergabung</label>
                 <input type="date"
                   name="tanggal_bergabung"
                   class="form-control"
                   value="<?= $row['tanggal_bergabung'] ?>"
                   id="tanggal_bergabung">
               </div>
             </div>

          </div>

          <input type="hidden" name="id" value="<?= $row['id']; ?>">


          <button name="update" value="update" class="btn btn-primary">Ubah</button>
        </form>

      </div>
    </div>
  </div>

</div>

<script>
document.getElementById('bidang_pekerjaan').addEventListener('change', function () {
  const option = this.options[this.selectedIndex];
  const gaji = option.getAttribute('data-gaji');
  document.getElementById('gaji_pokok').value = gaji
    ? 'Rp. ' + Number(gaji).toLocaleString('id-ID')
    : '';
});
</script>
