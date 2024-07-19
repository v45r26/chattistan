<?php

$_server = 'fdb1029.awardspace.net';
$_username = '3523635_chtdb';
$_password = 'y^A.GLk@19J{44w(';
$_db = '3523635_chtdb';

$conn = mysqli_connect($_server, $_username, $_password, $_db);
if (!$conn)
{
	echo "Connection error - ".mysqli_connect_error();
}
?>