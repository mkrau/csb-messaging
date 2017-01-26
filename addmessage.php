<?php
// addmessage.php
// provides logic for adding a message to the database

// VULNERABILITIES:
// 1. CSRF

require("include/Database.php");
require("include/MessageAccess.php");
require("include/authenticate.php");

//check & get request parameters
if(isset($_GET["message"])) {
	$username = $_SESSION["username"];
	$user_id = $_SESSION["id"];
	$message = $_GET["message"];

	$database = new Database();
	$messages = new MessageAccess($database);

	$result = $messages->add($user_id,$message);

	header("Location: messageboard.php");
}

?>
