<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Bidang Pekerjaan</h1>
    <a href="bidang-pekerjaan.php?page=tambah" class="btn btn-dark">Tambah</a>

  </div>

  <div class="card card-body border-0 p-0 mt-2">
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
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th style="width: 50px;">No</th>
              <th>Bidang Pekerjaan</th>
              <th>Jenis Pekerjaan</th>
              <th>Jobdesk</th>
              <th>Gaji Pokok</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "SELECT * FROM bidang_pekerjaan";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['bidang_pekerjaan']; ?></td>
                <td><?= $row['jenis_pekerjaan']; ?></td>
                <td><?= $row['jobdesk']; ?></td>
                <td>Rp. <?= number_format($row['gaji_pokok'],0,0) ?></td>
                

                <td class="not-export-col">
                  <a href="bidang-pekerjaan.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="bidang-pekerjaan.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>