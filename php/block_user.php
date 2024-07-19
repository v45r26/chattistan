<?php 
session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

include_once 'config.php';

$unique_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if (mysqli_num_rows($sql) != 1) 
{
	header('location: ../account/login.php');
}

if (isset($_GET['b_uid'])) 
{
	$b_uid = mysqli_real_escape_string($conn, $_GET['b_uid']);

	$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$b_uid}'");
	if ($sql2) 
	{	
		if (mysqli_num_rows($sql2) == 1) 
		{
			$sql3 = mysqli_query($conn, "SELECT * FROM `block_user` WHERE `my_u_id` = '{$unique_id}' AND `block_u_id` = '{$b_uid}'");
			if ($sql3) 
			{
				if (mysqli_num_rows($sql3) > 0) 
				{
					$sql4 = mysqli_query($conn, "DELETE FROM `block_user` WHERE `my_u_id` = '{$unique_id}' AND `block_u_id` = '{$b_uid}'");
					if ($sql4) 
					{
						echo "unblocked";
					}
					
				}
				else 
				{
					$sql5 = mysqli_query($conn, "INSERT INTO block_user (`my_u_id`, `block_u_id`) VALUES ('{$unique_id}', '{$b_uid}')");
					if ($sql5) 
					{
						echo "blocked";
					}
				}
			}
		}
		else
		{
			echo "User does't exist!";
		}
	}
	// echo "$unique_id - want's to block $b_uid";
}
else 
{
	echo "Something went wrong!";
}

?>