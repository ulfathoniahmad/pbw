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
			if( $posisi!=null || $batas != null ){
				$sql .= " LIMIT $posisi,$batas";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>