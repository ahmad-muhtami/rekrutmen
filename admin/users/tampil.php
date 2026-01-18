<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Pengguna </h1>
    <a href="users.php?page=tambah" class="btn btn-dark">Tambah</a>

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
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>No. Telepon</th>
              <th>Role</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "SELECT * FROM pengguna 
            ORDER BY id DESC";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['username']; ?></td>
                <td>
                  <?php if (!empty($row['nomor_telepon'])) : ?>
                    <?= htmlspecialchars($row['nomor_telepon']); ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>

                </td>
                <td>
                  <?php if (!empty($row['role'])) : ?>
                    <?= htmlspecialchars($row['role']); ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>

                </td>

                <td class="not-export-col">
                  <a href="users.php?page=ubah&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="users.php?page=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>