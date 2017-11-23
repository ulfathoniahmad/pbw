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
		<div id="aa" class="modal fade" role="dialog">
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
				      	<input type="text" name="jenkel" class="form-control" id="jenkel" placeholder="Jenis Kelamin" required>
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
		        <!-- <button type="submit" class="btn btn-success" name="insert" id="insert">Submit</button> -->
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

		      		// if(@$_POST['insert']){
		      		$ssw->create($nama, $jenkel, $tempat, $tgl, $namaortu, $pekerjaan, $alamat, $telepon);
		      		header("location: ?data-siswa");
		      		// }
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
					<td>
						<!-- <button type="button" c title="edit"><span class="glyphicon glyphicon-edit"></span> Edit</button> -->
						<a class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> Edit</a>
						<a class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> Delete</a>
					</td>	
				</tr>
			<?php
			}?>	
		</table>
</div>