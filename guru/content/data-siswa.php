<?php 
include "model/m_data-siswa.php";
$ssw = new dataSiswa($connection);

?>

<div class="col-sm-12">
	<ol class="breadcrumb">
		<li><span class="glyphicon glyphicon-list-alt"></span> Data Siswa</li>
	</ol>
	<div class="col-sm-12" >
		<input class="form-control" type="text" name="cari" id="cari" placeholder="Search...." style="float: right; width: 150px;">
	</div>
	<h3>Siswa</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Tempat, Tanggal Lahir</th>	
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
			$read = $ssw->read($posisi,$batas);	
			while ($data = $read->fetch_object()) {
				$id =$data->NIS;
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data->NIS; ?></td>
					<td><?php echo $data->nama; ?></td>
					<td><?php echo $data->kelamin; ?></td>
					<td><?php echo $data->tempatLahir.', ';?>
						<?php echo $data->tglLahir; ?>
					</td>	
					<td>
						<a id="detail_btn" data-toggle="modal" data-target="#detail">
							<button class="btn btn-info btn-xs" href="" title="detail"><span class="glyphicon glyphicon-search"></span> | Detail</button>
						</a>
					</td>	
				</tr>
				<?php
			}?>	
		</tbody>		
	</table>

	<div class="pagination-container" align="center">
		<nav>
			<ul class="pagination">
				<?php 
				$jml = $ssw->read(null,null)->num_rows;
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

	<!-- modal detail -->
	<div id="detail" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Detail Data</h4>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>NIS</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Tempat, Tanggal Lahir</th>	
								<th>Nama Ortu</th>	
								<th>Pekerjaan</th>
								<th>Alamat</th>
								<th>Telepon</th>
							</tr>			
						</thead>
						<tbody id="isitabel">
							<?php 
							if (@$_GET['act'] == 'detail') {
							
							$read = $ssw->detail($_GET['id']);	
							while ($data = $read->fetch_object()) {
								?>
								<tr>
									<td><?php echo $data->NIS; ?></td>
									<td><?php echo $data->nama; ?></td>
									<td><?php echo $data->kelamin; ?></td>
									<td><?php echo $data->tempatLahir.', ';?>
										<?php echo $data->tglLahir; ?>
									</td>
									<td><?php echo $data->namaOrtu; ?></td>
									<td><?php echo $data->pekerjaan; ?></td>
									<td><?php echo $data->alamat; ?></td>
									<td><?php echo $data->teleponOrtu; ?></td>

								</tr>
								<?php
							}}?>	
						</tbody>		
					</table>
				</div>      
			</div>
		</div>
	</div>
</div>
