<?php  
	class dataGuru
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($NIP = null)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from guru";
			if ($NIP != null) {
				$sql .= " WHERE NIP = $NIP";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($namaGuru, $jenkel, $alamat, $telepon)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO guru VALUES ('', '$namaGuru', '$jenkel', '$alamat', '$telepon')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($NIP,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM guru WHERE NIP = $NIP") or die ($db->error);
			$db->query("ALTER TABLE guru AUTO_INCREMENT = $subs") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>