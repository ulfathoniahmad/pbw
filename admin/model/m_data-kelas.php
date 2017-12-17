<?php  
	class dataKelas
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($posisi,$batas)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from kelas";
			if ($posisi != null || $batas != null) {
				$sql .= " LIMIT $posisi,$batas";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($namakelas, $jumlahsiswa)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO kelas VALUES ('', '$namakelas', '$jumlahsiswa')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($idKelas,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM kelas WHERE idKelas = $idKelas") or die ($db->error);
			$db->query("ALTER TABLE kelas AUTO_INCREMENT = $subs") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>