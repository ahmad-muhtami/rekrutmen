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
                <select class="form-control" name="bidang_pekerjaan_id" id="bidang_pekerjaan">
                  <option value="">Pilih</option>
                  <?php
                  $queryBidangPekerjaan = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
                  $resultBidangPekerjaan = mysqli_query($koneksi, $queryBidangPekerjaan);
                  while ($bidang_pekerjaan = mysqli_fetch_assoc($resultBidangPekerjaan)) {
                  ?>
                    <option
                      value="<?= $bidang_pekerjaan['id']; ?>"
                      data-gaji="<?= $bidang_pekerjaan['gaji_pokok']; ?>"
                      data-jobdesk="<?= $bidang_pekerjaan['jobdesk']; ?>">
                      <?= $bidang_pekerjaan['bidang_pekerjaan']; ?> - <?= $bidang_pekerjaan['jenis_pekerjaan'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi Lowongan</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="jobdesk">Jobdesk</label>
                <textarea class="form-control" id="jobdesk" name="jobdesk" rows="3" readonly></textarea>
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
                <input type="text"
                  name="gaji_pokok"
                  class="form-control"
                  id="gaji_pokok"
                  placeholder="Gaji Pokok"
                  readonly>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Persyaratan</label>
                <input type="text" name="persyaratan" class="form-control " id="persyaratan" placeholder="Persyaratan">
              </div>
            </div>





          </div>

          <button name="tambah" value="tambah" class="btn btn-dark">Simpan</button>
        </form>



      </div>
    </div>
  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const bidangSelect = document.getElementById('bidang_pekerjaan');
    const gajiInput = document.getElementById('gaji_pokok');
    const jobdeskInput = document.getElementById('jobdesk');

    bidangSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const gaji = selectedOption.getAttribute('data-gaji');
      const jobdesk = selectedOption.getAttribute('data-jobdesk');

      if (gaji) {
        gajiInput.value = formatRupiah(gaji);
      } else {
        gajiInput.value = '';
      }

      if (gaji) {
        jobdeskInput.value = jobdesk;
      } else {
        jobdeskInput.value = '';
      }
    });

    function formatRupiah(angka) {
      return 'Rp. ' + Number(angka).toLocaleString('id-ID');
    }
  });
</script>