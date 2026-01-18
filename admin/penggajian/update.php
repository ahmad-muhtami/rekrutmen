<?php
// --- 0. FUNGSI BANTUAN ---
function periode_indo($date_str)
{
    if (empty($date_str)) return '-';
    $bulan_array = [
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
    $ts = strtotime($date_str);
    $bln = (int)date('m', $ts);
    $thn = date('Y', $ts);
    return $bulan_array[$bln] . ' ' . $thn;
}

if (isset($_POST['action'])) {
    error_reporting(0);
    if (ob_get_length()) ob_clean();
    header('Content-Type: application/json');

    $response = ['status' => 'error', 'message' => 'Unknown action'];

    if ($_POST['action'] == 'tambah_insentif_ajax') {
        $id_gaji    = $_POST['id_gaji'];
        $tanggal    = $_POST['tgl_insentif'];
        $keterangan = $_POST['ket_insentif'];
        $nominal    = $_POST['nominal_insentif'];

        if (!empty($tanggal) && !empty($nominal)) {
            $insert = mysqli_query($koneksi, "INSERT INTO insentif (penggajihan_id, tanggal, total, keterangan) 
                                              VALUES ('$id_gaji', '$tanggal', '$nominal', '$keterangan')");
            if ($insert) {
                $new_id = mysqli_insert_id($koneksi);
                $response = ['status' => 'success', 'type' => 'add', 'id' => $new_id];
            } else {
                $response = ['status' => 'error', 'message' => mysqli_error($koneksi)];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Data tidak lengkap'];
        }
    }

    // --- LOGIKA HAPUS INSENTIF ---
    if ($_POST['action'] == 'hapus_insentif_ajax') {
        $id_insentif = $_POST['id_insentif'];
        $id_gaji     = $_POST['id_gaji'];

        $delete = mysqli_query($koneksi, "DELETE FROM insentif WHERE id = '$id_insentif'");
        if ($delete) {
            $response = ['status' => 'success', 'type' => 'delete'];
        } else {
            $response = ['status' => 'error', 'message' => mysqli_error($koneksi)];
        }
    }

    // --- HITUNG ULANG TOTAL (SHARED LOGIC) ---
    if ($response['status'] == 'success') {
        // 1. Hitung Total Insentif Baru
        $q_sum = mysqli_query($koneksi, "SELECT SUM(total) as total FROM insentif WHERE penggajihan_id = '$id_gaji'");
        $d_sum = mysqli_fetch_assoc($q_sum);
        $total_insentif_baru = $d_sum['total'] ?? 0;

        // 2. Ambil Gaji Pokok & Tunjangan saat ini
        $q_main = mysqli_query($koneksi, "SELECT total_gaji_pokok, tunjangan FROM penggajihan WHERE id = '$id_gaji'");
        $d_main = mysqli_fetch_assoc($q_main);

        $gaji_pokok = floatval($d_main['total_gaji_pokok']);
        $tunjangan  = floatval($d_main['tunjangan']);
        $total_gaji_baru = $gaji_pokok + $tunjangan + $total_insentif_baru;

        // 3. Update Database Utama
        mysqli_query($koneksi, "UPDATE penggajihan SET total_insentif = '$total_insentif_baru', total_gaji = '$total_gaji_baru' WHERE id = '$id_gaji'");

        // 4. Masukkan data angka ke response JSON
        $response['totals'] = [
            'insentif_rp' => number_format($total_insentif_baru, 0, ',', '.'),
            'gaji_rp' => number_format($total_gaji_baru, 0, ',', '.')
        ];

        // Jika aksi tambah, kirim balik data row untuk ditampilkan
        if ($_POST['action'] == 'tambah_insentif_ajax') {
            $response['data'] = [
                'tanggal_fmt' => date('d/m/Y', strtotime($_POST['tgl_insentif'])),
                'keterangan'  => $_POST['ket_insentif'],
                'nominal_rp'  => number_format($_POST['nominal_insentif'], 0, ',', '.')
            ];
        }
    }

    echo json_encode($response);
    exit;
}

if (isset($_POST['simpan_perubahan'])) {
    $id_gaji     = $_POST['id_gaji'];
    $gaji_pokok  = $_POST['gaji_pokok'];
    $tunjangan   = $_POST['tunjangan'];

    // Ambil Total Insentif (Tidak berubah, tapi perlu diambil untuk penjumlahan)
    $q_ins = mysqli_query($koneksi, "SELECT total_insentif FROM penggajihan WHERE id = '$id_gaji'");
    $d_ins = mysqli_fetch_assoc($q_ins);
    $total_insentif = $d_ins['total_insentif'];

    $total_gaji = $gaji_pokok + $tunjangan + $total_insentif;

    $query_update = "UPDATE penggajihan SET 
                     total_gaji_pokok = '$gaji_pokok',
                     tunjangan = '$tunjangan',
                     total_gaji = '$total_gaji'
                     WHERE id = '$id_gaji'";

    if (mysqli_query($koneksi, $query_update)) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data penggajian berhasil diperbarui!';
        echo "<script>window.location='penggajian.php';</script>";
        exit;
    }
}

$id_gaji = $_GET['id'];
$query_data = "SELECT penggajihan.*, pengguna.nama, bidang_pekerjaan.bidang_pekerjaan AS jabatan 
               FROM penggajihan 
               JOIN karyawan ON penggajihan.karyawan_id = karyawan.id 
  JOIN pengguna ON karyawan.pengguna_id = pengguna.id
  JOIN bidang_pekerjaan ON karyawan.bidang_pekerjaan_id = bidang_pekerjaan.id
               WHERE penggajihan.id = '$id_gaji'";
$result_data = mysqli_query($koneksi, $query_data);
$row = mysqli_fetch_assoc($result_data);

// Ambil List Insentif
$query_list_insentif = mysqli_query($koneksi, "SELECT * FROM insentif WHERE penggajihan_id = '$id_gaji' ORDER BY tanggal ASC");
?>

<div class="container-fluid bg-white h-100 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Ubah Data Penggajian</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="" method="post" id="form_utama">
                        <input type="hidden" name="id_gaji" id="main_id_gaji" value="<?= $row['id'] ?>">

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?= $row['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Periode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?= periode_indo($row['periode']) ?>" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gaji Pokok (Rp)</label>
                            <div class="col-sm-8">
                                <input type="number" name="gaji_pokok" id="input_gaji_pokok" class="form-control" value="<?= $row['total_gaji_pokok'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tunjangan (Rp)</label>
                            <div class="col-sm-8">
                                <input type="number" name="tunjangan" id="input_tunjangan" class="form-control" value="<?= $row['tunjangan'] ?>" required>
                            </div>
                        </div>

                        <h6 class="text-black font-weight-bold mt-4 mb-3 border-bottom pb-2">Rincian Bonus / Insentif</h6>

                        <div id="container_insentif">
                            <?php
                            if (mysqli_num_rows($query_list_insentif) > 0) {
                                while ($ins = mysqli_fetch_assoc($query_list_insentif)) {
                                    $tgl_fmt = date('d/m/Y', strtotime($ins['tanggal']));
                                    $nom_fmt = number_format($ins['total'], 0, ',', '.');
                            ?>
                                    <div class="form-group row align-items-center item-insentif" id="row_ins_<?= $ins['id'] ?>">
                                        <div class="col-4">
                                            <label class="col-form-label">Tanggal</label>
                                            <div class="">
                                                <input type="text" class="form-control" value="<?= $tgl_fmt ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label">Keterangan</label>
                                            <div class="">
                                                <input type="text" class="form-control" value="<?= $ins['keterangan'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label">Nominal</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" value="Rp. <?= $nom_fmt ?>" readonly>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus ml-2 px-3" onclick="hapusInsentif(<?= $ins['id'] ?>)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                            <?php
                                }
                            } else {
                                echo '<p class="text-muted text-center font-italic" id="no_data_msg">Belum ada data insentif.</p>';
                            }
                            ?>
                        </div>

                        <div class="p-3 bg-light rounded mt-3">
                            <label class="font-weight-bold small mb-2">Tambahkan Bonus/Insentif:</label>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label class="col-form-label">Tanggal</label>

                                    <input type="date" id="new_tgl" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="col-form-label">Keterangan</label>

                                    <input type="text" id="new_ket" class="form-control form-control-sm" placeholder="Keterangan (Cth: Lembur)">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="col-form-label">Nominal</label>

                                    <input type="number" id="new_nom" class="form-control form-control-sm" placeholder="Nominal (Rp)">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="col-form-label text-light">+</label>

                                    <button type="button" id="btn_tambah" class="btn btn-sm btn-success btn-block" onclick="tambahInsentif()">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4">

                        <div class="form-group row">
                            <div class="col-6 mb-2">
                                <label class="col-form-label">Total Bonus / Insentif</label>
                                <input type="text" id="display_total_insentif" class="form-control font-weight-bold" value="Rp <?= number_format($row['total_insentif'], 0, ',', '.') ?>" readonly>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="col-form-label">Total Gaji</label>
                                <input type="text" id="display_total_insentif" class="form-control font-weight-bold" value="Rp <?= number_format($row['total_gaji'], 0, ',', '.') ?>" readonly>
                            </div>
                        </div>


                        <div class="mt-4">
                            <button type="submit" name="simpan_perubahan" class="btn btn-primary btn-block">Simpan Data Gaji</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi Tambah Insentif
    function tambahInsentif() {
        let tgl = document.getElementById('new_tgl').value;
        let ket = document.getElementById('new_ket').value;
        let nom = document.getElementById('new_nom').value;
        let id_gaji = document.getElementById('main_id_gaji').value;
        let btn = document.getElementById('btn_tambah');

        if (ket === '' || nom === '') {
            alert('Keterangan dan Nominal harus diisi');
            return;
        }

        // Loading State
        let originalText = btn.innerHTML;
        btn.innerHTML = '...';
        btn.disabled = true;

        let formData = new FormData();
        formData.append('action', 'tambah_insentif_ajax');
        formData.append('id_gaji', id_gaji);
        formData.append('tgl_insentif', tgl);
        formData.append('ket_insentif', ket);
        formData.append('nominal_insentif', nom);

        fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let noData = document.getElementById('no_data_msg');
                    if (noData) noData.remove();

                    let container = document.getElementById('container_insentif');
                    let newItem = `
                    <div class="form-group row align-items-center item-insentif" id="row_ins_${data.data.id}">
                                        <div class="col-4">
                                            <label class="col-form-label">Tanggal</label>
                                            <div class="">
                                                <input type="text" class="form-control" value="${data.data.tanggal_fmt}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label">Keterangan</label>
                                            <div class="">
                                                <input type="text" class="form-control" value="${data.data.keterangan}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label">Nominal</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" value="Rp. ${data.data.nominal_rp}" readonly>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus ml-2 px-3" onclick="hapusInsentif(${data.data.id})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                
            `;
                    container.insertAdjacentHTML('beforeend', newItem);

                    updateTotals(data.totals);

                    document.getElementById('new_ket').value = '';
                    document.getElementById('new_nom').value = '';
                } else {
                    // alert('Error: ' + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                // alert('Gagal memproses data.');
            })
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }

    function hapusInsentif(id_insentif) {
        if (!confirm('Hapus item bonus ini?')) return;

        let id_gaji = document.getElementById('main_id_gaji').value;
        let formData = new FormData();
        formData.append('action', 'hapus_insentif_ajax');
        formData.append('id_insentif', id_insentif);
        formData.append('id_gaji', id_gaji);

        fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let row = document.getElementById('row_ins_' + id_insentif);
                    if (row) row.remove();

                    updateTotals(data.totals);
                } else {
                    // alert('Error: ' + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                // alert('Gagal menghapus data.');
            });
    }

    function updateTotals(totals) {
        document.getElementById('display_total_insentif').value = "Rp " + totals.insentif_rp;
        document.getElementById('display_total_gaji').value = "Rp " + totals.gaji_rp;
    }
</script>