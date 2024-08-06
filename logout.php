<?php
session_start();
require("config.php");

$insert_user = $conn->query("INSERT INTO log VALUES ('', '".$_SESSION['user']['username']."', 'Logout', '".get_client_ip()."', '$date', '$time')");
if ($insert_user == TRUE) {
unset($_SESSION['user']);
exit(header("Location: ".$config['web']['url']."auth/login.php"));
}
				