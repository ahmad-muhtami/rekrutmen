<?php
if ($_SESSION['role'] != 'pelamar') {
  header("Location: ../index.php");
  exit();
}
