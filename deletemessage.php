<?php
// deletemessage.php
// provides functionality to delete messages from the database

// VULNERABILITIES:
// 1. CSRF
// 2. Direct Object Reference

require_once("include/Database.php");
require_once("include/MessageAccess.php");
require_once("include/authenticate.php");

if(isset($_GET["id"])) {
	$message_id = $_GET["id"];
	
	$database = new Database();
	$messages = new MessageAccess($database);
	$result = $messages->delete($message_id);

	header("Location: messageboard.php");
}

?>
