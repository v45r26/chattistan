<?php

session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header("location: login.php");
}
else
{
	include_once '../php/config.php';

	$logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
	if (isset($logout_id))
	{
		$status = "Offline";
		$sql = "UPDATE users SET status = '{$status}' WHERE unique_id = '{$logout_id}'";
		$query = mysqli_query($conn, $sql);
		if ($query) 
		{
			session_unset();
			session_destroy();
			header("location: ../index.php?log=out");
			//echo "logout";
		}
	}
	else
	{
		header("location: ../index.php");
	}
}

?>