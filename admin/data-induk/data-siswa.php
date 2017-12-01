<?php 
include "model/m_data-siswa.php";

$ssw = new dataSiswa($connection);
 ?>


<div class="col-sm-12" style="padding: 0px">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Data Master</a></li>
		<li class="active">Data Siswa</li>
	</ol>
	<h3> Siswa</h3>
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
		      			<label class="control-label" for="nama">Nama:</label>
		      			<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jenkel">Kelamin:</label>
				      	<!-- <input type="text" name="jenkel" class="form-control" id="jenkel" placeholder="Jenis Kelamin" required> -->
				      	<div>
				      		<input type="radio" name="jenkel" id="jenkel" value="Laki-Laki"> Laki-Laki 
				      		<input type="radio" name="jenkel" id="jenkel" value="Perempuan"> Perempuan 	
				      	</div>	      	
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="tpt.tgl">Tempat, Tanggal Lahir:</label>
				      	<input type="text" name="tpt" class="form-control" id="tpt" placeholder="Tempat Lahir" required>
				      	<input type="date" name="tgl" class="form-control" id="tgl" required>
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
		      		$nama =$connection->conn->real_escape_string($_POST['nama']);
		      		$jenkel =$connection->conn->real_escape_string($_POST['jenkel']);
		      		$tempat =$connection->conn->real_escape_string($_POST['tpt']);
		      		$tgl =$connection->conn->real_escape_string($_POST['tgl']);
		      		$namaortu =$connection->conn->real_escape_string($_POST['nmortu']);
		      		$pekerjaan =$connection->conn->real_escape_string($_POST['pkj']);
		      		$alamat =$connection->conn->real_escape_string($_POST['almt']);
		      		$telepon =$connection->conn->real_escape_string($_POST['tlp']);

		      		$ssw->create($nama, $jenkel, $tempat, $tgl, $namaortu, $pekerjaan, $alamat, $telepon);
		      		header("location: ?data-siswa");
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
					<th>NIS</th>
					<th>Nama</th>
					<th>Tempat, Tanggal Lahir</th>
					<th>No Telepon Ortu</th>	
					<th></th>
				</tr>
				<?php 
					$no =1;
					$read = $ssw->read();
					while ($data = $read->fetch_object()) {
				 	?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data->NIS; ?></td>
					<td><?php echo $data->nama; ?></td>
					<td><?php echo $data->tempatLahir.', ';?>
						<?php echo $data->tglLahir; ?>
					</td>
					<td><?php echo $data->teleponOrtu; ?></td>
					<td align="center">
						<a id="edit" data-toggle="modal" data-target="#edit-ortu" data-induk="<?php echo $data->NIS; ?>" data-nama="<?php echo $data->nama; ?>" data-kelamin="<?php echo $data->kelamin; ?>" data-tempat="<?php echo $data->tempatLahir;?>" data-tgl="<?php echo $data->tglLahir; ?>" data-ortu="<?php echo $data->namaOrtu; ?>" data-pekerjaan="<?php echo $data->pekerjaan; ?>" data-alamat="<?php echo $data->alamat; ?>" data-tlp="<?php echo $data->teleponOrtu; ?>" >
							<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
						</a>
						<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
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
		      		<div class="form-group">
		      			<input type="hidden" name="induk" class="form-control" id="induk">
		      			<label class="control-label" for="nama">Nama:</label>
		      			<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="jenkel">Kelamin:</label>
				      	<input type="text" name="jenkel" class="form-control" id="jenkel" placeholder="Jenis Kelamin" required>
<!-- 				      	<div>
				      		<input type="radio" name="jenkel" id="jenkel" value="Laki-Laki"> Laki-Laki 
				      		<input type="radio" name="jenkel" id="jenkel" value="Perempuan"> Perempuan 	
				      	</div> -->
				      		      	
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="tpt.tgl">Tempat, Tanggal Lahir:</label>
				      	<input type="text" name="tpt" class="form-control" id="tpt" placeholder="Tempat Lahir" required>
				      	<input type="date" name="tgl" class="form-control" id="tgl" required>
				    </div>
				    <div class="form-group">
				    	<label class="control-label" for="ortu">Nama Orang Tua:</label> 
				      	<input type="text" name="ortu" class="form-control" id="ortu" placeholder="Nama Orang Tua" required>
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
					var nama = $(this).data("nama");
					var jenkel = $(this).data("kelamin");
					var tempat = $(this).data("tempat");
					var tgl = $(this).data("tgl");
					var ortu = $(this).data("ortu");
					var pkj = $(this).data("pekerjaan");
					var almt = $(this).data("alamat");
					var tlp = $(this).data("tlp");

					$("#modal-edit  #induk").val(nis);
					$("#modal-edit  #nama").val(nama);
					$("#modal-edit  #jenkel").val(jenkel);
					$("#modal-edit  #tpt").val(tempat);
					$("#modal-edit  #tgl").val(tgl);
					$("#modal-edit  #ortu").val(ortu);
					$("#modal-edit  #pkj").val(pkj);
					$("#modal-edit  #almt").val(almt);
					$("#modal-edit  #tlp").val(tlp);
				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_data-siswa.php',
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