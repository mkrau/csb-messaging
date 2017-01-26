<?php
// login.php
// user interface and logic to allow users to log in, i.e. start a session

// VULNERABILITIES:
// 1. GET exposes sensitive data
// 2. XSS

require_once("include/Database.php");
require_once("include/UserAccess.php");
session_start();

//display message if we have one
if(isset($_GET["message"])) {
	echo $_GET["message"];
}

//check & get request parameters
if(isset($_GET["username"]) && isset($_GET["password"])) {

	$username = $_GET["username"];
	$password = $_GET["password"];
	
	$database = new Database();
	$users = new UserAccess($database);

	$user = $users->getByUsernameAndPassword($username,$password);

	if($user["id"] == NULL) {
		echo "<p>Login incorrect!</p>";
	}
	else {
		$_SESSION["id"]=$user["id"];
		$_SESSION["username"]=$user["username"];
		echo "<p>Welcome back, $username!</p>";
	}	
}
?>

<html>
<head>
	<title>Login</title>
</head>

<body>
	<?php
		include("templates/header.html"); 
	?>
	
	
	<h1>Login<h1>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" value="Login">
	</form>
	
	<a href="register.php">Not registered yet?</a>
</body>

</html>
