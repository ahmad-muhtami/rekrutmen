 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <div class="container-fluid bg-white h-100 pt-4">

   <h1 class="h3 mb-4 text-gray-800">Tambah Jenis Tunjangan</h1>

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
         <form action="tunjangan.php?page=proses" method="post">
           <div class="row">
             
             <div class="col-12">
               <div class="form-group">
                 <label>Jenis Tunjangan</label>
                 <input type="text" name="jenis_tunjangan" class="form-control " id="jenis_tunjangan" placeholder="Jenis Tunjangan..">
               </div>
             </div>


             <div class="col-12">
               <div class="form-group">
                 <label>Nominal</label>
                 <input type="number" name="nominal" class="form-control " id="nominal" placeholder="Nominal tunjangan..">
               </div>
             </div>

             

           </div>

           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>



       </div>
     </div>
   </div>

 </div>

 