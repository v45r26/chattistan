<!DOCTYPE html>
<html>
<head>
	<title>CHATTISTAN - Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/login_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="wrapper">
	<section class="form login">
		<header>CHATTISTAN</header>
		<form class="login-form" action="#">
			<div class="error-txt">This is an error message!</div>
			<div class="field input-box">
				<label>Username</label>
				<input type="text" class="input-field" name="user-name" required>
			</div>
			<div class="field input-box">
				<label>Password</label>
				<input type="password" class="input-field" id="input-passwrd_0" name="password" required>
				<i class="fas fa-eye" id="tglBtn_0"></i>
			</div>
			<div class="field button">
				<input type="submit" value="Login">
			</div>
		</form>
		<div class="link">Not yet a member? <a href="signup.php">Signup</a></div>

	</section>
</div>


<script src="../js/login-pass-s-h.js" type="text/javascript"></script>
<script src="../js/login_js.js" type="text/javascript"></script>
</body>
</html>