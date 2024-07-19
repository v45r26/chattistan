<?php
session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}
else
{
	include_once 'config.php';

	$outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing_id']);
	$incoming_id = mysqli_real_escape_string($conn,$_POST['incoming_id']);
	$message = mysqli_real_escape_string($conn,$_POST['message']);

	if (!empty($message)) 
	{
		$sql = "INSERT INTO `messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES ('{$incoming_id}','{$outgoing_id}','{$message}')";
		$r_sql = mysqli_query($conn, $sql) or die();

	}
}
?>