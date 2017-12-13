<?php 
include "model/m_data-guru.php";
$guru = new dataGuru($connection);

if(@$_GET['act'] == '') {
 ?>

<div class="col-sm-12" style="padding: 0px;">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><span class="glyphicon glyphicon-list-alt"></span> Data Guru</li>
	</ol>
		<div class="col-sm-2">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-guru"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>
		<br><br>

		<!-- Modal Create -->
		<div id="create-guru" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Create New Data</h4>
		      </div>
		      <form method="post" enctype="multipart/form-data">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label class="control-label" for="namaGuru">Nama Guru:</label>
		      			<input type="text" name="namaGuru" class="form-control" id="namaGuru" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jenkel">Kelamin:</label>
				      	<div>
				      		<input type="radio" name="jenkel" id="jenkel" value="Laki-Laki"> Laki-Laki 
				      		<input type="radio" name="jenkel" id="jenkel" value="Perempuan"> Perempuan 	
				      	</div>	      	
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="alamat">Alamat :</label>
				      	<input type="text" name="alamat" class="form-control" id="alamat" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="telepon">Telepon :</label>
				      	<input type="text" name="telepon" class="form-control" id="telepon" required>
				    </div>
		      	</div>
		      	<div class="modal-footer">
		        <input type="submit" class="btn btn-success" name="insert" value="Submit"> 
		        <button type="reset" class="btn btn-danger">Reset</button>
		      	</div>
		      	<?php       	
		      	if(@$_POST['insert']) {
		      		$namaGuru =$connection->conn->real_escape_string($_POST['namaGuru']);
		      		$jenkel =$connection->conn->real_escape_string($_POST['jenkel']);
		      		$alamat=$connection->conn->real_escape_string($_POST['alamat']);
		      		$telepon =$connection->conn->real_escape_string($_POST['telepon']);

		      		$guru->create($namaGuru, $jenkel, $alamat, $telepon);
		      		header("location: ?data-guru");
		      	}
		       	?>
		      </form>	      
		    </div>
		  </div>
		</div>
	</div>
		<table class="table table-striped">

				<tr>
					<th>No.</th>
					<th>NIP</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th>telepone</th>
					<th></th>
				</tr>
			<?php 
					$no =1;
					$read = $guru->read();
					while ($data = $read->fetch_object()) {
				 	?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data->NIP; ?></td>
					<td><?php echo $data->namaGuru; ?></td>
					<td><?php echo $data->jenisKelamin; ?></td>
					<td><?php echo $data->alamat;?></td>
					<td><?php echo $data->telepon;?></td>
					<td align="center">
						<a id="edit" data-toggle="modal" data-target="#edit-guru" data-induk="<?php echo $data->NIP; ?>" data-nama="<?php echo $data->namaGuru; ?>" data-kelamin="<?php echo $data->jenisKelamin; ?>" data-alamat="<?php echo $data->alamat;?>" data-telepon="<?php echo $data->telepon; ?>" >
							<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
						</a>
					</td>
					<td>
						<a href="?data-guru&act=delete&id=<?php echo $data->NIP;?>" onclick="return confirm ('Apakah Anda Yakin Menghapus Data Ini?')">
						<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
						</a>
					</td>	
				</tr>
			<?php
			}?>				
				
		</table>

		<!-- Modal Edit -->
		<div id="edit-guru" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Data</h4>
		      </div>
		      <form id="form" enctype="multipart/form-data">
		      	<div class="modal-body" id="modal-edit">
		      		<div class="form-group">
		      			<input type="hidden" name="induk" class="form-control" id="induk">
		      			<label class="control-label" for="namaGuru">Nama:</label>
		      			<input type="text" name="namaGuru" class="form-control" id="namaGuru" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jenkel">Kelamin:</label>
				      	<input type="text" name="jenkel" class="form-control" id="jenkel" required>
				      	<!-- <div>
				      		<input type="radio" name="jenkel" id="jenkel" value="Laki-Laki" > Laki-Laki 
				      		<input type="radio" name="jenkel" id="jenkel" value="Perempuan" > Perempuan 	
				      	</div> -->
				      		      	
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="alamat">Alamat:</label>
				      	<input type="text" name="alamat" class="form-control" id="alamat"  required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="telepon">Telepon:</label>
				      	<input type="text" name="telepon" class="form-control" id="telepon"  required>
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

					var nip = $(this).data("induk");
					var namaguru = $(this).data("nama");
					var jenkel = $(this).data("kelamin");
					var alamat = $(this).data("alamat");
					var telepon = $(this).data("telepon");

					$("#modal-edit  #induk").val(nip);
					$("#modal-edit  #namaGuru").val(namaguru);
					$("#modal-edit  #jenkel").val(jenkel);
					$("#modal-edit  #alamat").val(alamat);
					$("#modal-edit  #telepon").val(telepon);

				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_data-guru.php',
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

	$guru->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?data-guru");
}  ?>
