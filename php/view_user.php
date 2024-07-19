<?php

session_start();
if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}
include_once 'config.php';

$my_uid = $_SESSION['unique_id'];
$output = "";
if (isset($_GET['fltr'])) 
{
	if ($_GET['fltr'] == 'gen') 
	{
		$sql = mysqli_query($conn, "SELECT * FROM `followers_t` WHERE `my_unique_id` = '{$my_uid}'");
		if (mysqli_num_rows($sql) > 0) 
		{
			while ($row = mysqli_fetch_assoc($sql)) 
			{
				$d_g_id = $row['follower_id'];
				$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$my_uid} AND unique_id = '{$d_g_id}'");
				if (mysqli_num_rows($sql2) > 0) 
				{
					while($row = mysqli_fetch_assoc($sql2))
					{
						$user_unique_id = $row['unique_id'];
						$prof_pic = $row['prof_pic'];

						if ($prof_pic == '') 
						{
							$prof_pic = 'common_chatti_img.jpg';
						}

						$sql3 = mysqli_query($conn, "SELECT * FROM following_t WHERE my_unique_id = '{$my_uid}' AND followed_by_me = '{$d_g_id}'");
						if (mysqli_num_rows($sql3) == 1) 
						{
							$output .= '<a class="ul-a '.$row['status'].'">
								<div class="ul-content" onclick="self.frames['."'file_op'".'].location.href = '."'if_data/view_profile.php?v_pro=$user_unique_id'".'">
									<img src="uploaded_img/'.$prof_pic.'">
									<div class="ul-c-details">
										<span title="'.$row['user_name'].'">'.$row['user_name'].'</span>
										<p>No message Available</p>
									</div>
								</div>
								<div class="btn-box">
 									<button onclick="self.frames['."'file_op'".'].location.href = '."'if_data/chat_page.php?v_pro=$user_unique_id'".'" title="Start Chat" class="clc_btn">
 									<i class="fas fa-comment-dots"></i>
 									</button>
 								</div>	
							</a>';
						}
						else
						{
							$output .= '<a class="ul-a '.$row['status'].'">
								<div class="ul-content" onclick="self.frames['."'file_op'".'].location.href = '."'if_data/view_profile.php?v_pro=$user_unique_id'".'">
									<img src="uploaded_img/'.$prof_pic.'">
									<div class="ul-c-details">
										<span title="'.$row['user_name'].'">'.$row['user_name'].'</span>
										<p>No message Available</p>
									</div>
								</div>
								<div class="btn-box">
 									<button onclick="self.frames['."'file_op'".'].location.href = '."'if_data/chat_page.php?v_pro=$user_unique_id'".'" title="Start Chat" class="clc_btn">
 										<i class="fas fa-comment-dots"></i>
 									</button>
	 								<button class="clc_btn follow" type="submit" onclick="inc_follow_m(this)" 	value="'.$user_unique_id.'" title="Follow">
 										<i class="fas fa-plus"></i>
 									</button>
 								</div>	
							</a>';
						}
					}
				}
			}
		}
		else
		{
			echo "Search and follow to chat";
		}
		echo $output;
	}
	elseif ($_GET['fltr'] == 'frnd') 
	{
		$sql = mysqli_query($conn, "SELECT * FROM `following_t` WHERE `my_unique_id` = '{$my_uid}'");
		if (mysqli_num_rows($sql) > 0) 
		{
			while ($row = mysqli_fetch_assoc($sql)) 
			{
				$d_g_id = $row['followed_by_me'];
				$sql2 = mysqli_query($conn, "SELECT * FROM followers_t WHERE follower_id = '{$my_uid}' AND my_unique_id = '{$d_g_id}'");
				if (mysqli_num_rows($sql2) ==1) 
				{
					$sql3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$d_g_id}'");
					if (mysqli_num_rows($sql3) ==1) 
					{
						$row2 = mysqli_fetch_assoc($sql3);
						$user_unique_id = $row2['unique_id'];
						$prof_pic = $row2['prof_pic'];

						if ($prof_pic == '') 
						{
							$prof_pic = 'common_chatti_img.jpg';
						}

						$output .= '<a class="ul-a '.$row2['status'].'">
								<div class="ul-content" onclick="self.frames['."'file_op'".'].location.href = '."'if_data/view_profile.php?v_pro=$user_unique_id'".'">
									<img src="uploaded_img/'.$prof_pic.'">
									<div class="ul-c-details">
										<span title="'.$row2['user_name'].'">'.$row2['user_name'].'</span>
										<p>No message Available</p>
									</div>
								</div>
								<div class="btn-box">
 									<button onclick="self.frames['."'file_op'".'].location.href = '."'if_data/chat_page.php?v_pro=$user_unique_id'".'" title="Start Chat" class="clc_btn">
 										<i class="fas fa-comment-dots"></i>
 									</button>
 								</div>	
							</a>';
					}
				}
			}
		}
		else
		{
			echo "Search and follow to chat";
		}
		echo $output;
	}
	else
	{
		echo "Something went Wrong!";
	}
}

?>