<?php  
	class dataOrtu
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($NIS = null)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM siswa s JOIN ortu  o ON s.NIS= o.NIS  ";
			if ($NIS != null) {
				$sql .= " WHERE NIS = $NIS";
			} $sql .="ORDER BY o.NIS asc";
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($nis, $namaortu, $pekerjaan, $alamat, $telepon)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO ortu VALUES ('$nis', '$namaortu', '$pekerjaan', '$alamat', '$telepon')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($NIS,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM ortu WHERE NIS = $NIS") or die ($db->error);
			$db->query("ALTER TABLE ortu AUTO_INCREMENT = $subs") or die ($db->error);


		}

		public function nis()
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from siswa";
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