<?php
session_start();
if ($_SESSION['login']) {
  header("Location: ../admin/index.php");
  exit();
} else {
  header("Location: ../index.php");
  exit();
}
