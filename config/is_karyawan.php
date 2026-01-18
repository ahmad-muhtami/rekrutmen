<?php
if ($_SESSION['role'] != 'karyawan') {
  header("Location: ../index.php");
  exit();
}
