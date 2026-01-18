<?php
include '../config/koneksi.php';
$query = "SELECT * FROM pengguna WHERE id = '$_SESSION[id]'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

?>
<div class="container-fluid bg-white h-100 pt-4">

  <h1 class="h3 mb-4 text-gray-800">Pengaturan Profil</h1>

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
        <form action="profil.php?page=proses_ubah" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?= $row['nama']; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Username / Email</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= $row['username']; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" placeholder="Nomor Telepon" value="<?= $row['nomor_telepon']; ?>">
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

