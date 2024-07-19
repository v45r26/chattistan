<?php

session_start();
include_once 'config.php';

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}


$outgoing_id = $_SESSION['unique_id'];

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
// echo $searchTerm;
$output = "";

if (strlen($searchTerm) > 0)
{
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (user_name LIKE '%{$searchTerm}%')");
	if (mysqli_num_rows($sql) > 0) 
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$user_unique_id = $row['unique_id'];
			$prof_pic = $row['prof_pic'];

			if ($prof_pic == '') 
			{
				$prof_pic = 'common_chatti_img.jpg';
			}

			$sql2 = mysqli_query($conn, "SELECT * FROM following_t WHERE my_unique_id = '{$outgoing_id}' AND followed_by_me = '{$user_unique_id}'");
			if (mysqli_num_rows($sql2) == 1) 
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
 							<button class="clc_btn follow" type="submit" onclick="inc_follow_m(this)" value="'.$user_unique_id.'" title="Follow">
 								<i class="fas fa-plus"></i>
 							</button>
 						</div>	
					</a>';
			}
		}
	}
	else
	{
		$output .= "No user found!";
	}
}
echo $output;
?>