<?php
	class Database{
		private $host="localhost";
		private $user="root";
		private $pass="";
		private $db="forecast";
		public $conn;
		
		public function connect(){
			$this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
			if(!$this->conn){
				echo "<p>Gagal terhubung ke database!</p>";
			}
			return $this->conn;
		}
	}
?>