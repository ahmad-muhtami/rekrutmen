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
    <h2 style="text-align: center; font-size:16px;">Laporan Absensi Karyawan
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
    include_once '../config/koneksi.php';
    $bulan_ini = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
    $tahun_ini = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

    // Hitung Jumlah Hari
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan_ini, (int)$tahun_ini);
    $nama_bulan  = $bulan;

    // 2. Ambil Data Absensi & Susun ke Array
    // Kita perlu join: absensi -> shift -> karyawan
    $query_absen = "SELECT absensi.*, shift.tanggal, shift.karyawan_id 
                    FROM absensi 
                    JOIN shift ON absensi.shift_id = shift.id 
                    WHERE MONTH(shift.tanggal) = '$bulan_ini' 
                    AND YEAR(shift.tanggal) = '$tahun_ini'";

    $result_absen = mysqli_query($koneksi, $query_absen);

    // Format Array: $data_absen[id_karyawan][tanggal] = 'Hadir'/'Sakit'/dll
    $data_absen = [];
    while ($row = mysqli_fetch_assoc($result_absen)) {
      $tgl = (int)date('j', strtotime($row['tanggal']));
      $data_absen[$row['karyawan_id']][$tgl] = $row['keterangan'];
    }
    ?>

    <table class="table bordered" style="font-size: 9px;">
      <colgroup>
        <col style="width: 3%">
        <col style="width: 10%"> <?php
                                  // Sisa lebar = 100% - 18% (No+Nama) - 12% (Total) = 70%
                                  // 70% dibagi jumlah hari (misal 30) = ~2.3% per hari
                                  $width_tgl = 70 / $jumlah_hari;
                                  for ($d = 1; $d <= $jumlah_hari; $d++) {
                                    echo "<col style='width: {$width_tgl}%'>";
                                  }
                                  ?>
        <col style="width: 3%">
        <col style="width: 3%">
        <col style="width: 3%">
        <col style="width: 3%">
      </colgroup>
      <thead>
        <tr>
          <th rowspan="2">No</th>
          <th rowspan="2">Nama Karyawan</th>
          <th colspan="<?= $jumlah_hari ?>">Tanggal</th>
          <th colspan="4">Total</th>
        </tr>
        <tr>
          <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
            <th><?= $d ?></th>
          <?php endfor; ?>
          <th>H</th>
          <th>S</th>
          <th>I</th>
          <th>A</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        // Ambil Karyawan Aktif
        $q_karyawan = mysqli_query($koneksi, "SELECT karyawan.*, pengguna.nama as nama
        FROM karyawan 
        join pengguna on karyawan.pengguna_id = pengguna.id
        WHERE status='aktif' ORDER BY nama ASC");

        while ($k = mysqli_fetch_assoc($q_karyawan)) {
          $id = $k['id'];

          // Inisialisasi Counter
          $tot_h = 0;
          $tot_s = 0;
          $tot_i = 0;
          $tot_a = 0;
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td class="text-left"><?= $k['nama'] ?></td>

            <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
              <?php
              $status = '';
              $class = '';
              $kode = '';

              // Cek Data Absensi
              if (isset($data_absen[$id][$d])) {
                $status = $data_absen[$id][$d];

                if ($status == 'Hadir') {
                  $class = 'bg-hadir';
                  $kode = 'H'; // Centang
                  $tot_h++;
                } elseif ($status == 'Sakit') {
                  $class = 'bg-sakit';
                  $kode = 'S';
                  $tot_s++;
                } elseif ($status == 'Izin') {
                  $class = 'bg-izin';
                  $kode = 'I';
                  $tot_i++;
                } elseif ($status == 'Tidak Hadir') {
                  $class = 'bg-alpha';
                  $kode = 'A';
                  $tot_a++;
                }
              }
              // Jika tidak absen, cek apakah itu hari libur (Opsional, perlu query shift)
              // Untuk simpelnya, jika kosong kita beri tanda strip
              else {
                $kode = '<span style="color:#ccc">-</span>';
              }
              ?>
              <td class="<?= $class ?>"><?= $kode ?></td>
            <?php endfor; ?>

            <td style="font-weight:bold;"><?= $tot_h ?></td>
            <td style="font-weight:bold;"><?= $tot_s ?></td>
            <td style="font-weight:bold;"><?= $tot_i ?></td>
            <td style="font-weight:bold; background-color: #fee2e2;"><?= $tot_a ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>


    <h2 style="text-align: left; font-size:12px; margin-bottom: 10px;">Keterangan:
    </h2>
    <p style="margin: 0px; margin-bottom: 3px; font-size: 12px;"></p> Hadir (H)
    <p style="margin: 0px; margin-bottom: 3px; font-size: 12px;"></p> Sakit (S)
    <p style="margin: 0px; margin-bottom: 3px; font-size: 12px;"></p> Izin (I)
    <p style="margin: 0px; margin-bottom: 3px; font-size: 12px;"></p> Alpha (A)

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
  $html2pdf = new Html2Pdf('L', 'A4', 'fr');
  $html2pdf->pdf->SetDisplayMode('fullpage');
  $html2pdf->writeHTML($content);
  $html2pdf->output('Laporan_Jadwal.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}
?>