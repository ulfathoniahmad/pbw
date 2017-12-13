<?php 
@session_start();
ob_start();

require_once ('../config/koneksi.php');
require_once ('../models/database.php');
$timeout = 10; // Set timeout menit
$logout_redirect_url = "../login.php"; // Set logout URL

$timeout = $timeout * 60; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();

$connection = new Database ($host, $user, $pass, $database);

if (@$_SESSION['admin'] || @$_SESSION['siswa']|| @$_SESSION['ortu'] || @$_SESSION['guru']){
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
    
    
    <!-- jS -->
    <script src="../assets/kustom.js"></script>
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <style>
        .row.content {height: 550px}
        
        .sidenav {
          background-color: #f1f1f1;
          height: 100%;
        }

        .nav-sidebar > li.active > a,
        .nav-sidebar > li.active > a:hover,
        .nav-sidebar > li.active > a:focus {
          color: #fff;
          background-color: #222;
          /*background-color: #337ab7;*/
        }
        .navbar-inverse {
          background-color: #222;
          margin-left: 0px;
        }


        footer {
          background-color: rgba(89, 89, 89,0.3);
          color: black;
          padding: 15px;
        }

        footer .container-fuild{
          min-height: 100%;
        }
        @media screen and (max-width: 767px) {
          .sidenav {
            height: auto;
            padding: 5px;
          }
          .row.content {height: auto;} 

          .margin-bottom{
            margin-bottom:16px!important}

          .quarter{float:left;width:100%}

          .quarter{width:24.99999%}

          .padding-16{padding-top:16px!important;padding-bottom:16px!important}
          .left{float:left!important}
          .right{float:right!important}
          .xxxlarge{font-size:48px!important}

        }

    </style>  
  </head>

  <body>
    <div class="navbar">
    <div class="navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">SiBeKa</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../models/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
      <div class="row content">
        <div class="col-sm-3 sidenav" style="background-color: #337ab7;">
           <br>
            <center><img src="" height="150px" width="150px"></center>
            <br>      
            <center><b style="color: white;" >Admin</b></center>               
            <br>
            <?php include "menu.php"; ?>
        </div>
        <div class="col-sm-9 " style="margin-top: 10px;">
            <?php 

                if (isset($_GET['dasboard'])) {
                include 'dasboard.php';
               } 
               elseif (isset($_GET['user'])) {
                 include 'data-induk/user.php';
               }
               elseif (isset($_GET['data-guru'])) {
                 include 'data-induk/data-guru.php';
               }
               else if (isset($_GET['data-siswa'])) {
                 include 'data-induk/data-siswa.php';
                // header("location : data-siswa.php");
               }
               else if (isset($_GET['data-ortu'])) {
                 include 'data-induk/data-ortu.php';
               }
                elseif (isset($_GET['kelas'])) {
                  include 'data-induk/kelas.php';
                }
               elseif (isset($_GET['jenis-pelanggaran'])) {
                 include 'bimbingan-konseling/jenis-pelanggaran.php';
               }
               elseif (isset($_GET['pelanggaran-siswa'])) {
                 include 'bimbingan-konseling/pelanggaran-siswa.php';
               }
               elseif (isset($_GET['detail-poin'])) {
                 include 'bimbingan-konseling/detail-poin.php';
               }
               else {
                include 'dasboard.php';
               }

            ?>     
          </div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top:px">
      
    </div>
    <!-- <div>
      <footer class="container-fluid text-center">
        <p>© 2K17. Ahmad Ulfathoni</p>
      </footer>
    </div> -->
  </body>
</html>

<?php 
  } else {
  header("location: ../login.php");
  
  }

?>