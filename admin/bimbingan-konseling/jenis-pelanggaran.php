<?php 
include "model/m_jenis-pelanggaran.php";
$jenpel = new jenisPelanggaran($connection);

if(@$_GET['act'] == '') {
 ?>

<div class="col-sm-12" style="padding: 0px">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><span class="glyphicon glyphicon-file"></span> Jenis Pelanggaran</li>
	</ol>
		<div class="col-sm-2">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-jenpel"><span class="glyphicon glyphicon-plus"></span> Add New Data</button>

		<div id="create-jenpel" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Create New Data</h4>
		      </div>
		      <form method="post" enctype="multipart/form-data">
		      	<div class="modal-body">
		      		<div class="form-group">
		      			<label class="control-label" for="namapel">Nama Pelanggaran :</label>
		      			<input type="text" name="namapel" class="form-control" id="namapel" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="poin">Poin :</label>
				      	<input type="text" name="poin" class="form-control" id="poin" required>
				    </div>
		      	</div>
		      	<div class="modal-footer">
		        <input type="submit" class="btn btn-success" name="insert" value="Submit"> 
		        <button type="reset" class="btn btn-danger">Reset</button>
		      	</div>
		      	<?php       	
		      	if(@$_POST['insert']) {
		      		$namapel =$connection->conn->real_escape_string($_POST['namapel']);
		      		$poin =$connection->conn->real_escape_string($_POST['poin']);

		      		$jenpel->create($namapel, $poin);
		      		header("location: ?jenis-pelanggaran");
		      	}
		       	?>
		      </form>	      
		    </div>
		  </div>
		</div>
	</div>
	<div class="col-sm-10" >
		<input class="form-control" type="text" name="cari" id="cari" placeholder="Search...." style="float: right; width: 150px;">
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Pelanggaran</th>
				<th>Poin Pelanggaran</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="isitabel">
			<?php
				$no =1;
				$batas = 7;
				$hal = @$_GET['hal'];
				if(empty($hal)){
					$posisi = 0;
					$hal = 1;
				} else{
					$posisi = ($hal-1) * $batas;
				}
				$read = $jenpel->read($posisi,$batas);
				while ($data = $read->fetch_object()) {
			 	?>	
			<tr>
				<td align="center"><?php echo $data->idPelanggaran;?></td>
				<td><?php echo $data->namaPelanggaran; ?></td>
				<td><?php echo $data->poin; ?></td>
				<td align="center">
					<a id="edit" data-toggle="modal" data-target="#edit-jenpel" data-id="<?php echo $data->idPelanggaran;?>" data-nama="<?php echo $data->namaPelanggaran; ?>" data-poin="<?php echo $data->poin; ?>">
						<button class="btn btn-primary btn-xs" href="" title="edit"><span class="glyphicon glyphicon-edit"></span> | Edit</button>
					</a>
				</td>
				<td>	
					<a href="?jenis-pelanggaran&act=delete&id=<?php echo $data->idPelanggaran;?>" onclick="return confirm ('Apakah Anda Yakin Menghapus Data Ini?')">
					<button class="btn btn-danger btn-xs" href="" title="delete"><span class="glyphicon glyphicon-remove"></span> | Delete</button>
					</a>
				</td>	
			</tr>
			<?php 
			}
			 ?>
		</tbody>
	</table>
	<div class="pagination-container" align="center">
		<nav>
			<ul class="pagination">
			<?php 
				$jml = $jenpel->read(null, null)->num_rows;
				$jml_hal = ceil($jml / $batas);
				for ($i=1; $i <= $jml_hal ; $i++) { 
					if ($i == $hal) {
						echo "<li class='active'><a>$i</a></li>";					
					} else{						
						echo "<li><a href='?jenis-pelanggaran&hal=$i'>$i</a></li>";	
					}
				}
			?>
			</ul>
		</nav>
	</div>

	<!-- modal edit -->
		<div id="edit-jenpel" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Data</h4>
		      </div>
		      <form id="form" enctype="multipart/form-data">
		      	<div class="modal-body" id="modal-edit">
		      		<div class="form-group">
		      			<input type="hidden" name="idPelanggaran" class="form-control" id="idPelanggaran">
		      			<label class="control-label" for="namapel">Nama Pelanggaran :</label>
		      			<input type="text" name="namapel" class="form-control" id="namapel" required>
		      		</div>
				    <div class="form-group">
				    	<label class="control-label" for="poin">Poin :</label>
				      	<input type="text" name="poin" class="form-control" id="poin" required>
				    </div>
				    </div>
			      	<div class="modal-footer">
			        <input type="submit" class="btn btn-success" name="edit-save" value="Save"> 
			      	</div>
			      </form>	      
			    </div>
			  </div>
			</div>
			<script type="text/javascript">
				$(document).on("click", "#edit", function () {

					var id = $(this).data("id");
					var nama = $(this).data("nama");
					var poin = $(this).data("poin");

					$("#modal-edit  #idPelanggaran").val(id);
					$("#modal-edit  #namapel").val(nama);
					$("#modal-edit  #poin").val(poin);

				})

				$(document).ready(function(e){
					$("#form").on("submit", (function(e) {
						e.preventDefault();
						$.ajax({
							url : 'model/edit_jenis-pelanggaran.php',
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

	$jenpel->delete($_GET['id'],substr($_GET['id'],-1));
	header("location: ?jenis-pelanggaran");
}  ?>
