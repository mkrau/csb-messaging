<?php
// Database.php
// a very simple wrapper for PDO

class Database{

	//default path for database configuration
	const CONFIG_PATH = "config/database.ini";

	private $connection;
	private $db_name;
	private $schema;


	public function __construct() {

		$this->getConfiguration(self::CONFIG_PATH);
		if(!isset($this->connection)) {
			$this->connection = new PDO("sqlite:" . $this->db_name);
		}	
	}

	public function __destruct() {
		$this->connection = NULL;
	}

	// Loads the configuration from given path
	//
	private function getConfiguration($path) {
		// get configuration from file at $path
		$config = parse_ini_file($path);
		$this->db_name = $config["db_name"];
		$this->schema = $config["schema"];
	}

	public function getConnection() {
		return $this->connection;
	}

}
?>
