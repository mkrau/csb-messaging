<?php
// myaccount.php
// provides logic and user interface for changing account details(password)

// VULNERABILITIES:
// 1. CSRF

require_once("include/Database.php");
require_once("include/UserAccess.php");
require_once("include/authenticate.php");

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];

$database = new Database();
$users = new UserAccess($database);

if(isset($_GET["password"])) {
	$password = $_GET["password"];
	$result = $users->setPassword($user_id,$password);
	if($result) {
		echo "<p>Your password has been changed!</p>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>My account</title>
</head>

<body>
	<?php include("templates/header.html"); ?>
	<h1>My account</h1>

	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<label for="password">Password</label>
		<input type="password" name="password" placeholder="Password" maxlength="8" pattern="[a-zA-Z0-9]+">
		<input type="submit" value="Change password">
	</div>
	</form>

</body>

</html>
