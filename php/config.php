<?php

$_server = 'localhost';
$_username = 'root';
$_password = '';
$_db = 'chtdb';

$conn = mysqli_connect($_server, $_username, $_password, $_db);
if (!$conn)
{
	echo "Connection error - ".mysqli_connect_error();
}
?>
