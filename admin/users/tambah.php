 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <div class="container-fluid bg-white h-100 pt-4">

   <h1 class="h3 mb-4 text-gray-800">Data Pengguna</h1>

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
         <form action="users.php?page=proses" method="post">
           <div class="row">
           <div class="col-3">
               <div class="form-group">
                 <label>Nama</label>
                 <input type="text" name="nama" class="form-control " id="nama" placeholder="Nama">
               </div>
             </div>
           <div class="col-3">
               <div class="form-group">
                 <label>Username / Email</label>
                 <input type="text" name="username" class="form-control " id="username" placeholder="Username">
               </div>
             </div>
           <div class="col-3">
               <div class="form-group">
                 <label>Password</label>
                 <input type="password" name="password" class="form-control " id="password" placeholder="Password">
               </div>
             </div>
           <div class="col-3">
               <div class="form-group">
                 <label>No. Telepon</label>
                 <input type="text" name="nomor_telepon" class="form-control " id="nomor_telepon" placeholder="Nomor Telepon">
               </div>
             </div>

             <div class="col-12">
               <div class="form-group">
                 <label>Role</label>
                 <select class="form-control" name="role" id="role">
                   <option value="">Pilih</option>
                   <option value="admin">Admin</option>
                   <option value="pelamar">Pelamar</option>
                   <option value="karyawan">Karyawan</option>
                 </select>
               </div>
             </div>
             

             

           </div>

           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>



       </div>
     </div>
   </div>

 </div>

 