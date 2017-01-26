<?php
// UserAccess.php
// a class for querying the user table

// VULNERABILITIES:
// 1. SQL injection
// 2. Security misconfiguration: passwords stored in plain text
// 3. Stored XSS

interface iUserAccess {
	public function __construct($database);
	public function getById($id);
	public function getByUsername($username);
	public function getByUsernameAndPassword($username,$password);
	public function getAll();
	public function setPassword($id,$password);
	public function add($username,$password);
}

class UserAccess implements iUserAccess{

	private $database;

	public function __construct($database) {
		$this->database = $database;
	}

	// find user by id
	// returns an array with table field names as keys
	public function getById($id) {
		$sql = "SELECT * FROM user WHERE id=$id;";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetch();
	}

	// find user by username
	// returns an array with table field names as keys
	public function getByUsername($username) {
		$sql = "SELECT * FROM user WHERE username='$username';";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetch();
	}

	// find user by username and password
	// returns an array with table field names as keys
	public function getByUsernameAndPassword($username,$password) {
		$sql = "SELECT * FROM user WHERE username='$username' AND password='$password';";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetch();
	}

	// get all users
	// returns an array of arrays
	public function getAll() {
		$sql = "SELECT * FROM user;";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetchAll();
	}

	// add a new user to the database
	// returns true or false depending on whether operation was succesful
	public function add($username,$password) {
		$sql = "INSERT INTO user(username,password) VALUES('$username','$password');";
		
		$result = $this->database->getConnection()->exec($sql);
		return $result;
	}
	
	// change user's password
	// returns true or false depending on whether operation was succesful
	public function setPassword($id,$password) {
		$sql = "UPDATE user SET password='$password' WHERE id=$id;";

		$result = $this->database->getConnection()->exec($sql);
		return $result;
	}
}
