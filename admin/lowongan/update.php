<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT lowongan_kerja.*, bidang_pekerjaan.gaji_pokok, bidang_pekerjaan.jobdesk
    FROM lowongan_kerja
    JOIN bidang_pekerjaan ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id
    WHERE lowongan_kerja.id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: lowongan.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: lowongan.php?page=tampil");
    exit;
}
?>
<div class="container-fluid bg-white h-100 pt-4">

    <h1 class="h3 mb-4 text-gray-800">Ubah Data Lowongan Pekerjaan</h1>

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
                <form action="lowongan.php?page=proses_ubah" method="post">


                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control " id="judul" value="<?= $row['judul'] ?>" placeholder="Judul">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Bidang Pekerjaan</label>
                                <select class="form-control" name="bidang_pekerjaan_id" id="bidang_pekerjaan">
                                    <option value="">Pilih</option>
                                    <?php
                                    $qBP = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
                                    $rBP = mysqli_query($koneksi, $qBP);
                                    while ($bp = mysqli_fetch_assoc($rBP)) {
                                        $selected = ($bp['id'] == $row['bidang_pekerjaan_id']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $bp['id']; ?>" data-gaji="<?= $bp['gaji_pokok']; ?>" data-jobdesk="<?= $bp['jobdesk']; ?>" <?= $selected; ?>>
                                            <?= $bp['bidang_pekerjaan']; ?> - <?= $bp['jenis_pekerjaan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Lowongan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $row['deskripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobdesk">Jobdeks</label>
                                <textarea class="form-control" id="jobdesk" name="jobdesk" rows="3"><?= $row['jobdesk'] ?></textarea>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Buka</label>
                                <input type="date" name="tanggal_buka" class="form-control " id="tanggal_buka" value="<?= $row['tanggal_buka'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Berakhir</label>
                                <input type="date" name="tanggal_berakhir" class="form-control " id="tanggal_berakhir" value="<?= $row['tanggal_berakhir'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text"
                                    name="gaji_pokok"
                                    class="form-control"
                                    id="gaji_pokok"
                                    value="<?= 'Rp. ' . number_format($row['gaji_pokok'], 0, ',', '.'); ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Persyaratan</label>
                                <input type="text" name="persyaratan" class="form-control " id="persyaratan" placeholder="Persyaratan" value="<?= $row['persyaratan'] ?>">
                            </div>
                        </div>





                    </div>

                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button name="update" value="update" class="btn btn-dark">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('bidang_pekerjaan').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const gaji = option.getAttribute('data-gaji');
        const jobdesk = option.getAttribute('data-jobdesk');
        document.getElementById('gaji_pokok').value = gaji ?
            'Rp. ' + Number(gaji).toLocaleString('id-ID') :
            '';
        document.getElementById('jobdesk').value = jobdesk ?
            jobdesk :
            '';
    });
</script>