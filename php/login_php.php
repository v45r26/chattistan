<?php

include_once 'config.php';

$username = mysqli_real_escape_string($conn, $_POST['user-name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($username) && !empty($password)) 
{
	// let's check the email and password matched to database or not
	$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_name` = '{$username}' AND `password` = '{$password}'");
	if (mysqli_num_rows($sql) > 0) {

		$row = mysqli_fetch_assoc($sql);
		session_start();
		$_SESSION['unique_id'] = $row['unique_id'];
		$status = "Online";
		$sql = "UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'";
		$query = mysqli_query($conn, $sql);
		if ($query) 
		{
		 	echo "success";
		}
	}
	else
	{
		echo "Username and Password is incorrect!";
	}
}
else
{
	echo "All input field are required!";
}

?>