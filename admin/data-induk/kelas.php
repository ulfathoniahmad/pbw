<?php 
include "model/m_data-kelas.php";
$kelas = new dataKelas($connection);

if(@$_GET['act'] == '') {
 ?>

<div class="col-sm-12" style="padding: 0px">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><span class="glyphicon glyphicon-list-alt"></span> Kelas</li>
	</ol>
		<div class="col-sm-2">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-kelas"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>
		</div>

		<div id="create-kelas" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Create New Data</h4>
		      </div>
		      <form metdod="post" enctype="multipart/form-data">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label class="control-label" for="namkel">Nama Kelas:</label>
		      			<input type="text" name="namkel" class="form-control" id="namkel" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jmlsiswa">Jumlah Siswa:</label>
	      				<input type="text" name="jmlsiswa" class="form-control" id="jmlsiswa" required>
				    </div>
		      	</div>
		      	<div class="modal-footer">
		        <input type="submit" class="btn btn-success" name="insert" value="Submit"> 
		        <button type="reset" class="btn btn-danger">Reset</button>
		      	</div>
		      	<?php       	
		      	if(@$_POST['insert']) {
		      		$namakelas =$connection->conn->real_escape_string($_POST['namkel']);
		      		$jumlahsiswa =$connection->conn->real_escape_string($_POST['jmlsiswa']);

		      		$kelas->create($namakelas, $jumlahsiswa);
		      		header("location: ?data-siswa");
		      	}
		       	?>
		      </form>	      
		    </div>
		  </div>
		</div>
		<br>
		<br>
		<table class="table table-striped">
				<tr>
					<td>ID Kelas</td>
					<td>Nama Kelas</td>
					<td>Jumlah Siswa</td>
					<td></td>
					<td></td>
				</tr>
			<?php 
					$no =1;
					$read = $kelas->read();
					while ($data = $read->fetch_object()) {
				 	?>
				<tr>
					<td align="center"><?php echo $data->idKelas; ?></td>
					<td><?php echo $data->namaKelas; ?></td>
					<td><?php echo $data->jumlahSiswa; ?></td>
					<td align="center">
						<a id="edit" data-toggle="modal" data-target="#edit-kelas" data-id="<?php echo $data->idKelas; ?>" data-namakelas="<?php echo $data->namaKelas; ?>" data-jumlahsiswa="<?php echo $data->jumlahSiswa; ?>">
							<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
						</a>
					</td>
					<td>
						<a href="?kelas&act=delete&id=<?php echo $data->idKelas;?>" onclick="return confirm ('Apakah Anda Yakin Menghapus Data Ini?')">
						<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
						</a>
					</td>	
				</tr>
			<?php
			}?>							
		</table>

		<div id="edit-kelas" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Data</h4>
		      </div>
		      <form id="form" enctype="multipart/form-data">
		      	<div class="modal-body" id="modal-edit">
		      		<div class="form-group">
		      			<input type="text" name="idkelas" class="form-control" id="idkelas">
		      			<label class="control-label" for="uname">Nama Kelas:</label>
		      			<input type="text" name="namkel" class="form-control" id="namkel" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jumlahsiswa">Jumlah Siswa</label>
				      	<input type="text" name="jumlahsiswa" class="form-control" id="jumlahsiswa" required>
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

					var idKelas = $(this).data("id");
					var namakelas = $(this).data("namakelas");
					var jumlahsiswa = $(this).data("jumlahsiswa");
					
					$("#modal-edit  #idkelas").val(idKelas);
					$("#modal-edit  #namkel").val(namakelas);
					$("#modal-edit  #jumlahsiswa").val(jumlahsiswa);
				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_data-kelas.php',
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

	$kelas->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?kelas");
}  ?>
