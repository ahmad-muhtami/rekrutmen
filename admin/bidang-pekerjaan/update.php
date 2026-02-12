<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM bidang_pekerjaan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: bidang-pekerjaan.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: bidang-pekerjaan.php?page=tampil");
    exit;
}
?>
<div class="container-fluid bg-white h-100 pt-4">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Bidang Pekerjaan</h1>

    <div class="card card-body">
        <form action="bidang-pekerjaan.php?page=proses_ubah" method="post">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label>Bidang Pekerjaan</label>
                <input 
                    type="text" 
                    name="bidang_pekerjaan" 
                    class="form-control" 
                    id="bidang_pekerjaan" 
                    value="<?= $row['bidang_pekerjaan']; ?>"
                >
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <select class="form-control" name="jenis_pekerjaan">
                    <option value="Full Time" <?= ($row['jenis_pekerjaan'] == 'Full Time') ? 'selected' : ''; ?>>
                        Full Time
                    </option>
                    <option value="Part Time" <?= ($row['jenis_pekerjaan'] == 'Part Time') ? 'selected' : ''; ?>>
                        Part Time
                    </option>
                    <option value="Magang" <?= ($row['jenis_pekerjaan'] == 'Magang') ? 'selected' : ''; ?>>
                        Magang
                    </option>
                </select>
            </div>
        </div>

        <div class="col-12">
               <div class="form-group">
                 <label>Jobdesk</label>
                 <textarea name="jobdesk" class="form-control" id="jobdesk"><?= $row['jobdesk'] ?></textarea>
                 
               </div>
             </div>

             <div class="col-12">
               <div class="form-group">
                 <label>Gaji Pokok</label>
                 <input type="number" name="gaji_pokok" class="form-control " id="gaji_pokok" value="<?= $row['gaji_pokok'] ?>" placeholder="Gaji Pokok..">
               </div>
             </div>


    </div>

    <button name="ubah" value="ubah" class="btn btn-primary">Simpan</button>
</form>

    </div>
</div>