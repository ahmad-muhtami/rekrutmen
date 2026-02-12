<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM pertanyaan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: pertanyaan.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: pertanyaan.php?page=tampil");
    exit;
}
?>
<div class="container-fluid bg-white h-100 pt-4">

    <h1 class="h3 mb-4 text-gray-800">Ubah Data Pertanyaan</h1>

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
                <form action="pertanyaan.php?page=proses_ubah" method="post">
                    

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Lowongan Pekerjaan</label>
                                <select class="form-control" name="lowongan_id">
                                    <option value="">Pilih Lowongan Pekerjaan</option>
                                    <?php
                                    include_once '../config/koneksi.php';
                                    $queryLowongan = "SELECT * FROM lowongan_kerja ORDER BY id DESC";
                                    $resultLowongan = mysqli_query($koneksi, $queryLowongan);
                                    while ($lowongan = mysqli_fetch_assoc($resultLowongan)) {
                                        $selected = ($row['lowongan_id'] == $lowongan['id']) ? 'selected' : '';
                                    ?>
                                        <option value='<?= $lowongan['id']; ?>' <?= $selected; ?>><?= $lowongan['judul'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pertanyaan">Pertanyaan</label>
                                <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3"><?= $row['pertanyaan'] ?></textarea>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button name="update" value="update" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>