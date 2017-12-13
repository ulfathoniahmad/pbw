<?php 
include "model/m_data-user.php";
$user = new dataUser($connection);

if(@$_GET['act'] == '') {
 ?>


<div class="col-sm12">
	<ol class="breadcrumb">
		<li><span class="glyphicon glyphicon-list-alt"></span> Data User</li>
	</ol>
	<div class="col-sm-2">
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-user"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>
	<br>
	<br>

	<div id="create-user" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Create New Data</h4>
	      </div>
	      <form method="post" enctype="multipart/form-data">
	      	<div class="modal-body">
	      		<div class="form-group">
	      			<label class="control-label" for="uname">Username:</label>
	      			<input type="text" name="uname" class="form-control" id="uname" required>
	      		</div>
			    <div class="form-group">
			    	<label class="control-label" for="pass">Password:</label>
      				<input type="text" name="pass" class="form-control" id="pass" required>
			    </div>
			    <div class="form-group">
			    	<label class="control-label" for="level">Level:</label>
			      	<input type="text" name="level" class="form-control" id="level" required>
			    </div>
			    <div class="form-group">
			    	<label class="control-label" for="level">Nama:</label>
			      	<input type="text" name="nama" class="form-control" id="nama" required>
			    </div>
	      	</div>
	      	<div class="modal-footer">
	        <input type="submit" class="btn btn-success" name="insert" value="Submit"> 
	        <button type="reset" class="btn btn-danger">Reset</button>
	      	</div>
	      	<?php       	
	      	if(@$_POST['insert']) {
	      		$nama =$connection->conn->real_escape_string($_POST['nama']);
	      		$username =$connection->conn->real_escape_string($_POST['uname']);
	      		$password =$connection->conn->real_escape_string($_POST['pass']);
	      		$level =$connection->conn->real_escape_string($_POST['level']);

	      		$user->create($username, $password, $level, $nama);
	      		header("location: ?user");
	      	}
	       	?>
	      </form>	      
	    </div>
	  </div>
	</div>
	</div>
		<table class="table table-striped">
				<tr>
					<td>ID User</th>
					<td>Username</td>
					<td>Password</td>	
					<td>Level</td>
					<td>Nama</td>
					<td></td>
					<td></td>
				</tr>
				<?php 
					$no =1;
					$read = $user->read();
					while ($data = $read->fetch_object()) {
				 	?>
				<tr>
					<td align="center"><?php echo $data->id_user; ?></td>
					<td><?php echo $data->username; ?></td>
					<td><?php echo $data->password; ?></td>
					<td><?php echo $data->level; ?></td>
					<td><?php echo $data->nama;?></td>
					<td align="center">
						<a id="edit" data-toggle="modal" data-target="#edit-user" data-id="<?php echo $data->id_user; ?>" data-username="<?php echo $data->username; ?>" data-password="<?php echo $data->password; ?>" data-level="<?php echo $data->level;?>" data-nama="<?php echo $data->nama; ?>" >
							<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
						</a>
					</td>
					<td>
						<a href="?user&act=delete&id=<?php echo $data->id_user;?>" onclick="return confirm ('Apakah Anda Yakin Menghapus Data Ini?')">
						<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
						</a>
					</td>	
				</tr>
			<?php
			}?>					
		</table>

		<div id="edit-user" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Data</h4>
		      </div>
		      <form id="form" enctype="multipart/form-data">
		      	<div class="modal-body" id="modal-edit">
		      		<div class="form-group">
		      			<input type="hidden" name="id_user" class="form-control" id="id_user">
		      			<label class="control-label" for="uname">Username:</label>
		      			<input type="text" name="uname" class="form-control" id="uname" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jenkel">Password:</label>
				      	<input type="text" name="pass" class="form-control" id="pass" required>
				      	<!-- <div>
				      		<input type="radio" name="jenkel" id="jenkel" value="Laki-Laki" > Laki-Laki 
				      		<input type="radio" name="jenkel" id="jenkel" value="Perempuan" > Perempuan 	
				      	</div> -->
				      		      	
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="level">Level:</label>
				      	<input type="text" name="level" class="form-control" id="level" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="nama">Nama:</label>
				      	<input type="text" name="nama" class="form-control" id="nama" required>
				    </div>
				    </div>
			      	<div class="modal-footer">
			        <input type="submit" class="btn btn-success" name="edit-save" value="Save"> 
			      	</div>
			      </form>	      
			    </div>
			  </div>
			</div>
   			<script src="../assets/jquery/jquery.min.js"></script>
			<script type="text/javascript">
				$(document).on("click", "#edit", function () {

					var id_user = $(this).data("id");
					var username = $(this).data("username");
					var password = $(this).data("password");
					var level = $(this).data("level");
					var nama = $(this).data("nama");

					$("#modal-edit  #id_user").val(id_user);
					$("#modal-edit  #uname").val(username);
					$("#modal-edit  #pass").val(password);
					$("#modal-edit  #level").val(level);
					$("#modal-edit  #nama").val(nama);

				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_data-user.php',
							type : 'post',
							data : new FormData(this),
							contentType : false,
							cache : false,
							processData : false,
							success : function(msg){
								$('.table').html(msg);
							}
						});
					}));
				})
			</script>
</div>
<?php
} else if (@$_GET['act'] == 'delete') {

	$user->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?user");
}  ?>
