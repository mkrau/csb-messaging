<?php
// authenticate.php
// this file is included for each page that requires authentication

// start session or continue existing session
session_start();

//if user has not been authenticated, redirect to login
if(empty($_SESSION["username"])) {
	//message sent as GET parameter to the login page
	$message = "You need to be logged in to access that resource";
	
	header("Location: login.php?message=". urlencode($message));
	exit();
}
?>
