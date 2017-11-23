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
		public function create($nama, $jenkel, $tempat, $tgl, $namaortu, $pekerjaan, $alamat, $telepon)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO siswa VALUES ('', '$nama', '$jenkel', '$tempat', '$tgl', '$namaortu', '$pekerjaan', '$alamat', '$telepon')") or die ($db->error);

		}


	}
?>