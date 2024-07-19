<?php

session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

include_once 'config.php';

$unique_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if (mysqli_num_rows($sql) == 1) {
	$row = mysqli_fetch_assoc($sql);
	$d_user_name = $row['user_name']; 
	$d_img = $row['prof_pic'];
}
else
{
	header('location: ../account/login.php');
}

$username = mysqli_real_escape_string($conn, $_POST['user_name']);
$o_name = mysqli_real_escape_string($conn, $_POST['o_name']);
$e_bio = mysqli_real_escape_string($conn, $_POST['e_bio']);

if (!empty($username) && !empty($o_name) && !empty($e_bio)) 
{
	if ($d_user_name == $username) 
	{
		if (isset($_FILES['f_img'])) 
		{
			$img_name = $_FILES['f_img']['name'];
			$img_type = $_FILES['f_img']['type'];
			$tmp_name = $_FILES['f_img']['tmp_name'];

			if (empty($img_name) && empty($img_type) && empty($tmp_name)) 
			{
				$img = $d_img;
			}
			else
			{
				// let'd explode the image and get the extension like png,jpg,jpeg
				$img_explode = explode('.', $img_name);
				$img_ext = end($img_explode);
				$extension = ['png','jpg','jpeg']; // these are some valid image extension that we are store hem in array
				if (in_array($img_ext, $extension) === true)
				{
					$time = time();
					$img  = $time.$img_name;

					if(move_uploaded_file($tmp_name, '../uploaded_img/'.$img))
					{
						$sql3 = mysqli_query($conn, "UPDATE `users` SET `user_name`='{$username}',`name`='{$o_name}',`prof_pic`='{$img}',`bio`='{$e_bio}' WHERE unique_id = '{$unique_id}'");
						if ($sql3) 
						{
							echo "success";
						}
						else
						{
							echo "Something went wrong!";
						}
					}
					else
					{
						echo "Unable to upload!";
					}
				}
				else
				{
					echo "Please select an Image file - png, jpg, jpeg!";
				}
			}
		}
	}
	else
	{
		$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '{$username}'");
		if (mysqli_num_rows($sql2)  > 0)
		{
			echo "Username already exist";
		}
		else
		{
			if (isset($_FILES['f_img'])) 
			{
				$img_name = $_FILES['f_img']['name'];
				$img_type = $_FILES['f_img']['type'];
				$tmp_name = $_FILES['f_img']['tmp_name'];

				if (empty($img_name) && empty($img_type) && empty($tmp_name)) 
				{
					$img = $d_img;
				}
				else
				{
					// let'd explode the image and get the extension like png,jpg,jpeg
					$img_explode = explode('.', $img_name);
					$img_ext = end($img_explode);

					$extension = ['png','jpg','jpeg']; // these are some valid image extension that we are store them in array
					if (in_array($img_ext, $extension) === true)
					{
						$time = time();
						$img  = $time.$img_name;

						if(move_uploaded_file($tmp_name, '../uploaded_img/'.$img))
						{
							$sql3 = mysqli_query($conn, "UPDATE `users` SET `user_name`='{$username}',`name`='{$o_name}',`prof_pic`='{$img}',`bio`='{$e_bio}' WHERE unique_id = '{$unique_id}'");
							if ($sql3) 
							{
								echo "success";
							}
							else
							{
								echo "Something went wrong!";
							}
						}
						else
						{
							echo "Unable to upload!";
						}
					}
					else
					{
						echo "Please select an Image file - png, jpg, jpeg!";
					}
				}
			}
		}
	}
	
}
else
{
	echo "Please fill All the Field!";
}
?>