<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Data Karyawan <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <div class="d-flex justify-content-end">
      <div>
        <a href="laporan-data-karyawan.php?page=cetak" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak</a>

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
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Jenis Pekerjaan</th>
              <th>Nomor Telepon</th>
              <th>Gaji Pokok</th>
              <th>Tunjangan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;

            $query = "
SELECT karyawan.*, bidang_pekerjaan.bidang_pekerjaan AS jabatan, bidang_pekerjaan.jenis_pekerjaan AS jenis_pekerjaan, bidang_pekerjaan.gaji_pokok AS gaji_pokok, pengguna.nama, tunjangan.nominal as tunjangan
FROM karyawan
join bidang_pekerjaan on karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id 
join pengguna on karyawan.pengguna_id = pengguna.id 
left join tunjangan on karyawan.tunjangan_id = tunjangan.id
ORDER BY jabatan ASC
";
            $result = mysqli_query($koneksi, $query);
            
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['jenis_pekerjaan']; ?></td>
                <td><?= $row['nomor_telepon']; ?></td>
                <td>Rp <?= number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($row['tunjangan'], 0, ',', '.'); ?></td>
                <td><?= $row['status']; ?></td>

              </tr>


            <?php } ?>
          </tbody>
        </table>


      </div>

    </div>
  </div>

</div>