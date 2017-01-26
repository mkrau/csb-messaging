<?php
// messageboard.php
// provides user interface for reading, adding and deleting messages

// VULNERABILITIES:
// 1. XSS

require_once("include/Database.php");
require_once("include/MessageAccess.php");
require_once("include/UserAccess.php");
require_once("include/authenticate.php");

?>

<!DOCTYPE html>
<html>

<head>
	<title>Message Board</title>
</head>

<body>
	<?php include("templates/header.html"); ?>
	<h1>Message List</h1>
		<table>
			<thead>
				<tr>
					<th>Time</th>
					<th>User</th>
					<th>Message</th>
				</tr>
			</thead>

			<tbody>			
			<?php

			$database = new Database();
			$users = new UserAccess($database);
			$messages = new MessageAccess($database);

			// get & iterate all messages
			$result = $messages->getAll();;
			foreach ($result as $row) {
				$sender_id = $row["sender"];
				$message_id = $row["id"];

				// get sender's username by id
				$user = $users->getById($sender_id);
				$username = $user["username"];

				//print message as table row
				echo "<tr>";
					echo "<td>" . $row["date"] . "</td>";
					echo "<td>" . $username . "</td>";
					echo "<td>" . $row["content"] . "</td>";
					// if user owns the message, show delete button
					if($username == $_SESSION["username"]) {
						echo "<td><a href='deletemessage.php?id=$message_id'>Delete</a></td>";
					}
				echo "</tr>";

			}

			?>
			</tbody>

		</table>
		<form method="get" action="addmessage.php">
			<textarea name="message" rows="3" autofocus="true" value="">
			</textarea>
			<input type="submit" value="Add message">
		</form>	
	</div>
</body>


</html>
