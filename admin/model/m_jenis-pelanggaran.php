<?php  
	class jenisPelanggaran
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($posisi, $batas)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from jenispelanggaran";
			// if ($id != null) {
			// 	$sql .= " WHERE idPelaggaran = $id";
			// }
			if( $posisi!=null || $batas != null ){
				$sql .= " LIMIT $posisi,$batas";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($namapel, $poin)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO jenispelanggaran VALUES ('', '$namapel', '$poin')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($id,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM jenispelanggaran WHERE idPelanggaran = $id") or die ($db->error);
			$db->query("ALTER TABLE jenispelanggaran AUTO_INCREMENT = $subs") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>