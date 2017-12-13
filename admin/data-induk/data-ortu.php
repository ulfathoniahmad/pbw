<?php 
include "model/m_data-ortu.php";
$ortu = new dataOrtu($connection);

if(@$_GET['act'] == '') {
 ?>


<div class="col-sm-12" style="padding: 0px">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><span class="glyphicon glyphicon-list-alt"></span> Data Orang Tua</li>
	</ol>
	<div class="col-sm-2">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-ortu" name="tambahdata"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>
		<br><br>


		<div id="create-ortu" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Create New Data</h4>
		      </div>
		      <form method="post" enctype="multipart/form-data">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label class="control-label" for="nis">NIS:</label>
		      			<!-- <input type="dropdown" name="nis" class="form-control" id="nis" placeholder="NIS" required> -->
		      			<?php 
		      			echo "<select class='form-control' name='nis' id='nis'>";
		      				 
			      			$read = $ortu->nis();
			      			while ($NISiswa = $read->fetch_assoc()) {		      			
		      				echo "<option>". $NISiswa ['NIS']. "</option>";
							}
		      			echo "</select>";		      			 
		      			 ?>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="nmortu">Nama Orang Tua:</label> 
				      	<input type="text" name="nmortu" class="form-control" id="nmortu" placeholder="Nama Orang Tua" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="pkj">Pekerjaan:</label>
				      	<input type="text" name="pkj" class="form-control" id="pkj" placeholder="Pekerjaan" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="almt">Alamat:</label>
				     	<textarea type="textarea" name="almt" class="form-control" rows=5 id="almt" placeholder="Alamat" required></textarea> 
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="tlp">Telepone Orang tua:</label>
				      	<input type="text" name="tlp" class="form-control" id="tlp" placeholder="Nomor Telepone" required>
				    </div>
		      	</div>
		      	<div class="modal-footer">
		        <input type="submit" class="btn btn-success" name="insert" value="Submit"> 
		        <button type="reset" class="btn btn-danger">Reset</button>
		      	</div>
		      	<?php       	
		      	if(@$_POST['insert']) {
		      		$nis =$connection->conn->real_escape_string($_POST['nis']);
		      		$namaortu =$connection->conn->real_escape_string($_POST['nmortu']);
		      		$pekerjaan =$connection->conn->real_escape_string($_POST['pkj']);
		      		$alamat =$connection->conn->real_escape_string($_POST['almt']);
		      		$telepon =$connection->conn->real_escape_string($_POST['tlp']);

		      		$ortu->create($nis, $namaortu, $pekerjaan, $alamat, $telepon);
		      		header("location: ?data-ortu");
		      	}
		       	?>
		      </form>	      
		    </div>
		  </div>
		</div>
	</div>
		<table class="table table-striped" style="text-align: center;">
				<tr>
					<th>No.</th>
					<th>Nama Ortu</th>
					<th>Pekerjaan</th>
					<th>Alamat</th>	
					<th>No. Telepon</th>
					<th>NIS</th>
					<th>Nama Siswa</th>
					<th></th>
					<th></th>
				</tr>
				<?php 
					$no =1;
					$read = $ortu->read();
					while ($data = $read->fetch_object()) {
				 	?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data->namaOrtu; ?></td>
					<td><?php echo $data->pekerjaan; ?></td>
					<td><?php echo $data->alamat;?></td>
					<td><?php echo $data->teleponOrtu;?></td>
					<td><?php echo $data->NIS; ?></td>
					<td><?php echo $data->nama; ?></td>
					<td align="center">
						<a id="edit" data-toggle="modal" data-target="#edit-ortu" data-induk="<?php echo $data->NIS; ?>" data-ortu="<?php echo $data->namaOrtu; ?>" data-pekerjaan="<?php echo $data->pekerjaan; ?>" data-alamat="<?php echo $data->alamat;?>" data-telepon="<?php echo $data->teleponOrtu; ?>" >
							<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
						</a>
					</td>
					<td>	
						<a href="?data-ortu&act=delete&id=<?php echo $data->NIS;?>" onclick="return confirm ('Apakah Anda Yakin Menghapus Data Ini?')">
						<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
						</a>
					</td>	
				</tr>
			<?php
			}?>	
		</table>


		<div id="edit-ortu" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Data</h4>
		      </div>
		      <form id="form" enctype="multipart/form-data">
		      	<div class="modal-body" id="modal-edit">
		      		<input type="text" name="nis" id="nis">
		      		<div class="form-group">
				    	<label class="control-label" for="nmortu">Nama Orang Tua:</label> 
				      	<input type="text" name="nmortu" class="form-control" id="nmortu" placeholder="Nama Orang Tua" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="pkj">Pekerjaan:</label>
				      	<input type="text" name="pkj" class="form-control" id="pkj" placeholder="Pekerjaan" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="almt">Alamat:</label>
				     	<textarea type="textarea" name="almt" class="form-control" rows=5 id="almt" placeholder="Alamat" required></textarea> 
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="tlp">Telepone Orang tua:</label>
				      	<input type="text" name="tlp" class="form-control" id="tlp" placeholder="Nomor Telepone" required>
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

					var nis = $(this).data("induk");
					var ortu = $(this).data("ortu");
					var pkj = $(this).data("pekerjaan");
					var almt = $(this).data("alamat");
					var tlp = $(this).data("telepon");

					$("#modal-edit  #nis").val(nis);
					$("#modal-edit  #nmortu").val(ortu);
					$("#modal-edit  #pkj").val(pkj);
					$("#modal-edit  #almt").val(almt);
					$("#modal-edit  #tlp").val(tlp);
				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_data-ortu.php',
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
		// echo substr("Qolilah",-1);

	$ortu->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?data-ortu");
}  ?>