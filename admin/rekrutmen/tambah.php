<?php
ini_set('date.timezone', 'Asia/Makassar');
?>
<div class="container-fluid bg-white h-100 pt-4">

  <h1 class="h3 mb-4 text-gray-800">Data Lowongan Kerja</h1>

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
        <form action="lowongan.php?page=proses" method="post">
          <div class="row">

            <div class="col-6">
              <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control " id="judul" placeholder="Judul">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Bidang Pekerjaan</label>
                <select class="form-control" name="bidang_pekerjaan_id">
                  <option value="">Pilih</option>
                  <?php
                  include_once '../config/koneksi.php';
                  $queryBidangPekerjaan = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
                  $resultBidangPekerjaan = mysqli_query($koneksi, $queryBidangPekerjaan);
                  while ($bidang_pekerjaan = mysqli_fetch_assoc($resultBidangPekerjaan)) {
                  ?>
                    <option value='<?= $bidang_pekerjaan['id']; ?>'><?= $bidang_pekerjaan['bidang_pekerjaan']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label>Tanggal Buka</label>
                <input type="date" name="tanggal_buka" class="form-control " id="tanggal_buka">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir" class="form-control " id="tanggal_berakhir">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Salary</label>
                <input type="number" min="0" name="salary" class="form-control " id="salary" placeholder="Salary">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Persyaratan</label>
                <input type="text" name="persyaratan" class="form-control " id="persyaratan" placeholder="Persyaratan">
              </div>
            </div>





          </div>

          <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
        </form>



      </div>
    </div>
  </div>

</div>