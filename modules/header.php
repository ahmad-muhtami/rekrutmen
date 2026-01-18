  <?php
  ob_start();
  session_start();
  if (!$_SESSION['login']) {
    header("Location: ../login.php");
    exit();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="../assets/library/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="../assets/library/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">

    <style>
      .bg-primary2 {
        background-color: burlywood;
      }
    </style>
  </head>

  <body id="page-top">

    <div id="wrapper">

      <?php
      include 'sidebar.php';
      ?>

      <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

          <nav class="navbar navbar-expand bg-white topbar static-top border-0 shadow-sm" style="border-bottom: 1px solid #d3d3d3;">

            <button id="sidebarToggleTop" class="btn btn-dark d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <?php
            include '../config/koneksi.php';
            ?>

            

          </nav>