<?php
// MessageAccess.php
// a class for querying the messages table

// VULNERABILITIES:
// 1. SQL injection
// 2. Stored XSS

interface iMessageAccess {

	public function __construct($database);
	public function getById($id);
	public function getBySender($username);
	public function getByContent($content);
	public function getAll();
	public function add($sender,$content);
	public function delete($id);

}

class MessageAccess implements iMessageAccess{

	private $database;
	
	public function __construct($database) {
		$this->database = $database;
	}

	// find message by id
	// returns array with table field names as keys
	public function getById($id) {
		$sql = "SELECT * FROM message WHERE id=$id;";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetch();
	}

	// find messages by user
	// returns array of arrays
	public function getBySender($username) {
		$sql = "SELECT * FROM message WHERE sender='$username';";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetchAll();
	}

	//find messages by content
	// returns array of arrays
	public function getByContent($content) {
		$sql = "SELECT * FROM message WHERE content LIKE '%$content%';";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetchAll();
	}

	// get all messages
	// returns array of arrays
	public function getAll() {
		$sql = "SELECT * FROM message ORDER BY date ASC;";

		$result = $this->database->getConnection()->query($sql);
		return $result->fetchAll();
	}

	// add a new message to the database
	// returns true or false depending on whether operation was succesful
	public function add($sender,$content) {
		$sql = "INSERT INTO message(sender,content,date) VALUES($sender,'$content', (SELECT datetime()) );";
		
		$result = $this->database->getConnection()->exec($sql);
		return $result;
	}

	// delete a message from the database
	//returns true or false depending on whether operation was succesful
	public function delete($id) {
		$sql = "DELETE FROM message WHERE id=$id;";

		$result = $this->database->getConnection()->exec($sql);
		return $result;
	}
}
