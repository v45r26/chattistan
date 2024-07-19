<?php

session_start();

if (!isset($_SESSION['unique_id'])) 
{
	//header("location : login.php");
	// echo "<script>location = 'login.php';</script>";
	header('location: account/login.php');
}

include_once 'php/config.php';

$unique_id = $_SESSION['unique_id'];

$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id` = '{$unique_id}'");
if (mysqli_num_rows($sql) == 1) 
{
	$row = mysqli_fetch_assoc($sql);
	$user_name = $row['user_name'];
	// $o_name = $row['name'];
	$prof_pic = $row['prof_pic'];
	// $bio = $row['bio'];
	// $like_c = $row['like_count'];
	// $followers_c= $row['followers_count'];
	// $following_c = $row['following_count'];

	if ($prof_pic == "") 
	{
		$prof_pic = 'common_chatti_img.jpg';
	}
}
else
{
	// user has wrong unique_id which is not exist
	header('location: account/login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CHATTISTAN</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--	<link rel="stylesheet" type="text/css" href="font/fontawesome-free-5.13.1-web/css/all.min.css">-->
</head>
<body>

<div class="wrapper">
	<section class="top-sec">
		<a href="index.php" class="logo-txt">CHATTISTAN</a>
		<div class="prof-btn" id="prof-btn">
			<img src="uploaded_img/<?php echo $prof_pic;?>" class="prof-img">
			<div class="prof-user-name"><?php echo $user_name; ?></div>
		</div>
	</section>

	<section class="mid-sec">
		<div class="mid-wrapper">
			
			<div class="search-box-field">
				<div class="s-b-f">
					<input type="text" class="s-b-f-s-bar" id="searchBar" placeholder="Enter name to search...">
					<div class="f-btn-box">
						<button class="" id="gen_btn" onclick="fltr_gen()">General</button>
						<button class="stop" id="frnd_btn" onclick="fltr_frnd()">Friends</button>
					</div>
				</div>
				<div class="s-b-user-list" id="userList">
				
				</div>
			</div>

			<iframe src="if_data/def_on.php" name="file_op" class="iframe_container"></iframe>

		</div>
	</section>

	<section class="bottom-sec">
		<div class="res-success-fail">
			<i class="fas fa-angle-double-right"></i><i class="fas fa-angle-right" style="margin-left: -2px"></i>
				<!--- Success! Failed! Error Loding... --->
				<span>Loding...</span>
		</div>
		<table class="bot-tab" cellspacing="0">
			<tr>
				<td title="Your status: Online"><i class="fas fa-circle onl_off_status offline"></i></td>
				<td  id="d_dis" title="Date"><i class="far fa-calendar-alt"></i></td>
				<td id="t_dis" title="Time"><i class="fas fa-clock"></i></td>
				<td title="Setting"><i class="fas fa-cog"></i></td>
				<td title="Logout" onclick="location = 'account/logout.php?logout_id=<?php echo $unique_id; ?>';"><i class="fas fa-sign-out-alt"></i></td>
				<td>LANG</td>
			</tr>
		</table>
	</section>

	<div class="profile-box-tgl" id="profile-box-tgl">
		<div class="d_d_content">
			<span class="d_d_btn" onclick="location = 'more_page/myProfile.php';">Profile</span>
			<span class="d_d_btn">Account</span>
			<!-- <span class="d_d_btn">Chat History</span> -->
			<span class="d_d_btn">Setting</span>
			<span class="d_d_btn" onclick="location = 'account/logout.php?logout_id=<?php echo $unique_id; ?>';">Logout</span>
		</div>
	</div>
	<div class="d_date_block" id="d_date_block"></div><!--- Date Block --->
	<div class="d_time_block" id="d_time_block"></div><!--- Time Block --->	

</div>
<div id="loder1">loding...</div>
<script>
	window.onload = function () 
	{
		document.getElementById('loder1').style.display = "none";
		document.querySelector('.wrapper').style.display = "block";
	}
</script>
<script src="js/com_js.js" type="text/javascript"></script>
<script src="js/intrnet_cnn.js" type="text/javascript"></script>
<script src="js/c_date_time.js" type="text/javascript"></script>
<script src="js/searchUser_js.js" type="text/javascript"></script>
<script src="js/following_a_js.js" type="text/javascript"></script>
<script src="js/view_my_following.js" type="text/javascript"></script>
</body>
</html>