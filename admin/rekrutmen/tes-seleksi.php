<?php 

$queryLamaranByUser = "
    SELECT * FROM rekrutmen 
    WHERE pelamar_id = '{$_SESSION['id']}'
    ORDER BY tanggal DESC 
    LIMIT 1
";

$resultLamaranByUser = mysqli_query($koneksi, $queryLamaranByUser);

if (mysqli_num_rows($resultLamaranByUser) == 0) {
    echo "<script>alert('Anda belum melamar pekerjaan, silahkan lamar pekerjaan.');</script>";
    echo "<script>window.location='rekrutmen.php?page=lamar';</script>";
    exit();
}

$lamaran = mysqli_fetch_assoc($resultLamaranByUser);

if ($lamaran['status'] != 'menunggu' && $lamaran['status'] != 'diproses') {
    echo "<script>window.location='rekrutmen.php?page=status-rekrutmen';</script>";
    exit();
}


$lowongan_id = $lamaran['lowongan_id'];

$queryPertanyaan = "
    SELECT * FROM pertanyaan 
    WHERE lowongan_id = '$lowongan_id'
    ORDER BY id ASC
";

$resultPertanyaan = mysqli_query($koneksi, $queryPertanyaan);

$queryJawaban = "
    SELECT jawaban.*, rekrutmen.status AS status_rekrutmen 
    FROM jawaban 
    JOIN rekrutmen ON jawaban.rekrutmen_id = rekrutmen.id 
    WHERE jawaban.pelamar_id = '{$_SESSION['id']}'
      AND jawaban.rekrutmen_id = '{$lamaran['id']}'
      AND rekrutmen.status = 'menunggu'
";

$resultJawaban = mysqli_query($koneksi, $queryJawaban);

if($resultJawaban && mysqli_num_rows($resultJawaban) > 0){
    echo "<script>alert('Anda sudah mengerjakan tes seleksi. Silahkan tunggu proses selanjutnya.');</script>";
    echo "<script>window.location='rekrutmen.php?page=status-rekrutmen';</script>";
    exit();
}

?>

<div class="container-fluid h-100 p-4 bg-white">
   

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Tes Seleksi Rekrutmen</h1>
  </div>


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
    </div>

  <form action="rekrutmen.php?page=kirim-jawaban" method="post" class="row">

    <?php 
    $i = 1; 
    while ($pertanyaan = mysqli_fetch_assoc($resultPertanyaan)) : 
    ?>

        <div class="col-12">
        <p><strong><?= $i++ ?>.</strong> <?= $pertanyaan['pertanyaan'] ?></p>

            <div class="form-group">
              <textarea class="form-control" name="jawaban[]" rows="3" required></textarea>
              <input type="hidden" name="pertanyaan_id[]" value="<?= $pertanyaan['id'] ?>">
              <input type="hidden" name="rekrutmen_id" value="<?= $lamaran['id'] ?>">
            </div>
        </div>

    <?php endwhile; ?>

    <button name="kirim" value="kirim" class="btn btn-dark w-100 mx-3">Kirim Jawaban</button>

  </form>

</div>
