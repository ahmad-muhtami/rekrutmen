<?php
ini_set('date.timezone', 'Asia/Makassar');

$id_karyawan = $_GET['id'];
$bulan_ini = date('m');
$tahun_ini = date('Y');
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);

$q_emp = mysqli_query($koneksi, "SELECT karyawan.*, pengguna.nama
FROM karyawan 
JOIN pengguna on karyawan.pengguna_id = pengguna.id
WHERE karyawan.id = '$id_karyawan'");
$d_emp = mysqli_fetch_assoc($q_emp);

if (isset($_POST['simpan_jadwal'])) {
    $post_jenis = $_POST['jenis_shift'];
    $post_jam   = $_POST['jam_kerja'];

    for ($d = 1; $d <= $jumlah_hari; $d++) {
        $tgl_db = "$tahun_ini-$bulan_ini-" . sprintf("%02d", $d);

        $jenis  = $post_jenis[$d];
        $jam    = $post_jam[$d];

        $cek = mysqli_query($koneksi, "SELECT id FROM shift WHERE karyawan_id = '$id_karyawan' AND tanggal = '$tgl_db'");

        if (mysqli_num_rows($cek) > 0) {
            $query_update = "UPDATE shift SET 
                             jenis_shift = '$jenis', 
                             jam_kerja = '$jam' 
                             WHERE karyawan_id = '$id_karyawan' AND tanggal = '$tgl_db'";
            mysqli_query($koneksi, $query_update);
        } else {
            if (!empty($jenis)) {
                $query_insert = "INSERT INTO shift (karyawan_id, tanggal, jenis_shift, jam_kerja) 
                                 VALUES ('$id_karyawan', '$tgl_db', '$jenis', '$jam')";
                mysqli_query($koneksi, $query_insert);
            }
        }
    }

    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Jadwal berhasil diperbarui!';
    echo "<script>window.location='jadwal.php';</script>";
}

$existing_shifts = [];
$q_shift = mysqli_query($koneksi, "SELECT * FROM shift WHERE karyawan_id = '$id_karyawan' AND MONTH(tanggal) = '$bulan_ini' AND YEAR(tanggal) = '$tahun_ini'");
while ($row = mysqli_fetch_assoc($q_shift)) {

    $tgl_angka = (int)date('j', strtotime($row['tanggal']));
    $existing_shifts[$tgl_angka] = $row;
}
?>

<div class="container-fluid bg-white p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="text-gray-800">Ubah Data Jadwal</h4>
    </div>

    <form method="post" action="">

        <div class="table-responsive">
            <table class="table table-sm">
                <thead class="">

                </thead>
                <tbody>
                    <?php
                    $bulan = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember'
                    ];
                    for ($i = 1; $i <= $jumlah_hari; $i++):
                        $val_jenis = isset($existing_shifts[$i]) ? $existing_shifts[$i]['jenis_shift'] : 'Shift 1';
                        $val_jam   = isset($existing_shifts[$i]) ? $existing_shifts[$i]['jam_kerja'] : '07.00 - 15.00';

                       $tanggal_tampil = "$i " . $bulan[(int)$bulan_ini] . " $tahun_ini";
                    ?>
                        <tr>
                            <td style="vertical-align: middle; font-weight: bold;">
                                <?= $tanggal_tampil ?>
                            </td>
                            <td>
                                <select name="jenis_shift[<?= $i ?>]" class="form-control form-control-sm jenis-select" data-id="<?= $i ?>">
                                    <option value="Shift 1" <?= $val_jenis == 'Shift 1' ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="Shift 2" <?= $val_jenis == 'Shift 2' ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="Lembur" <?= $val_jenis == 'Lembur' ? 'selected' : '' ?>>Lembur</option>
                                    <option value="Libur" <?= $val_jenis == 'Libur' ? 'selected' : '' ?>>Libur</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="jam_kerja[<?= $i ?>]" id="jam_<?= $i ?>" class="form-control form-control-sm" value="<?= $val_jam ?>">
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <button type="submit" name="simpan_jadwal" class="btn btn-primary btn-block">
                Simpan
            </button>
        </div>

    </form>
</div>

<script>
    document.querySelectorAll('.jenis-select').forEach(item => {
        item.addEventListener('change', event => {
            const id = event.target.getAttribute('data-id');
            const value = event.target.value;
            const inputJam = document.getElementById('jam_' + id);

            if (value === 'Shift 1') {
                inputJam.value = '08.00 - 15.30';
            } else if (value === 'Shift 2') {
                inputJam.value = '14.30 - 23.00';
            } else if (value === 'Libur') {
                inputJam.value = '-';
            } else if (value === 'Lembur') {
                inputJam.value = '08.00 - 23.00';
            }
        })
    })
</script>