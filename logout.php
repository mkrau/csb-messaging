<?php
// logout.php
// logic for logging out, i.e. invalidating the session


// get the current session
session_start();

session_destroy();
$message = urlencode("You have logged out");
header("Location: login.php?message=$message");
exit();

?>
