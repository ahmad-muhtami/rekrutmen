<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Lowongan Kerja </h1>
    <a href="lowongan.php?page=tambah" class="btn btn-dark">Tambah</a>

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
        <table class="table table-bordered table-striped table-responsive" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Bidang Pekerjaan</th>
              <th>Deskripsi</th>
              <th>Jobdesk</th>
              <th>Tanggal Buka</th>
              <th>Tanggal Berakhir</th>
              <th>Salary</th>
              <th>Persyaratan</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "SELECT lowongan_kerja.*, bidang_pekerjaan.bidang_pekerjaan AS bidang_pekerjaan, bidang_pekerjaan.jenis_pekerjaan AS jenis_pekerjaan, bidang_pekerjaan.jobdesk AS jobdesk, bidang_pekerjaan.gaji_pokok AS gaji_pokok
          FROM lowongan_kerja 
          JOIN bidang_pekerjaan ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id 
          ORDER BY lowongan_kerja.id DESC";
            $result = mysqli_query($koneksi, $query);

            if (!function_exists('format_date')) {
              function format_date($date) {
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

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr class="text-nowrap">
                <td class=""><?= $no++; ?></td>
                <td class=""><?= $row['judul']; ?></td>
                <td class=""><?= $row['bidang_pekerjaan']; ?></td>
                <td class=""><?= $row['deskripsi']; ?></td>
                <td class=""><?= $row['jobdesk']; ?></td>
                <td class=""><?= format_date($row['tanggal_buka']); ?></td>
                <td class=""><?= format_date($row['tanggal_berakhir']); ?></td>
                <td class=""><?= 'Rp ' . number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
                <td class=""><?= $row['persyaratan']; ?></td>


                <td class="not-export-col">
                  <a href="lowongan.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="lowongan.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>