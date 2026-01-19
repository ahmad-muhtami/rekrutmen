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
    <h2 style="text-align: center; font-size:16px;">Laporan Rekrutmen & Seleksi Karyawan
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

    <table class="table bordered" style="font-size: 9px;">
      <colgroup>
       <col style="width: 5%" class="angka">
        <col style="width: 15%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">
        <col style="width: 10%" class="angka">


      </colgroup>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pelamar</th>
          <th>Usia</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Nomor Telepon</th>
          <th>Jabatan</th>
          <th>Jenis Pekerjaan</th>
          <th>Tanggal Lamar</th>
          <th>Status Seleksi</th>

        </tr>
      </thead>
      <tbody>
        <?php
        include_once '../config/koneksi.php';
        $no = 1;
        $query = "
              SELECT 
                  rekrutmen.*,
                  pengguna.nama AS nama_pelamar,
                  pengguna.nomor_telepon AS nomor_telepon,
                  lowongan_kerja.judul AS judul_lowongan,
                  bidang_pekerjaan.bidang_pekerjaan AS jabatan,
                  bidang_pekerjaan.jenis_pekerjaan AS jenis
              FROM rekrutmen
              JOIN pengguna 
                  ON rekrutmen.pelamar_id = pengguna.id
              JOIN lowongan_kerja 
                  ON rekrutmen.lowongan_id = lowongan_kerja.id
              JOIN bidang_pekerjaan 
                  ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id
                  WHERE MONTH(rekrutmen.tanggal) = '$bulan' AND YEAR(rekrutmen.tanggal) = '$tahun'
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
                <td><?= $no++; ?></td>
                <td class="text-capitalize"><?= $row['nama_pelamar']; ?></td>
                <td><?= $row['usia']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['alamat_domisili']; ?></td>
                <td><?= $row['nomor_telepon']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['jenis']; ?></td>
                <td><?= format_date($row['tanggal']) ?></td>
                <td class="text-capitalize"><?= $row['status']; ?></td>

              </tr>
        <?php } ?>
      </tbody>
    </table>



    <br>
    <br>
    <br>

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
          <br><br><br><br>
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
  $html2pdf->output('example05.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}
?>