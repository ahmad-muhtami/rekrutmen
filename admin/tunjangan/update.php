<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tunjangan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: tunjangan.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: tunjangan.php?page=tampil");
    exit;
}
?>
<div class="container-fluid bg-white h-100 pt-4">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Tunjangan</h1>

    <div class="card card-body">
        <form action="tunjangan.php?page=proses_ubah" method="post">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">
    <div class="row">

        <div class="col-12">
            <div class="form-group">
                <label>Jenis Tunjangan</label>
                <input 
                    type="text" 
                    name="jenis_tunjangan" 
                    class="form-control" 
                    id="jenis_tunjangan" 
                    value="<?= $row['jenis_tunjangan']; ?>"
                >
            </div>
        </div>

       
             <div class="col-12">
               <div class="form-group">
                 <label>Nominal</label>
                 <input type="number" name="nominal" class="form-control " id="nominal" value="<?= $row['nominal'] ?>" placeholder="Nominal Tunjangan..">
               </div>
             </div>


    </div>

    <button name="ubah" value="ubah" class="btn btn-primary">Simpan</button>
</form>

    </div>
</div>