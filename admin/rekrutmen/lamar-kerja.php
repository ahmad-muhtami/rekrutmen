<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT lowongan_kerja.*, bidang_pekerjaan.bidang_pekerjaan AS bidang_pekerjaan
    FROM lowongan_kerja
    JOIN bidang_pekerjaan ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id
    WHERE lowongan_kerja.id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: rekrutmen.php?page=lamar");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: rekrutmen.php?page=lamar");
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

    <h1 class="h3 mb-4 text-gray-800">Tambah Data Rekrutmen</h1>

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
                <form action="rekrutmen.php?page=proses-lamar" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control " id="nama_lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Posisi/Jabatan</label>
                                <input type="text" name="jabatan" class="form-control " id="jabatan" value="<?= $row['bidang_pekerjaan'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nomor Induk Kependudukan (NIK)</label>
                                <input type="number" name="no_ktp" class="form-control " id="no_ktp" placeholder="NIK">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control " id="tempat_lahir">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control " id="tanggal_lahir">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Usia</label>
                                <input type="number" min="0" name="usia" class="form-control " id="usia">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value='Laki-laki'>Laki-laki</option>
                                    <option value='Perempuan'>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" name="agama" class="form-control " id="agama">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control " id="alamat">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control " id="email">
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="mr-2">
                                <div class="form-group">
                                    <label for="cv" class="btn btn-light border-dark"><i class="fa fa-upload"></i> Upload CV</label>
                                    <input type="file" name="cv" class="d-none" id="cv">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="lampiran" class="btn btn-light border-dark"><i class="fa fa-upload"></i> Upload Berkas</label>
                                    <input type="file" name="lampiran[]" class="d-none" id="lampiran" multiple>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
<ul id="cv-list" class="mt-2 text-primary"></ul>
<ul id="lampiran-list" class="mt-2 text-primary"></ul>

                        </div>
                    </div>

                    <input type="hidden" name="lowongan_id" value="<?= $row['id']; ?>">

                    <button name="proses" value="proses" class="btn btn-dark d-block w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('cv').addEventListener('change', function() {
    let list = document.getElementById('cv-list');
    list.innerHTML = "";

    if (this.files.length > 0) {
        let li = document.createElement('li');
        li.textContent = this.files[0].name;
        list.appendChild(li);
    }
});

document.getElementById('lampiran').addEventListener('change', function() {
    let list = document.getElementById('lampiran-list');
    list.innerHTML = "";

    for (let i = 0; i < this.files.length; i++) {
        let li = document.createElement('li');
        li.textContent = this.files[i].name;
        list.appendChild(li);
    }
});
</script>