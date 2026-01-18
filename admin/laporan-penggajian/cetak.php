<?php

/**
 * Html2Pdf Library - Laporan Penggajian
 */
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
  ob_start();
?>

  <?php
  // Logika Penentuan Nama Bulan
  $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
  $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

  switch ($bulan) {
    case '01': $bln = 'Januari'; break;
    case '02': $bln = 'Februari'; break;
    case '03': $bln = 'Maret'; break;
    case '04': $bln = 'April'; break;
    case '05': $bln = 'Mei'; break;
    case '06': $bln = 'Juni'; break;
    case '07': $bln = 'Juli'; break;
    case '08': $bln = 'Agustus'; break;
    case '09': $bln = 'September'; break;
    case '10': $bln = 'Oktober'; break;
    case '11': $bln = 'November'; break;
    case '12': $bln = 'Desember'; break;
    default: $bln = ''; break;
  }

  // Nama Bulan Sekarang untuk Tanda Tangan
  switch (date('m')) {
    case '01': $b = 'Januari'; break;
    case '02': $b = 'Februari'; break;
    case '03': $b = 'Maret'; break;
    case '04': $b = 'April'; break;
    case '05': $b = 'Mei'; break;
    case '06': $b = 'Juni'; break;
    case '07': $b = 'Juli'; break;
    case '08': $b = 'Agustus'; break;
    case '09': $b = 'September'; break;
    case '10': $b = 'Oktober'; break;
    case '11': $b = 'November'; break;
    case '12': $b = 'Desember'; break;
    default: $b = ''; break;
  }
  ?>

  <!DOCTYPE html>
  <html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      .table {
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        padding: 5px; /* Padding diperkecil sedikit agar muat */
        font-size: 9px; /* Font diperkecil sedikit karena kolom bertambah */
        vertical-align: top; /* Agar teks rata atas */
      }

      table.bordered th,
      table.bordered td {
        border: 1px solid black;
      }

      table.bordered th {
        text-align: center;
        background-color: #f0f0f0;
        vertical-align: middle;
      }

      .text-right { text-align: right; }
      .text-center { text-align: center; }
      .text-bold { font-weight: bold; }
      
      /* Style untuk rincian insentif agar lebih rapi */
      .list-item { margin-bottom: 2px; }
    </style>

  </head>

  <body>
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
        <td></td>
      </tr>
    </table>
    <hr>
    <br>

    <h2 style="text-align: center; font-size:16px;">Laporan Penggajian Karyawan</h2>
    <br>

    <table class="table">
      <colgroup>
        <col style="width: 50%">
        <col style="width: 50%">
      </colgroup>
      <tbody>
        <tr>
          <td  style="font-size: 12px;">Dicetak : <?= ucfirst($_SESSION['nama']) ?></td>
          <td style="text-align: right; font-size: 12px;">Periode : <?= $bln . ' ' . $tahun ?></td>
        </tr>
      </tbody>
    </table>
    <br>

    <?php
    include_once '../config/koneksi.php';

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

    <table class="table bordered">
      <colgroup>
        <col style="width: 4%">  <col style="width: 15%"> <col style="width: 10%"> <col style="width: 11%"> <col style="width: 11%"> <col style="width: 16%"> <col style="width: 11%"> <col style="width: 11%"> <col style="width: 11%"> </colgroup>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Karyawan</th>
          <th>Jabatan</th>
          <th>Gaji Pokok</th>
          <th>Tunjangan</th>
          <th>Ket. Insentif</th>
          <th>Rincian<br>Insentif</th>
          
          <th>Total<br>Insentif</th>
          <th>Total<br>Diterima</th>
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
            
            if(mysqli_num_rows($q_ins) > 0) {
                while($ins = mysqli_fetch_assoc($q_ins)){
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
              <td class="text-center"><?= $no++; ?></td>
              <td><?= $row['nama']; ?></td>
              <td class="text-center"><?= $row['jabatan']; ?></td>
              <td class="text-right">Rp <?= number_format($row['total_gaji_pokok'], 0, ',', '.'); ?></td>
              <td class="text-right">Rp <?= number_format($row['tunjangan'], 0, ',', '.'); ?></td>
              
              <td style="font-size: 8px;"><?= $str_ket ?></td>
              <td class="text-left" style="font-size: 8px;"><?= $str_nom ?></td>
              
              <td class="text-right">Rp <?= number_format($row['total_insentif'], 0, ',', '.'); ?></td>
              <td class="text-right text-bold">Rp <?= number_format($row['total_gaji'], 0, ',', '.'); ?></td>
            </tr>
        <?php 
          } 
        } else {
        ?>
            <tr>
                <td colspan="9" class="text-center">Belum ada data penggajian untuk periode ini.</td>
            </tr>
        <?php } ?>
      </tbody>
      
      <?php if (mysqli_num_rows($result_gaji) > 0) { ?>
      <tfoot>
        <tr style="background-color: #e0e0e0;">
            <td colspan="3" class="text-center text-bold">TOTAL PENGELUARAN</td>
            
            <td class="text-right text-bold">Rp <?= number_format($grand_pokok, 0, ',', '.') ?></td>
            
            <td class="text-right text-bold">Rp <?= number_format($grand_tunjangan, 0, ',', '.') ?></td>
            
            <td></td>
            <td></td>
            
            <td class="text-right text-bold">Rp <?= number_format($grand_insentif, 0, ',', '.') ?></td>
            
            <td class="text-right text-bold">Rp <?= number_format($grand_total, 0, ',', '.') ?></td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>

    <br><br><br>

    <table class="table">
      <colgroup>
        <col style="width: 60%">
        <col style="width: 40%">
      </colgroup>
      <tr style="text-align: right;">
        <td></td>
        <td style="font-size: 12px;">Banjarbaru, <?= date('d') . ' ' . $b . ' ' . date('Y')  ?> </td>
      </tr>
      <tr style="text-align: right;">
        <td></td>
        <td>
          <br><br><br><br>
        </td>
      </tr>
      <tr style="text-align: right;">
        <td></td>
        <td style="font-size: 12px;">
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
  $html2pdf->output('Laporan_Penggajian.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();
  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}
?>