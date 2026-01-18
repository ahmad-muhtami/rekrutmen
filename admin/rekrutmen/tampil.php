<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Rekrutmen & Seleksi </h1>

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
              <th>Pelamar</th>
              <th>Posisi/Jabatan</th>
              <th>Tanggal</th>
              <th>Email</th>
              <th>Status</th>
              <th>Catatan</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $nomor = 1;
            $query = "
SELECT 
    rekrutmen.*,
    pengguna.nama AS nama_pelamar,
    pengguna.nomor_telepon AS nomor_telepon,
    lowongan_kerja.judul AS judul_lowongan,
    bidang_pekerjaan.bidang_pekerjaan AS nama_bidang
FROM rekrutmen
JOIN pengguna 
    ON rekrutmen.pelamar_id = pengguna.id
JOIN lowongan_kerja 
    ON rekrutmen.lowongan_id = lowongan_kerja.id
JOIN bidang_pekerjaan 
    ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id
ORDER BY rekrutmen.id DESC
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
                <td><?= $nomor++; ?></td>
                <td><?= $row['nama_pelamar']; ?></td>
                <td><?= $row['nama_bidang']; ?></td>
                <td><?= format_date($row['tanggal']); ?></td>
                <td><?= $row['email']; ?></td>
                <td class="text-capitalize"><?= $row['status']; ?></td>
                <td><?= $row['catatan']; ?></td>



                <td class="not-export-col">
                  <button type="button" data-toggle="modal" data-target="#exampleModal<?= $row['id'] ?>" class="btn btn-sm btn-dark">Lihat</button>
                  <a href="rekrutmen.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                  <a href="rekrutmen.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>

                </td>

              </tr>

              <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModal<?= $row['id'] ?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Detail Rekrutmen</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12 border-bottom pt-3">
                          <h1 class="h5 mb-3">Informasi Pribadi</h1>

                          <p><strong>Nama Pelamar :</strong> <span class="d-block"><?= $row['nama_pelamar']; ?></span></p>
                          <p><strong>Posisi/Jabatan :</strong> <span class="d-block"><?= $row['judul_lowongan']; ?></span></p>
                          <p><strong>Tanggal Lamar :</strong> <span class="d-block"><?= format_date($row['tanggal']); ?></span></p>
                          <p><strong>Email :</strong> <span class="d-block"><?= $row['email']; ?></span></p>
                          <p><strong>No. Telepon :</strong> <span class="d-block"><?= $row['nomor_telepon']; ?></span></p>
                          <p><strong>NIK :</strong> <span class="d-block"><?= $row['no_ktp']; ?></span></p>
                          <p><strong>Tempat Lahir :</strong> <span class="d-block"><?= $row['tempat_lahir']; ?></span></p>
                          <p><strong>Tanggal Lahir :</strong> <span class="d-block"><?= format_date($row['tanggal_lahir']); ?></span></p>
                          <p><strong>Usia :</strong> <span class="d-block"><?= date_diff(date_create($row['tanggal_lahir']), date_create('today'))->y; ?> Tahun</span></p>
                          <p><strong>Agama :</strong> <span class="d-block"><?= $row['agama']; ?></span></p>
                          <p><strong>Alamat Domisili :</strong> <span class="d-block"><?= $row['alamat_domisili']; ?></span></p>

                        </div>
                        <div class="col-12 border-bottom pt-3">
                          <h1 class="h5 mb-3">Jawaban Tes Seleksi</h1>

                          <?php
                          $no = 1;
                          $query = "SELECT jawaban.*, pertanyaan.pertanyaan AS pertanyaan FROM jawaban JOIN pertanyaan ON jawaban.pertanyaan_id = pertanyaan.id WHERE rekrutmen_id = " . $row['id'] . " AND pelamar_id = " . $row['pelamar_id'];
                          $jawaban_result = mysqli_query($koneksi, $query);
                          ?>
                          <?php while ($jawaban = mysqli_fetch_assoc($jawaban_result)) { ?>
                            <p><strong><?= $no++; ?>. <?= $jawaban['pertanyaan']; ?></strong><br>
                              "<?= $jawaban['jawaban']; ?>"
                            </p>
                          <?php } ?>
                        </div>
                        <hr>
                        <div class="col-12 pt-3">
                          <h1 class="h5">Lampiran</h1>
                          <a href="./uploads/<?= $row['cv']; ?>" target="_blank" class="btn btn-outline-primary d-block w-100 text-left mb-2"><?= $row['cv']; ?></a>

                          <?php
                          $queryLampiran = "SELECT * FROM lampiran WHERE rekrutmen_id = " . $row['id'] . " AND pelamar_id = " . $row['pelamar_id'];
                          $lampiran_result = mysqli_query($koneksi, $queryLampiran);
                          ?>
                          <?php while ($lampiran = mysqli_fetch_assoc($lampiran_result)) { ?>
                            <a href="./uploads/<?= $lampiran['lampiran']; ?>" target="_blank" class="btn btn-outline-primary d-block w-100 text-left mb-2"><?= $lampiran['lampiran']; ?></a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>