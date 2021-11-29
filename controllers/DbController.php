<?php
   
	class DbController
	{
		private $server = 'localhost';
		private $user = 'root';
		private $pass = '';
		private $dbname = 'santech';
		public $db;

		public function __construct()
		{
			$this->db = new mysqli($this->server, $this->user, $this->pass, $this->dbname);

			if (mysqli_connect_error()) {
				trigger_error("Failed to connect " . mysqli_connect_error());
			} else {
				return $this->db;
			}
		}
	}

?>