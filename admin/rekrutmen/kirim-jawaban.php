<?php
include '../config/koneksi.php';

$pelamar_id = $_SESSION['id'];

if (isset($_POST['kirim'])) {

    $rekrutmen_id = $_POST['rekrutmen_id'];
    $jawabanList = $_POST['jawaban'];          
    $pertanyaanList = $_POST['pertanyaan_id']; 

    for ($i = 0; $i < count($pertanyaanList); $i++) {

        $pertanyaan_id = $pertanyaanList[$i];
        $jawaban       = mysqli_real_escape_string($koneksi, $jawabanList[$i]);

        $query = "
            INSERT INTO jawaban (pelamar_id, pertanyaan_id, rekrutmen_id, jawaban)
            VALUES ('$pelamar_id', '$pertanyaan_id', '$rekrutmen_id', '$jawaban')
        ";

        mysqli_query($koneksi, $query);
    }


    $_SESSION['result']  = 'success';
    $_SESSION['message'] = 'Jawaban berhasil dikirim!';
    header("Location: rekrutmen.php?page=status-rekrutmen");
    exit();
}
?>
