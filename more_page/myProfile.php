<?php

session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

include_once '../php/config.php';

$unique_id = $_SESSION['unique_id'];

$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id` = '{$unique_id}'");
if (mysqli_num_rows($sql) == 1) 
{
	$row = mysqli_fetch_assoc($sql);
	$user_name = $row['user_name'];
	$o_name = $row['name'];
	$prof_pic = $row['prof_pic'];
	$bio = $row['bio'];
	$like_c = $row['like_count'];
	$followers_c= $row['followers_count'];
	$following_c = $row['following_count'];

	if ($prof_pic == "") 
	{
		$prof_pic = 'common_chatti_img.jpg';
	}
}
else
{
	// user has wrong unique_id which is not exist
	header('location: ../account/login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CHATTISTAN</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/myprofile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--	<link rel="stylesheet" type="text/css" href="../font/fontawesome-free-5.13.1-web/css/all.min.css">-->
</head>
<body>

<div class="wrapper">
	<section class="top-sec">
		<a href="../index.php" class="logo-txt">CHATTISTAN</a>
		<div class="prof-btn" id="prof-btn">
			<img src="../uploaded_img/<?php echo $prof_pic;?>" class="prof-img">
			<div class="prof-user-name"><?php echo $user_name; ?></div>
		</div>
	</section>

	<section class="mid-sec">
		<div class="mid-wrapper">
			<iframe src="../if_data/if_myprofile.php" class="left-frame" id="i-frame">cssc</iframe>
			<div class="right-frame">
				<div class="edit-form-box">
					<header>Edit Profile</header>

					<div class="image-changer">
						
						<div class="img-wrapper">
        					<div class="image">
	        					<img src="../uploaded_img/<?php echo $prof_pic;?>" alt="">
        					</div>
							<div class="content">
        						<div class="icon">
									<i class="fas fa-cloud-upload-alt"></i>
								</div>
								<div class="text">No file chosen, yet!</div>
							</div>
							<div id="cancel-btn">
								<i class="fas fa-times"></i>
							</div>
							<div id="add-btn" onclick="defaultBtnActive()">
								<i class="fas fa-camera"></i>
							</div>
						</div>
						<input id="default-btn" type="file" hidden>
					</div>
					
					<form action="#">
						<div class="input-box">
							<label>Username</label>
							<input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter Username..." required="">
						</div>
						<div class="input-box">
							<label>Name</label>
							<input type="text" name="o_name" value="<?php echo $o_name; ?>" placeholder="Enter Name..." required="">
						</div>
						<div class="input-box">
							<label>Image</label>
							<input type="file" name="f_img">
						</div>
						<div class="input-box">
							<label>Bio</label>
							<textarea placeholder="Boi..." name="e_bio"><?php echo $bio; ?></textarea>
						</div>
						<div class="input-box">
							<button id="subBtn">Save Changes</button>
						</div>
					</form>
				</div>
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
				<td title="Logout" onclick="location = '../account/logout.php?logout_id=<?php echo $unique_id; ?>';"><i class="fas fa-sign-out-alt"></i></td>
				<td>LANG</td>
			</tr>
		</table>
	</section>

	<div class="profile-box-tgl" id="profile-box-tgl">
		<div class="d_d_content">
			<span class="d_d_btn" onclick="location = '../index.php';">Home</span>
			<span class="d_d_btn">Account</span>
			<!-- <span class="d_d_btn">Chat History</span> -->
			<span class="d_d_btn">Setting</span>
			<span class="d_d_btn" onclick="location = '../account/logout.php?logout_id=<?php echo $unique_id; ?>';">Logout</span>
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
<script src="../js/com_js.js" type="text/javascript"></script>
<script src="../js/intrnet_cnn.js" type="text/javascript"></script>
<script src="../js/c_date_time.js" type="text/javascript"></script>
<script src="../js/edit-profile.js" type="text/javascript"></script>
</body>
</html>