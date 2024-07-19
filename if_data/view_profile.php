<?php
session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

include_once '../php/config.php';



if (isset($_GET['v_pro'])) 
{
	$c_uid = $_GET['v_pro'];
	$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `unique_id` = '{$c_uid}'");
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
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/view_pro_page.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="c_container">
		<header><i class="fas fa-arrow-left"></i> <img src="../uploaded_img/<?php echo $prof_pic; ?>" alt="profile_pic"> <?php echo $user_name; ?></header>
	</div>
</body>
</html>