<ul class="navbar-nav sidebar sidebar-dark bg-dark accordion" style="border-right: 1px solid #d3d3d3;" id="accordionSidebar">

  <div class="position-relative ">
    <div class="position-absolute bg-dark" style="top: 0; left:0; right:0; bottom:0; z-index:10;">

    </div>
    <a class="sidebar-brand d-flex align-items-center position-relative border-bottom border-secondary shadow-lg" style="z-index: 11;">
      <div class="sidebar-brand-icon">
        <td>
          <img src="../assets/img/hatara.jpg" height="40" alt="" class="gambar rounded-circle" style="border: 3px solid white;">
        </td>
      </div>
      <div class="sidebar-brand-text mx-3 text-capitalize" style="font-weight: 500; font-size: 20px;">Hatara </div>

    </a>
    <div class="position-absolute text-center d-none d-md-inline" id="sidebarToggle" style="top: 20px; right: -60px; z-index: 50;">
      <button class="rounded-circle border-0 bg-white" style="outline: none; font-size: 18px;">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <div class="sidebar-brand d-flex align-items-center position-relative" style="z-index: 11;">
      <div class="sidebar-brand-text mr-3">
        <td>
          <img src="../assets/img/profile.svg" height="40" alt="" class="gambar rounded-circle" style="border: 3px solid white;">
        </td>
      </div>
      <div class="text-capitalize sidebar-brand-text font-weight-normal" style="font-size: 14px; ">@<?= $_SESSION['username'] ?> </div>

    </div>


  </div>


  <div class="sidebar-heading font-weight-normal text-white mt-2">
    Menu
  </div>

  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fa fa-home"></i>
      <span>Beranda</span>
    </a>

  </li>
        <?php if ($_SESSION['role'] == 'admin') : ?>

  <li class="nav-item">
    <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-database"></i>
      <span>Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="users.php">Data Pengguna</a>
          <a class="collapse-item" href="tunjangan.php">Data Tunjangan</a>
          <a class="collapse-item" href="karyawan.php">Data Karyawan</a>
          <a class="collapse-item" href="jadwal.php">Jadwal / Shift</a>
          <a class="collapse-item" href="bidang-pekerjaan.php">Bidang Pekerjaan</a>
          <a class="collapse-item" href="lowongan.php">Lowongan Kerja</a>
          <a class="collapse-item" href="pertanyaan.php">Pertanyaan</a>


      </div>
    </div>
  </li>
        <?php endif; ?>



  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-cart-arrow-down"></i>
      <span>Transaksi</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <?php if ($_SESSION['role'] == 'admin') : ?>
          <a class="collapse-item" href="rekrutmen.php">Rekrutmen & Seleksi</a>
          <a class="collapse-item" href="absensi.php">Absensi</a>
          <a class="collapse-item" href="penggajian.php">Penggajian</a>
        <?php else: ?>
          <a class="collapse-item" href="rekrutmen.php?page=lamar">Rekrutmen & Seleksi</a>
          <a class="collapse-item" href="jadwal.php">Jadwal / Shift</a>
          <a class="collapse-item" href="absensi.php">Absensi</a>
          <a class="collapse-item" href="penggajian.php">Penggajian</a>
        <?php endif; ?>
      </div>
    </div>
  </li>
  <?php if ($_SESSION['role'] == 'admin') : ?>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
        <i class="fas fa-file"></i>
        <span>Laporan</span>
      </a>
      <div id="laporan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

          <a class="collapse-item" href="laporan-penerimaan-kerja.php">Penerimaan Kerja</a>
          <a class="collapse-item" href="laporan-data-pelamar.php">Data Pelamar</a>
          <a class="collapse-item" href="laporan-rekrutmen.php">Rekrutmen & Seleksi</a>
          <a class="collapse-item" href="laporan-kinerja-rekrutmen.php">Kinerja Rekrutmen</a>
          <a class="collapse-item" href="laporan-data-karyawan.php">Data Karyawan</a>
          <a class="collapse-item" href="laporan-penjadwalan-kerja.php">Penjadwalan Kerja</a>
          <a class="collapse-item" href="laporan-absensi.php">Absensi</a>
          <a class="collapse-item" href="laporan-penggajian.php">Penggajian</a>
          <a class="collapse-item" href="laporan-penghargaan-karyawan.php">Penghargaan Karyawan</a>


        </div>
      </div>
    </li>
  <?php endif; ?>

  <?php if ($_SESSION['role'] != 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link" href="profil.php?page=update">
        <i class="fa fa-user"></i>
        <span>Pengaturan Profil</span>
      </a>

    </li>
  <?php endif; ?>
  <li class="nav-item">
    <a class="nav-link" href="../config/logout.php">
      <i class="fas fa-sign-out-alt"></i>
      <span>Keluar</span>
    </a>

  </li>



</ul>