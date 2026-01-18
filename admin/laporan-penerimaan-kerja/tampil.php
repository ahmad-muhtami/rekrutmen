<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Penerimaan Kerja <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <div class="d-flex justify-content-end">
      <div>
        <a href="laporan-penerimaan-kerja.php?page=cetak" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak</a>
        <button type="button" class="btn btn-warning fs-5" data-toggle="modal" data-target="#exportBulanModal">
          Pilih Bulan
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
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Jabatan</th>
              <th>Jenis Pekerjaan</th>
              <th>Tanggal Dibuka</th>
              <th>Tanggal Berakhir</th>
              <th>Jumlah Pelamar</th>
              <th>Status Lowongan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;

            $query = "
  SELECT 
      l.id AS lowongan_id,
      l.tanggal_buka,
      l.tanggal_berakhir,
      b.bidang_pekerjaan AS jabatan,
      b.jenis_pekerjaan AS jenis,

      COUNT(r.id) AS jumlah_pelamar
  FROM lowongan_kerja AS l
  JOIN bidang_pekerjaan AS b 
        ON l.bidang_pekerjaan_id = b.id
  LEFT JOIN rekrutmen AS r
        ON r.lowongan_id = l.id
  GROUP BY l.id
  ORDER BY l.tanggal_buka DESC
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
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['jenis']; ?></td>
                <td><?= format_date($row['tanggal_buka']); ?></td>
                <td><?= format_date($row['tanggal_berakhir']); ?></td>
                <td><?= $row['jumlah_pelamar']; ?></td>
                <td>
                  <?php if ($row['tanggal_buka'] >= $row['tanggal_berakhir']): ?>
                    <span>Ditutup</span>
                  <?php else: ?>
                    <span>Dibuka</span>
                  <?php endif; ?>
                </td>
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
        <form action="laporan-penerimaan-kerja.php?page=export" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="export">
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