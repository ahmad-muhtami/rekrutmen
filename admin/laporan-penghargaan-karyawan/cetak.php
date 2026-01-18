<?php

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once  '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
  ob_start();
?>

  <?php

  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];
  switch ($bulan) {
    case '01':
      $bln = 'Januari';
      break;
    case '02':
      $bln = 'Februari';
      break;
    case '03':
      $bln = 'Maret';
      break;
    case '04':
      $bln = 'April';
      break;
    case '05':
      $bln = 'Mei';
      break;
    case '06':
      $bln = 'Juni';
      break;
    case '07':
      $bln = 'Juli';
      break;
    case '08':
      $bln = 'Agustus';
      break;
    case '09':
      $bln = 'September';
      break;
    case '10':
      $bln = 'Oktober';
      break;
    case '11':
      $bln = 'November';
      break;
    case '12':
      $bln = 'Desember';
      break;

    default:
      # code...
      break;
  }
  switch (date('m')) {
    case '01':
      $b = 'Januari';
      break;
    case '02':
      $b = 'Februari';
      break;
    case '03':
      $b = 'Maret';
      break;
    case '04':
      $b = 'April';
      break;
    case '05':
      $b = 'Mei';
      break;
    case '06':
      $b = 'Juni';
      break;
    case '07':
      $b = 'Juli';
      break;
    case '08':
      $b = 'Agustus';
      break;
    case '09':
      $b = 'September';
      break;
    case '10':
      $b = 'Oktober';
      break;
    case '11':
      $b = 'November';
      break;
    case '12':
      $b = 'Desember';
      break;

    default:
      # code...
      break;
  }
  ?>

  <!DOCTYPE html>
  <html lang="eng">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      .table {
        border-collapse: collapse;
        width: 100vw;

      }

      th,
      td {
        padding: 8px;

      }

      table.bordered th,
      table.bordered td {
        border: 1px solid black;
      }

      table.bordered th {
        text-align: center;
      }

      .bg-hadir {
        background-color: #a3e635;
      }

      /* Hijau Muda */
      .bg-sakit {
        background-color: #60a5fa;
        color: white;
      }

      /* Biru */
      .bg-izin {
        background-color: #facc15;
      }

      /* Kuning */
      .bg-alpha {
        background-color: #f87171;
        color: white;
      }

      /* Merah */
      .bg-libur {
        background-color: #e5e7eb;
        color: #9ca3af;
      }

      /* Abu-abu */
    </style>

  </head>

  <body>
    <!-- kop surat -->
    <table class="table">
      <colgroup>
        <col style="width: 10%" class="angka">
        <col style="width: 75%" class="angka">
        <col style="width: 10%" class="angka">
      </colgroup>
      <tr>
        <td>
          <img src="../assets/img/hatara.jpg" height="90" alt="" class="gambar">
        </td>
        <td style="text-align: center; padding: 16px 48px;">


          <span style="font-size: 20px;font-weight: bold;text-align: center;">Hatara Banjarbaru</span>
          <br>
          <span style="font-size: 12px;font-weight: lighter;text-align: center;">Jl. Kembang Bakung, No. 12, Loktabat Utara, <br> Kec. Banjarbaru Utara, Kalimantan Selatan 70714</span>

        </td>
        <td>

        </td>
      </tr>
    </table>
    <!-- kop surat -->


    <hr>


    <br>
    <h2 style="text-align: center; font-size:16px;">Laporan Penghargaan Karyawan Terbaik
    </h2>
    <br>
    <table class="table">
      <colgroup>
        <col style="width: 50%">
        <col style="width: 50%">
      </colgroup>
      <thead>
        <tr>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Dicetak : <?= ucfirst($_SESSION['nama']) ?></td>
          <td style="text-align: right;">Periode : <?= $bln ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <?php
    // LOGIKA PHP PENGAMBILAN DATA
    include_once '../config/koneksi.php';

    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);
    $periode_str = $bln . " " . $tahun;

    // 1. Ambil Data Absensi
    $query_absen = "SELECT absensi.*, shift.tanggal, shift.karyawan_id 
                    FROM absensi 
                    JOIN shift ON absensi.shift_id = shift.id 
                    WHERE MONTH(shift.tanggal) = '$bulan' 
                    AND YEAR(shift.tanggal) = '$tahun'";

    $result_absen = mysqli_query($koneksi, $query_absen);
    $data_absen = [];
    while ($row = mysqli_fetch_assoc($result_absen)) {
        $tgl = (int)date('j', strtotime($row['tanggal']));
        $data_absen[$row['karyawan_id']][$tgl] = $row['keterangan'];
    }

    // 2. Hitung Total & Cari Max
    $q_karyawan = mysqli_query($koneksi, "SELECT karyawan.*, pengguna.nama as nama
                                          FROM karyawan 
                                          JOIN pengguna on karyawan.pengguna_id = pengguna.id
                                          WHERE status='aktif' ORDER BY nama ASC");

    $list_semua_karyawan = [];
    $max_hadir = 0;

    while ($k = mysqli_fetch_assoc($q_karyawan)) {
        $id_kar = $k['id'];
        $total_hadir = 0;
        for ($d = 1; $d <= $jumlah_hari; $d++) {
            if (isset($data_absen[$id_kar][$d]) && $data_absen[$id_kar][$d] == 'Hadir') {
                $total_hadir++;
            }
        }
        $k['total_hadir_bulan'] = $total_hadir;
        $list_semua_karyawan[] = $k;

        if ($total_hadir > $max_hadir) {
            $max_hadir = $total_hadir;
        }
    }

    // 3. Filter Karyawan Terbaik
    $karyawan_terbaik = [];
    if ($max_hadir > 0) {
        foreach ($list_semua_karyawan as $k) {
            if ($k['total_hadir_bulan'] == $max_hadir) {
                $karyawan_terbaik[] = $k;
            }
        }
    }
    ?>

    <table class="table bordered" style="font-size: 12px;">
      <colgroup>
        <col style="width: 8%">
        <col style="width: 67%">
        <col style="width: 25%">
      </colgroup>
      <thead>
        <tr>
          <th style="text-align: left;">No</th>
          <th style="text-align: left;">Nama Karyawan</th>
          <th style="text-align: left;">Jumlah Kehadiran</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($karyawan_terbaik)): ?>
            <tr>
                <td colspan="4" class="text-center">Tidak ada data kehadiran yang ditemukan untuk periode ini.</td>
            </tr>
        <?php else: ?>
            <?php
            $no = 1;
            foreach ($karyawan_terbaik as $k) {
            ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td style="padding-left: 10px;">
                  <span class="text-bold"><?= $k['nama'] ?></span> <br>
                  <span style="font-size: 12px; font-style: italic; color: #555;">(Karyawan Terbaik)</span>
                </td>
                <td class="text-center text-bold"><?= $k['total_hadir_bulan'] ?> Hari</td>
              </tr>
            <?php } ?>
        <?php endif; ?>
      </tbody>
    </table>

<br><br><br>

    <table class="table ">
      <colgroup>
        <col style="width: 60%" class="angka">
        <col style="width: 40%" class="angka">
      </colgroup>



      <tr style="text-align: right;">
        <td></td>
        <td>Banjarbaru, <?= date('d') . ' ' . $b . ' ' . date('Y')  ?> </td>
        <!-- <td>Banjarbaru, 8 Januari 2025</td> -->
      </tr>

      <tr style="text-align: right;">
        <td></td>
        <td>
          <br>
        </td>
      </tr>
      <tr style="text-align: right;">
        <td></td>
        <td>
          <?= ucfirst($_SESSION['nama']) ?>
        </td>
      </tr>
    </table>

  </body>

  </html>

<?php

  $content = ob_get_clean();
  ob_clean();
  $html2pdf = new Html2Pdf('P', 'A4', 'fr');
  $html2pdf->pdf->SetDisplayMode('fullpage');
  $html2pdf->writeHTML($content);
  $html2pdf->output('Laporan_Jadwal.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}
?>