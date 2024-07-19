<?php

session_start();
include_once 'config.php';

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

$my_id = $_SESSION['unique_id'];


$u_id = mysqli_real_escape_string($conn, $_GET['u_id']);

if (isset($u_id)) 
{
	if (!empty($u_id)) 
	{
		$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$u_id}'");
		if (mysqli_num_rows($sql) == 1) 
		{
			$row = mysqli_fetch_assoc($sql);// u_id data fetching
			$u_followers_count = $row['followers_count'];
			$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$my_id}'");
			if (mysqli_num_rows($sql2) == 1) 
			{
				$row2 = mysqli_fetch_assoc($sql2); // my_id data fetching
				$m_following_count = $row2['following_count'];
				$m_following_count++;

				$sql3 = mysqli_query($conn, "SELECT * FROM `following_t` WHERE `my_unique_id` = '{$my_id}' AND  `followed_by_me` = '$u_id'");
				$sql4 = mysqli_query($conn, "SELECT * FROM `followers_t` WHERE `my_unique_id` = '{$u_id}' AND `follower_id` = '{$my_id}'");
				if ((mysqli_num_rows($sql3) > 0) && (mysqli_num_rows($sql4) > 0)) 
				{
					echo "Already follow";					
				}
				else
				{

					$sql5 = mysqli_query($conn, "UPDATE `users` SET `following_count` = '{$m_following_count}' WHERE unique_id = '{$my_id}'");
					$sql6 = mysqli_query($conn, "INSERT INTO `following_t`(`my_unique_id`, `followed_by_me`) VALUES ('{$my_id}','$u_id')");

					if ($sql5 && $sql6)				 
					{
						$u_followers_count++;
						$sql7 = mysqli_query($conn, "UPDATE `users` SET `followers_count` = '{$u_followers_count}' WHERE unique_id = '{$u_id}'");
						$sql8 = mysqli_query($conn, "INSERT `followers_t`(`my_unique_id`, `follower_id`) VALUES ('$u_id','{$my_id}')");
						if ($sql7 && $sql8) 
						{
							echo "success";
						}
					}
				}
			}
			else
			{
				echo "Something went Wrong!";
			}
			
		}
		else
		{
			echo "Something went Wrong!";
		}
	}
	else 
	{
		echo "Something went Wrong!";
	}
}
else 
{
	echo "Something went Wrong!";
}

?>