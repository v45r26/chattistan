<?php

include_once 'config.php';

$user_name = mysqli_real_escape_string($conn, $_POST['user-name']);
$o_name = mysqli_real_escape_string($conn, $_POST['o-name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

$date = date("dmY");
$time = date("his");
$unique_id = rand(0,9).$date.$time.rand(0,99);

// echo "$user_name - $o_name - $password - $c_password";

if (!empty($user_name) && !empty($o_name) && !empty($password) && !empty($c_password)) 
{
	// let's check that user_name is exist or not
	$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_name` = '{$user_name}'");
	if (mysqli_num_rows($sql) > 0) 
	{
		echo "$user_name - This username alreay exist!";
	}
	else
	{
		if (strlen($password) < 8) 
		{
			echo "Password must be contain atleast 8 character!";
		}
		else
		{
			if (strlen($c_password) < 8)
			{
				echo "Password must be contain atleast 8 character!";
			}
			else
			{
				if ($password === $c_password) 
				{
					$sql2 = mysqli_query($conn, "INSERT INTO `users`(`unique_id`, `user_name`, `name`, `password`) VALUES ('{$unique_id}','{$user_name}','{$o_name}','{$password}')");
					if ($sql2) 
					{
						echo "success";
					}
					else
					{
						echo "Something went worng!";
					}
				}
				else
				{
					echo "Password not match!";
				}
			}
		}
	}
}
else
{
	echo "All input field are required!";
}
?>