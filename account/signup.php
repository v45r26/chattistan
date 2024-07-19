<!DOCTYPE html>
<html>
<head>
	<title>CHATTISTAN - Signup</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/login_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="wrapper">
	<section class="form signup">
		<header>CHATTISTAN</header>
		<form class="sign-up-form" action="#">
			<div class="error-txt">This is an error message!</div>
			<div class="field input-box">
				<label>Username</label>
				<input type="text" class="input-field" name="user-name" required>
			</div>
			<div class="field input-box">
				<label>Name</label>
				<input type="text" class="input-field" name="o-name" required>
			</div>
			<div class="field input-box">
				<label>Password</label>
				<input type="password" class="input-field" id="input-passwrd_0" name="password" required>
				<i class="fas fa-eye" id="tglBtn_0"></i>
			</div>
			<div class="field input-box">
				<label>Confirm Password</label>
				<input type="password" class="input-field" id="input-passwrd_1" name="c_password" required>
				<i class="fas fa-eye" id="tglBtn_1"></i>
			</div>
			<div class="field button">
				<input type="submit" value="Signup">
			</div>
		</form>
		<div class="link">Already a member? <a href="login.php">Login</a></div>

	</section>
</div>


<script src="../js/signup-pass-s-h.js" type="text/javascript"></script>
<script src="../js/signup_js.js" type="text/javascript"></script>
</body>
</html>