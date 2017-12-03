<?php  
	class dataSiswa
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($NIS = null)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from siswa";
			if ($NIS != null) {
				$sql .= " WHERE NIS = $NIS";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($nama, $jenkel, $tempat, $tgl)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO siswa VALUES ('', '$nama', '$jenkel', '$tempat', '$tgl')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($NIS,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM siswa WHERE NIS = $NIS") or die ($db->error);
			$db->query("ALTER TABLE siswa AUTO_INCREMENT = $subs") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>