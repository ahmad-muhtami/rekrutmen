<?php
ini_set('date.timezone', 'Asia/Makassar');
include_once '../config/koneksi.php';

$pgn = $_SESSION['id'];
$rl = $_SESSION['role'];
$kr_id = isset($_SESSION['karyawan_id']) ? $_SESSION['karyawan_id'] : '';


if ($rl == 'pelamar') {
  echo "<script>alert('Maaf, halaman ini hanya dapat diakses oleh staf.');</script>";
  echo "<script>window.location='rekrutmen.php?page=lamar';</script>";
  exit();
}

$bulan_ini = date('m');
$tahun_ini = date('Y');
$periode_sql = "$tahun_ini-$bulan_ini-01";

$queryKaryawan = mysqli_query($koneksi, "SELECT karyawan.*, bidang_pekerjaan.gaji_pokok AS gaji_pokok, tunjangan.nominal AS nominal 
FROM karyawan 
JOIN bidang_pekerjaan ON karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id 
LEFT JOIN tunjangan ON karyawan.tunjangan_id = tunjangan.id 
WHERE karyawan.status='aktif'");

while ($karyawan = mysqli_fetch_assoc($queryKaryawan)) {
  $id_karyawan = $karyawan['id'];
  $gaji_pokok  = $karyawan['gaji_pokok'];
  $tunjangan   = isset($karyawan['nominal']) ? $karyawan['nominal'] : 0;

  $total_insentif = 0;

  $total_gaji = $gaji_pokok + $tunjangan + $total_insentif;

  $cek_gaji = mysqli_query($koneksi, "SELECT id FROM penggajihan WHERE karyawan_id = '$id_karyawan' AND MONTH(periode) = '$bulan_ini' AND YEAR(periode) = '$tahun_ini'");

  if (mysqli_num_rows($cek_gaji) > 0) {
    $data_existing = mysqli_fetch_assoc($cek_gaji);
    $id_gaji_existing = $data_existing['id'];

    $sql_update = "UPDATE penggajihan SET 
                       total_gaji_pokok = '$gaji_pokok',
                       tunjangan = '$tunjangan',
                       total_gaji = total_gaji_pokok + tunjangan + total_insentif
                       WHERE id = '$id_gaji_existing'";
    mysqli_query($koneksi, $sql_update);
  } else {
    $sql_insert = "INSERT INTO penggajihan (karyawan_id, periode, total_gaji_pokok, tunjangan, total_insentif, total_gaji) 
                       VALUES ('$id_karyawan', '$periode_sql', '$gaji_pokok', '$tunjangan', '$total_insentif', '$total_gaji')";
    mysqli_query($koneksi, $sql_insert);
  }
}
?>

<div class="container-fluid h-100 p-4 bg-white">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Penggajian Karyawan</h1>
  </div>

  <div class="card card-body border-0 p-0 mt-2">
    <div class="row">
      <div class="col-12">
        <?php if (isset($_SESSION['result'])) { ?>
          <div class="alert alert-<?= ($_SESSION['result'] == 'success') ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['message'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
          unset($_SESSION['result']);
          unset($_SESSION['message']);
        } ?>
      </div>



      <div class="col-12">
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Periode</th>
              <th>Gaji Pokok</th>
              <th>Tunjangan</th>
              <th>Total Insentif</th>
              <th>Total Gaji</th>
<?php if ($_SESSION['role'] == 'admin') : ?>

              <th style="width: 150px;" class="not-export-col">Aksi</th>
        <?php endif; ?>

            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = "
  SELECT 
    penggajihan.*,
    pengguna.nama AS nama_karyawan
  FROM penggajihan
  JOIN karyawan ON penggajihan.karyawan_id = karyawan.id
  JOIN pengguna ON karyawan.pengguna_id = pengguna.id
  WHERE karyawan_id = '$kr_id'
  ORDER BY penggajihan.periode DESC
";
            $result = mysqli_query($koneksi, $query);


            if (!function_exists('format_date_indo')) {
              function format_date_indo($date)
              {
                if (empty($date) || $date == '0000-00-00') return '-';
                $bulan = [
                  1 => 'Januari',
                  'Februari',
                  'Maret',
                  'April',
                  'Mei',
                  'Juni',
                  'Juli',
                  'Agustus',
                  'September',
                  'Oktober',
                  'November',
                  'Desember'
                ];
                $ts = strtotime($date);
                $bln_angka = (int)date('m', $ts);
                $thn = date('Y', $ts);
                return $bulan[$bln_angka] . ' ' . $thn;
              }
            }

            while ($row = mysqli_fetch_assoc($result)) {
              $db_gaji_pokok = $row['total_gaji_pokok'];
              $db_tunjangan  = isset($row['tunjangan']) ? $row['tunjangan'] : $row['tunjangan'];
              $db_insentif   = $row['total_insentif'];
              $db_total      = $row['total_gaji'];
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_karyawan']; ?></td>
                <td><?= format_date_indo($row['periode']); ?></td>
                <td>Rp <?= number_format($db_gaji_pokok, 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($db_tunjangan, 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($db_insentif, 0, ',', '.'); ?></td>
                <td style="font-weight: bold;">Rp <?= number_format($db_total, 0, ',', '.'); ?></td>
<?php if ($_SESSION['role'] == 'admin') : ?>
                <td class="not-export-col">
                  <a href="penggajian.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="penggajian.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>

                </td>
        <?php endif; ?>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>