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
    <h2 style="text-align: center; font-size:16px;">Laporan Penjadwalan Kerja Karyawan
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
    // Perbaikan variabel dari diskusi sebelumnya
    $bulan_ini = $_GET['bulan'];
    $tahun_ini = $_GET['tahun']; 

    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan_ini, (int)$tahun_ini);

    // --- LOGIKA MENGHITUNG LEBAR KOLOM (COLGROUP) ---
    // Total lebar 100%. 
    // Kita alokasikan: No (3%), Nama (17%). Sisa 80% untuk Tanggal.
    $width_no = 3;
    $width_nama = 10;
    $sisa_width = 100 - $width_no - $width_nama;
    
    // Lebar per kolom tanggal
    $width_per_tgl = $sisa_width / $jumlah_hari; 
    
    // Ambil Data Shift
    $query_shift = "SELECT * FROM shift WHERE MONTH(tanggal) = '$bulan_ini' AND YEAR(tanggal) = '$tahun_ini'";
    $result_shift = mysqli_query($koneksi, $query_shift);
    $list_shift = [];
    while ($row_s = mysqli_fetch_assoc($result_shift)) {
      $tgl_angka = (int)date('j', strtotime($row_s['tanggal']));
      $list_shift[$row_s['karyawan_id']][$tgl_angka] = $row_s;
    }
    ?>

    <table class="table bordered" style="font-size: 9px;">
      <colgroup>
        <col style="width: <?= $width_no ?>%">
        <col style="width: <?= $width_nama ?>%">
        <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
            <col style="width: <?= $width_per_tgl ?>%">
        <?php endfor; ?>
      </colgroup>
      <thead>
        <tr class="text-center">
          <th rowspan="2" style="width: <?= $width_no ?>%">No</th>
          <th rowspan="2" style="width: <?= $width_nama ?>%">Nama</th>
          
          <th colspan="<?= $jumlah_hari ?>" style="background-color: yellow;">Tanggal</th>
        </tr>

        <tr class="text-center">
          <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
            <th><?= $d ?></th>
          <?php endfor; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query_karyawan = "SELECT karyawan.*, pengguna.nama as nama
            FROM karyawan
                join pengguna on karyawan.pengguna_id = pengguna.id
             WHERE status='aktif' ORDER BY nama ASC";
        $result_karyawan = mysqli_query($koneksi, $query_karyawan);

        while ($karyawan = mysqli_fetch_assoc($result_karyawan)) {
          $id_karyawan = $karyawan['id'];
        ?>
          <tr>
            <td class="text-center"><?= $no++; ?></td>
            <td><?= $karyawan['nama']; ?></td>

            <?php for ($d = 1; $d <= $jumlah_hari; $d++): ?>
              <?php
              if (isset($list_shift[$id_karyawan][$d])) {
                $data_shift = $list_shift[$id_karyawan][$d];
                $jenis = $data_shift['jenis_shift'];
                $jam = $data_shift['jam_kerja'];

                if ($jenis == 'Libur') {
                  $bg_class = 'bg-danger text-white';
                  $konten = 'Libur';
                  $ket = 'O';
                } elseif ($jenis == 'Lembur') {
                  $bg_class = 'bg-primary text-white';
                  $ket = 'L';
                  $konten = $jam;
                } else {
                  $bg_class = 'bg-white text-black';
                  if($jenis == 'Shift 1'){
                    $ket = 'P';
                  }else{
                    $ket = 'S';
                  }
                  $konten = $jam;
                }
              } else {
                $bg_class = '';
                $konten = '-';
                $ket = '';
              }
              ?>

              <td class="text-center <?= $bg_class ?>" style="white-space: nowrap; vertical-align: middle;">
                <span class="d-block"><?= $ket ?></span>
              </td>

            <?php endfor; ?>

          </tr>
        <?php } ?>
      </tbody>
    </table>


    <h2 style="text-align: left; font-size:12px;">Keterangan:
    </h2>
    <p style="font-size: 12px; margin: 0px; margin-bottom: 5px;">P : Pagi / Shift 1</p>
    <p style="font-size: 12px; margin: 0px; margin-bottom: 5px;">S : Siang / Shift 2</p>
    <p style="font-size: 12px; margin: 0px; margin-bottom: 5px;">L : Lembur</p>
    <p style="font-size: 12px; margin: 0px; margin-bottom: 5px;">O : Off / Libur</p>

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