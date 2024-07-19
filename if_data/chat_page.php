<?php
session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}

include_once '../php/config.php';

$logged_uid = $_SESSION['unique_id'];

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

		// let's check the user is block or not
		$sql2 = mysqli_query($conn, "SELECT * FROM `block_user` WHERE `my_u_id` = '{$logged_uid}' AND `block_u_id` = '{$c_uid}'");
		if ($sql2) 
		{
			if (mysqli_num_rows($sql2) > 0) 
			{
				$block_sec = 'Unblock';
			}
			else
			{
				$block_sec = 'Block';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/chat_frame.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="c_container">
		<header><img src="../uploaded_img/<?php echo $prof_pic; ?>" alt="profile_pic"> <?php echo $user_name; ?> <i class="fas fa-ellipsis-v" id="i_op"></i></header>

		<div class="chat-box">
			
			<!-- <div class="chat outgoing">
				<div class="details">
					<p>Hii helo</p>
				</div>
			</div>



			<div class="chat incoming">
				<div class="details">
					<p>Hii helo</p>
				</div>
			</div> -->

		</div>
		
		<div class="bott-box">
			<form>
				<input type="hidden" name="outgoing_id" value="<?php echo $logged_uid; ?>">
				<input type="hidden" name="incoming_id" value="<?php echo $c_uid; ?>">
				<input type="text" name="message" id="inputField">
				<button><i class="fab fa-telegram-plane"></i></button>
			</form>
		</div>

		<div id="more_menu">
			<div class="more_menu" id="m_m_h">
				<button class="more_menu_op" title="Pin">Pin</button>
				<button class="more_menu_op" title="Block" onclick="block_user()" value="<?php echo $c_uid; ?>" id="scc"><?php echo $block_sec; ?></button>
				<button class="more_menu_op" id="op_report" title="Report">Report</button>
			</div>
		</div>

		<i class="fas fa-angle-double-down" id="go_t_B" title="Go to Bottom"></i>

		<div class="report-container" id="report-container">
			<header class="r-header">Report user</header>
			<form id="r_form">
				<div class="report_menu">
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						It's spam or scam
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						Abusive content
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						It's  inappropriate
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						Self inury
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						Harashment or bullying
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						Sale or promotion of drugs
					</label>
					<label class="check_box_box">
						<input type="checkbox" name="report_t">
						Nudity or pornography
					</label>
					<label class="check_box_box" id="check" id="check">
						<input type="checkbox" name="report_t">
						Other...
					</label>
				</div>
				<div class="oth-rep-input" id="d_r_i">
					<textarea class="oth-rep-input_i" spellcheck="false"></textarea>
				</div>
				<div class="r_bottom">
					<button type="button" id="cancel_r">cancel</button>
					<button type="submit" id="r_sub">Submit</button>
				</div>
			</form>
		</div>

		

<?php

if ($block_sec == 'Unblock') {
	echo '
		<div class="unblock_c">
			Unblock to chat
		</div>';
}

?>
			</div>
<script type="text/javascript">
const i_op = document.querySelector('#i_op'),
	  more_menu  = document.querySelector('#more_menu'),
	  m_m_h = document.querySelector('#m_m_h');

more_menu.style.display = "none";
m_m_h.style.height = "0px";

i_op.onclick = ()=>
{
	if (more_menu.style.display == "block") 
	{
		more_menu.style.display = "none";
		m_m_h.style.height = "0px";
	}
	else
	{
		more_menu.style.display = "block";
		m_m_h.style.height = "auto";
	}
}
// report-container display script 
	const r_cont = document.querySelector('#report-container'),
		cancel_r = document.querySelector('#cancel_r'),
		op_report = document.querySelector('#op_report');

r_cont.style.display = "none";

op_report.onclick = ()=>
{
	r_cont.style.display = "block";
}
cancel_r.onclick = ()=>
{
	r_cont.style.display = "none";
}

var check = document.querySelector('#check'),
    d_r_i = document.querySelector('#d_r_i');
d_r_i.style.display='none';
check.onclick = ()=>
{
	
	if (d_r_i.style.display == 'none') 
	{
		d_r_i.style.display = 'block';
	}

}
// check.onclick =() =>
// {
// 	if (d_r_i.style.display == 'none') 
// 	{
// 		d_r_i.style.display = 'block';
// 	}
// 	else
// 	{
// 		d_r_i.style.display = 'none';
// 	}
// }
</script>
<script src="../js/get_chat_js.js" type="text/javascript"></script>
<script src="../js/block_user.js" type="text/javascript"></script>
<script src="../js/report_js.js" type="text/javascript"></script>
</body>
</html>
<!-- like - <i class="far fa-thumbs-up"></i>
liked - <i class="fas fa-thumbs-up"></i>

report - <i class="far fa-flag"></i>
reported - <i class="fas fa-flag"></i

theme - <i class="fas fa-adjust"></i> -->