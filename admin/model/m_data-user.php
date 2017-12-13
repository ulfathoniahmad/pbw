<?php  
	class dataUser
	{
		private $mysqli;

		function __construct($conn)
		{
			$this->mysqli = $conn;
		}

		public function read($id_user = null)
		{
			$db = $this->mysqli->conn;
			$sql = "SELECT * from user";
			if ($id_user != null) {
				$sql .= " WHERE id_user = $id_user";
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
			$db->query("ALTER TABLE user AUTO_INCREMENT = $subs") or die ($db->error);


		}

		function __destruct()
		{
			$db = $this->mysqli->conn;
			$db->close();
			
		}

	}
?>