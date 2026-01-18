<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Karyawan </h1>
    <a href="karyawan.php?page=tambah" class="btn btn-dark">Tambah</a>

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
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>No. Telepon</th>
              <th>Gaji Pokok</th>
              <th>Tunjangan</th>
              <th>Jenis Tunjangan</th>
              <th>Status</th>
              <th>Tanggal Bergabung</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "
  SELECT 
    k.id,
    p.nama,
    k.nomor_telepon,
    k.status,
    k.tanggal_bergabung,
    bp.bidang_pekerjaan,
    bp.jenis_pekerjaan,
    bp.gaji_pokok,
    t.jenis_tunjangan,
    t.nominal AS tunjangan
  FROM karyawan k
  JOIN pengguna p ON k.pengguna_id = p.id
  JOIN bidang_pekerjaan bp ON k.bidang_pekerjaan_id = bp.id
  LEFT JOIN tunjangan t ON k.tunjangan_id = t.id
  ORDER BY k.id DESC
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
                <td class="text-nowrap"><?= $no++; ?></td>
                <td class="text-nowrap"><?= $row['nama']; ?></td>
                <td class="text-nowrap"><?= $row['bidang_pekerjaan']; ?> - <?= $row['jenis_pekerjaan']; ?></td>

                <td class="text-nowrap">
                  <?php if (!empty($row['nomor_telepon'])) : ?>
                    <?= htmlspecialchars($row['nomor_telepon']); ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>

                </td>
                <td class="text-nowrap"><?= 'Rp ' . number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>


                <td class="text-nowrap">
                  <?= $row['tunjangan'] !== null
                    ? 'Rp ' . number_format($row['tunjangan'], 0, ',', '.')
                    : '-' ?>
                </td>

                <td class="text-nowrap"><?= $row['jenis_tunjangan']; ?></td>



                <td class="text-capitalize">
                  <?php if (!empty($row['status'])) : ?>
                    <?= htmlspecialchars($row['status']); ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>

                </td>

                <td class="text-nowrap"><?= format_date($row['tanggal_bergabung']) ?></td>


                <td class="not-export-col">
                  <a href="karyawan.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="karyawan.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>