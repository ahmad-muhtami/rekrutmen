<?php
?>

<title>Dashboard</title>

<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'dashboard';
}
echo $page;
die;
switch ($variable) {
  case 'value':
    break;

  default:
    break;
}
?>

<?php
include '../modules/footer.php';
?>