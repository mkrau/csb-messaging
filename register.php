<?php
// register.php
// provides logic and user interface for creating a new user

// VULNERABILITIES:
// 1. CSRF
// 2. XSS

require_once("include/Database.php");
require_once("include/UserAccess.php");

// check & get request parameters
if (isset($_POST["username"]) && isset($_POST["password"]) ) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$database = new Database();
	$users = new UserAccess($database);

	$result = $users->add($username,$password);
	if($result) {
		echo "<br>User $username created! You can now login.<br>";
	}
	else {
		echo "<br>That username already exists. Please pick another one</br>";
	}	
} 
	
?>

<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
</head>

<body>
	<?php
		include("templates/header.html");
	?>
	<h1>Register</h1>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<div>
			<label for="username">Username</label>
			<input type="text" name="username" placeholder="Username" maxlength="8" pattern="[a-zA-Z0-9]+">
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password" maxlength="8" pattern="[a-zA-Z0-9]+">
		</div>
		<div>
			<input type="submit" value="Create!">
		</div>
	</form>
</body>

</html>
