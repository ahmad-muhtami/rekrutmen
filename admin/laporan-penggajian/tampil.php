<?php

ini_set('date.timezone', 'Asia/Makassar');

$bulan = date('m');
$tahun = date('Y');
?>

<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Penggajian Karyawan <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <div class="d-flex justify-content-end">
      <div>
        <button type="button" class="btn btn-danger fs-5" data-toggle="modal" data-target="#exportBulanModal">
          <i class="fas fa-file-pdf"></i> Cetak
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
        <?php
        // Query Utama
        $query_gaji = "
          SELECT 
              penggajihan.*,
              pengguna.nama,
              bidang_pekerjaan.bidang_pekerjaan as jabatan
          FROM penggajihan
          JOIN karyawan ON penggajihan.karyawan_id = karyawan.id
          JOIN pengguna on karyawan.pengguna_id = pengguna.id
          JOIN bidang_pekerjaan on karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id
          WHERE MONTH(penggajihan.periode) = '$bulan'
            AND YEAR(penggajihan.periode) = '$tahun'
          ORDER BY pengguna.nama ASC
        ";


        $result_gaji = mysqli_query($koneksi, $query_gaji);
        ?>
        <table class="table table-bordered table-striped table-responsive" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Karyawan</th>
              <th>Jabatan</th>
              <th>Gaji Pokok</th>
              <th>Tunjangan</th>
              <th>Ket. Insentif</th>
              <th>Rincian Insentif</th>

              <th>Total Insentif</th>
              <th>Total Diterima</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $grand_pokok = 0;
            $grand_tunjangan = 0;
            $grand_insentif = 0;
            $grand_total = 0;

            if (mysqli_num_rows($result_gaji) > 0) {
              while ($row = mysqli_fetch_assoc($result_gaji)) {
                // Hitung Grand Total
                $grand_pokok += $row['total_gaji_pokok'];
                $grand_tunjangan += $row['tunjangan'];
                $grand_insentif += $row['total_insentif'];
                $grand_total += $row['total_gaji'];

                // --- LOGIKA MENGAMBIL RINCIAN INSENTIF ---
                $id_gaji = $row['id'];
                $q_ins = mysqli_query($koneksi, "SELECT * FROM insentif WHERE penggajihan_id = '$id_gaji'");

                // Variabel penampung string HTML
                $str_ket = "";
                $str_nom = "";

                if (mysqli_num_rows($q_ins) > 0) {
                  while ($ins = mysqli_fetch_assoc($q_ins)) {
                    // Susun Keterangan (misal: - Lembur)
                    $str_ket .= "<div class='list-item'>- " . $ins['keterangan'] . "</div>";
                    // Susun Nominal (misal: Rp 50.000)
                    $str_nom .= "<div class='list-item'>Rp " . number_format($ins['total'], 0, ',', '.') . "</div>";
                  }
                } else {
                  $str_ket = "-";
                  $str_nom = "-";
                }
            ?>
                <tr>
                  <td class="text-left"><?= $no++; ?></td>
                  <td><?= $row['nama']; ?></td>
                  <td class="text-left"><?= $row['jabatan']; ?></td>
                  <td class="text-left text-nowrap">Rp <?= number_format($row['total_gaji_pokok'], 0, ',', '.'); ?></td>
                  <td class="text-left text-nowrap">Rp <?= number_format($row['tunjangan'], 0, ',', '.'); ?></td>

                  <td><?= $str_ket ?></td>
                  <td class="text-left"><?= $str_nom ?></td>

                  <td class="text-left text-nowrap">Rp <?= number_format($row['total_insentif'], 0, ',', '.'); ?></td>
                  <td class="text-left text-nowrap text-bold">Rp <?= number_format($row['total_gaji'], 0, ',', '.'); ?></td>
                </tr>
            <?php
              }
            } ?>
          </tbody>
          <!-- <?php if (mysqli_num_rows($result_gaji) > 0) { ?>
            <tfoot>
              <tr class="" style="background-color: #e0e0e0;">
                <td colspan="3" class="text-left font-weight-bold">Total Pengeluaran</td>

                <td class="text-left text-nowrap font-weight-bold">Rp <?= number_format($grand_pokok, 0, ',', '.') ?></td>

                <td class="text-left text-nowrap font-weight-bold">Rp <?= number_format($grand_tunjangan, 0, ',', '.') ?></td>

                <td></td>
                <td></td>

                <td class="text-left text-nowrap font-weight-bold">Rp <?= number_format($grand_insentif, 0, ',', '.') ?></td>

                <td class="text-left text-nowrap font-weight-bold">Rp <?= number_format($grand_total, 0, ',', '.') ?></td>
              </tr>
            </tfoot>
          <?php } ?> -->
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
        <form action="laporan-penggajian.php?page=cetak" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="cetak">
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