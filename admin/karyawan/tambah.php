 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <div class="container-fluid bg-white h-100 pt-4">

   <h1 class="h3 mb-4 text-gray-800">Data Karyawan</h1>

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
         <form action="karyawan.php?page=proses" method="post">
           <div class="row">
             <div class="col-6">
               <div class="form-group">
                 <label>Pilih Nama</label>
                 <select class="form-control" name="pengguna_id" id="pengguna_id" required>
                   <option value="">Pilih</option>
                   <?php
                    $qPengguna = "
        SELECT p.*
        FROM pengguna p
        LEFT JOIN karyawan k ON k.pengguna_id = p.id
        WHERE k.pengguna_id IS NULL
        ORDER BY p.id DESC
      ";
                    $rPengguna = mysqli_query($koneksi, $qPengguna);

                    while ($pengguna = mysqli_fetch_assoc($rPengguna)) {
                    ?>
                     <option value="<?= $pengguna['id']; ?>">
                       <?= htmlspecialchars($pengguna['nama']); ?>
                     </option>
                   <?php } ?>
                 </select>
               </div>
             </div>

             <div class="col-6">
               <div class="form-group">
                 <label>No. Telepon</label>
                 <input type="text" name="nomor_telepon" class="form-control " id="nomor_telepon" placeholder="Nomor Telepon">
               </div>
             </div>
             <div class="col-6">
               <div class="form-group">
                 <label>Jabatan</label>
                 <select class="form-control" name="bidang_pekerjaan_id" id="bidang_pekerjaan">
                   <option value="">Pilih</option>
                   <?php
                    $queryBidangPekerjaan = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
                    $resultBidangPekerjaan = mysqli_query($koneksi, $queryBidangPekerjaan);
                    while ($bidang_pekerjaan = mysqli_fetch_assoc($resultBidangPekerjaan)) {
                    ?>
                     <option
                       value="<?= $bidang_pekerjaan['id']; ?>"
                       data-gaji="<?= $bidang_pekerjaan['gaji_pokok']; ?>">
                       <?= $bidang_pekerjaan['bidang_pekerjaan']; ?> - <?= $bidang_pekerjaan['jenis_pekerjaan'] ?>
                     </option>
                   <?php } ?>
                 </select>
               </div>
             </div>
             <div class="col-6">
               <div class="form-group">
                 <label>Gaji Pokok</label>
                 <input type="text"
                   name="gaji_pokok"
                   class="form-control"
                   id="gaji_pokok"
                   placeholder="Gaji Pokok"
                   readonly>
               </div>
             </div>


             <div class="col-6">
               <div class="form-group">
                 <label>Tunjangan</label>
                 <select class="form-control" name="tunjangan_id">
                   <option value="">Pilih</option>
                   <?php
                    include_once '../config/koneksi.php';
                    $qtunjangan = "SELECT * FROM tunjangan ORDER BY id DESC";
                    $rtunjangan = mysqli_query($koneksi, $qtunjangan);
                    while ($tunjangan = mysqli_fetch_assoc($rtunjangan)) {
                    ?>
                     <option value='<?= $tunjangan['id']; ?>'><?= $tunjangan['jenis_tunjangan']; ?> - Rp. <?= number_format($tunjangan['nominal'], 0, 0) ?></option>
                   <?php } ?>
                 </select>
               </div>
             </div>

             <div class="col-6">
               <div class="form-group">
                 <label>Status</label>
                 <select class="form-control" name="status" id="status">
                   <option value="aktif">Aktif</option>
                   <option value="tidak aktif">Tidak Aktif</option>
                 </select>
               </div>
             </div>

             <div class="col-6">
               <div class="form-group">
                 <label>Tanggal Bergabung</label>
                 <input type="date"
                   name="tanggal_bergabung"
                   class="form-control"
                   value="<?= date('Y-m-d'); ?>"
                   id="tanggal_bergabung">
               </div>
             </div>





           </div>

           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>



       </div>
     </div>
   </div>

 </div>

 <script>
   document.addEventListener('DOMContentLoaded', function() {
     const bidangSelect = document.getElementById('bidang_pekerjaan');
     const gajiInput = document.getElementById('gaji_pokok');

     bidangSelect.addEventListener('change', function() {
       const selectedOption = this.options[this.selectedIndex];
       const gaji = selectedOption.getAttribute('data-gaji');

       if (gaji) {
         gajiInput.value = formatRupiah(gaji);
       } else {
         gajiInput.value = '';
       }
     });

     function formatRupiah(angka) {
       return 'Rp. ' + Number(angka).toLocaleString('id-ID');
     }
   });
 </script>