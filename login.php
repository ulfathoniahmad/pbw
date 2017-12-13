<?php 
	@session_start();	
	ob_start();
	require_once ('config/koneksi.php');
	require_once ('models/database.php');
	include "models/m_login.php";

	$connection = new Database ($host, $user, $pass, $database);
	$queryLogin = new login($connection);

	if (@$_SESSION['admin']){
		header("location: admin/index.php");
	} elseif (@$_SESSION['siswa']){
		header("location: siswa/index.php");
	}elseif (@$_SESSION['ortu']){
		header("location: ortu/index.php");
	}elseif (@$_SESSION['guru']){
		header("location: guru/index.php");
	}else{
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Login</title>

	    <!-- Bootstrap -->
	    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	    <link href="assets/style.css" rel="stylesheet">
	    
	    <!-- jQuery lokal -->
	    <script src="assets/jquery/jquery.min.js"></script>
	 
	    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	    
	    <!-- Custom JS -->
	    <script src="assets/custom.js"></script>

	</head>	
	<body background="gambar/bk.jpg">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="container">
			<div class="row center">
				<div class="col-md-4">
					
				</div>

				<div class="col-md-4">
					
					<div class="panel panel_default" style="background-color: #5cb85c">
						<div class="panel-head">
							<div class="text-center">
								<h4><b>Silahkan Login Terlebih Dahulu</b></h4>
							</div>
						</div>
						<div class="panel-body" style="background-color: white">
							<form action="" method="POST">						
								<div class="form-group">
									<label for="user">Username</label>
									<input type="text" class="form-control" id="user" name="user" placeholder="Username" required>
								</div>
								<div class="form-group">
									<label for="pass">Password</label>
									<input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
								</div>
								<input type="submit" class="btn btn-success" id="masuk" name="masuk" value="Masuk">
								<!-- <div>
									<br>
									<p> Lupa Password <a href="lupa.php">Klik Disini</a></p>
								</div> -->
							</form>
							<?php
								$masuk = @$_POST['masuk'];	

								if ($masuk) {
									$user = $connection->conn->real_escape_string($_POST['user']);
	      							$pass = $connection->conn->real_escape_string($_POST['pass']);

									$login = $queryLogin->login($user,$pass);
									$data = $login->fetch_array();

									if ($login->num_rows >= 1) {
										if($data['level'] == "admin"){
											@$_SESSION['admin'] = $data['id_user'];
											header("location: admin/index.php");
										} elseif ($data['level'] == "siswa") {
											@$_SESSION['siswa'] = $data['id_user'];
											header("location: siswa/index.php");
										} elseif ($data['level'] == "ortu") {
											@$_SESSION['ortu'] = $data['id_user'];
											header("location: ortu/index.php");
										} elseif ($data['level'] == "guru") {
											@$_SESSION['guru'] = $data['id_user'];
											header("location: guru/index.php");
										}
									}else {
									?> <script type="text/javascript">alert("Username atau Password Salah")</script>
									<?php
									}
								}
							?>
						</div>

					</div>
				</div>			
			</div>
		</div>
	</body>
</html>

<?php 
}
 ?>