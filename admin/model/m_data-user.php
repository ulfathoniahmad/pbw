<?php  
	class dataUser
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($posisi,$batas)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from user";
			if ($posisi != null || $batas != null) {
				$sql .= " LIMIT $posisi,$batas";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}
		public function create($username, $password, $level, $nama)
		{
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO user VALUES ('', '$username', '$password', '$level', '$nama')") or die ($db->error);

		}
		public function edit($sql)
		{
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db->error);
		}

		public function delete($id_user,$subs)
		{
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM user WHERE id_user = $id_user") or die ($db->error);
			$db->query("ALTER TABLE user AUTO_INCREMENT = 1") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>