 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <div class="container-fluid bg-white h-100 pt-4">

   <h1 class="h3 mb-4 text-gray-800">Tambah Bidang Pekerjaan</h1>

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
         <form action="bidang-pekerjaan.php?page=proses" method="post">
           <div class="row">
             
             <div class="col-6">
               <div class="form-group">
                 <label>Bidang Pekerjaan</label>
                 <input type="text" name="bidang_pekerjaan" class="form-control " id="bidang_pekerjaan" placeholder="Bidang Pekerjaan..">
               </div>
             </div>

             <div class="col-6">
              <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <select class="form-control" name="jenis_pekerjaan">
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Magang">Magang</option>
                </select>
              </div>
            </div>

            <div class="col-12">
               <div class="form-group">
                 <label>Jobdesk</label>
                 <textarea name="jobdesk" class="form-control" id="jobdesk" placeholder="Deskripsi pekerjaan.."></textarea>
                 
               </div>
             </div>

             <div class="col-12">
               <div class="form-group">
                 <label>Gaji Pokok</label>
                 <input type="number" name="gaji_pokok" class="form-control " id="gaji_pokok" placeholder="Gaji Pokok..">
               </div>
             </div>

             

           </div>

           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>



       </div>
     </div>
   </div>

 </div>

 