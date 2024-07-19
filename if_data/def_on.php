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
	<link rel="stylesheet" type="text/css" href="../css/def_on.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="m-box-if-d">

		<img src="../uploaded_img/<?php echo $prof_pic; ?>" class="p-b-f-img">
		
		<div class="p-b-f-un-rn">
			<span class="p-b-f-user-name"><?php echo $user_name; ?></span>
			<span class="p-b-f-real-name"><?php echo $o_name; ?></span>
		</div>


		<div class="p-b-f-f-l-f">
			<div class="p-b-f-f-l-f-data">
				<span class="p-b-f-f-l-f-data-bold"><?php echo $like_c ; ?></span>
				<span class="p-b-f-f-l-f-data-h">Like</span>
			</div>
			<div class="p-b-f-f-l-f-data">
				<span class="p-b-f-f-l-f-data-bold"><?php echo $followers_c; ?></span>
				<span class="p-b-f-f-l-f-data-h">Followers</span>
			</div>
			<div class="p-b-f-f-l-f-data">
				<span class="p-b-f-f-l-f-data-bold"><?php echo $following_c; ?></span>
				<span class="p-b-f-f-l-f-data-h">Following</span>
			</div>
		</div>


	<div class="p-b-f-bio"><?php echo $bio; ?></div>

	<div class="copyRight"><i class="fas fa-copyright"></i> 2021 - 2021 | CHATISTAN</div>
</div>

</body>
</html>

