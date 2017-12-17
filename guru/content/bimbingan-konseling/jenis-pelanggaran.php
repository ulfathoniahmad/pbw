<?php 
include "model/m_jenis-pelanggaran.php";
$jenpel = new jenisPelanggaran($connection);

?>

<div class="col-sm-12" style="padding: 0px">
	<ol class="breadcrumb" style="border-radius: 0px">
		<li><span class="glyphicon glyphicon-file"></span> Jenis Pelanggaran</li>
	</ol>
	<div class="col-sm-12" >
		<input class="form-control" type="text" name="cari" id="cari" placeholder="Search...." style="float: right; width: 150px;">
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Pelanggaran</th>
				<th>Poin Pelanggaran</th>
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
</div>

