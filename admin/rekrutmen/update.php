<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT 
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
    WHERE rekrutmen.id = '$id'
ORDER BY rekrutmen.id DESC
    ";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: rekrutmen.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: rekrutmen.php?page=tampil");
    exit;
}

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
?>
<div class="container-fluid bg-white h-100 pt-4">

    <h1 class="h3 mb-4 text-gray-800">Proses Rekrutmen</h1>

    <div class="card card-body">
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
                <form action="rekrutmen.php?page=proses_ubah" method="post">

                    <div class="row border-bottom pb-3">
                        <div class="col-12 pt-3 mb-3">
                            <h1 class="h5 mb-3">Informasi Pribadi</h1>


                        </div>
                        <div class="col-4">
                            <p><strong>Nama Pelamar :</strong> <span class="d-block"><?= $row['nama_pelamar']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Posisi/Jabatan :</strong> <span class="d-block"><?= $row['judul_lowongan']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Tanggal Lamar :</strong> <span class="d-block"><?= format_date($row['tanggal']); ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Email :</strong> <span class="d-block"><?= $row['email']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>No. Telepon :</strong> <span class="d-block"><?= $row['nomor_telepon']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>NIK :</strong> <span class="d-block"><?= $row['no_ktp']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Tempat Lahir :</strong> <span class="d-block"><?= $row['tempat_lahir']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Tanggal Lahir :</strong> <span class="d-block"><?= format_date($row['tanggal_lahir']); ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Usia :</strong> <span class="d-block"><?= date_diff(date_create($row['tanggal_lahir']), date_create('today'))->y; ?> Tahun</span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Agama :</strong> <span class="d-block"><?= $row['agama']; ?></span></p>

                        </div>
                        <div class="col-4">
                            <p><strong>Alamat Domisili :</strong> <span class="d-block"><?= $row['alamat_domisili']; ?></span></p>

                        </div>
                    </div>

                    <div class="row">


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
                            <a href="./uploads/<?= $row['cv']; ?>" class="px-4 py-2 bg-light rounded-lg border d-inline-block" target="_blank"><?= $row['cv']; ?></a>

                            <?php
                            $queryLampiran = "SELECT * FROM lampiran WHERE rekrutmen_id = " . $row['id'] . " AND pelamar_id = " . $row['pelamar_id'];
                            $lampiran_result = mysqli_query($koneksi, $queryLampiran);
                            ?>
                            <?php while ($lampiran = mysqli_fetch_assoc($lampiran_result)) { ?>
                                <a href="./uploads/<?= $lampiran['lampiran']; ?>" class="px-4 py-2 bg-light rounded-lg border d-inline-block" target="_blank"><?= $lampiran['lampiran']; ?></a>
                            <?php } ?>
                        </div>

                    </div>

                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <input type="hidden" name="pelamar_id" value="<?= $row['pelamar_id']; ?>">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Pilih</option>
                                    <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                    <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="diterima" <?= $row['status'] == 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                                    <option value="ditolak" <?= $row['status'] == 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3" required><?= $row['catatan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button name="update" value="update" class="btn btn-dark mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>