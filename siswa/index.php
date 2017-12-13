<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
    
    
    <!-- jS -->
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <style>
        .row.content {height: 450px}
        
        .sidenav {
          background-color: #f1f1f1;
          height: 100%;
        }
        footer {
          background-color: #555;
          color: white;
          padding: 15px;
        }
        @media screen and (max-width: 767px) {
          .sidenav {
            height: auto;
            padding: 15px;
          }
          .row.content {height: auto;} 
        }
    </style>  
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="">SiBeKa</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../models/logout.php"><span class="glyphicon glyphicon-log-out">Logout</span></a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row content">
        <div class="col-sm-3 sidenav">
            <br>
            <center><img src="" height="150px" width="150px"></center>
            <br>      
            <center><b>Siswa</b></center>               
            <br>
          <?php include "menu.php"; ?>
        </div>
        <div class="col-sm-9">
            <?php 

                if (isset($_GET['dasboard'])) {
                include 'content/dasboard.php';
               } 
               elseif (isset($_GET['jenis-pelanggaran'])) {
                 include 'content/jenis-pelanggaran.php';
               }
               else {
                include 'content/dasboard.php';
               }

            ?>     
          </div>
      </div>
    </div>

   <!--  <div>
      <footer class="container-fluid text-center">
        <p>© 2K17. Ahmad Ulfathoni</p>
      </footer>
    </div> -->
  </body>
</html>