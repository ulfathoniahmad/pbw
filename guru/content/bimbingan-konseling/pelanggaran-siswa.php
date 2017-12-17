<?php 
include "model/m_pelanggaran-siswa.php";
$pelanggaran = new dataPelanggaranSiswa($connection);

if(@$_GET['act'] == '') {
 ?>

<div class="col-sm-12">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-file"></span> Bimbingan Konseling</a></li>
		<li class="active">Pelanggaran Siwa</li>
	</ol>
	<h3>Pelanggaran Siswa</h3>
		<div class="col-sm-2">
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#create-ortu"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>

		<div id="create-ortu" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		     <!--    <button type="button" class="close" data-dismiss="modal">&times;</button> -->
		        <h4 class="modal-title">Create New Data</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal">
		        	<div class="form-group">
				    <label class="control-label col-sm-2" for="namsis">Nama Siswa:</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="namsis" placeholder="Masukkan Nama Siswa">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="nampel">Nama Pelanggaran:</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nampel" placeholder="Masukkan Nama Pelanggaran">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="poin">Poin Pelanggaran:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="poin" placeholder="Masukkan Poin Pelanggaran">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="tgl">Tanggal Kejadian:</label>
				    <div class="col-sm-10"> 
				      <input type="date" class="form-control" id="tgl">
				    </div>
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-default">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<br><br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Siswa</th>
					<th>Nama Pelanggaran</th>
					<th>Poin Pelanggaran</th>
					<th>Tanggal Kejadian</th>
					<th></th>
				</tr>			
			</thead>
			<tbody>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>	
					<th>
						<a href="" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
					</th>	
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>	
					<th>
						<a href="" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
					</th>	
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>	
					<th></th>
					<th></th>
					<th>
						<a href="" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
					</th>	
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>	
					<th>
						<a href="" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
					</th>	
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>	
					<th>
						<a href="" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
					</th>	
				</tr>
			</tbody>		
		</table>
</div>

<?php
} else if (@$_GET['act'] == 'delete') {

	$ssw->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?pelanggaran-siswa");
}  ?>
