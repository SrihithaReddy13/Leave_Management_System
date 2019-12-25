<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" type='text/css' href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/loginregt.js"></script>
</head>
<body>
	<h1 id="h1lin"><u>Leave Management System</u></h1>
	<h2 id="h2lin">Team Zenith</h2>
	<div id="btns">
		<h1>Welcome!</h1>
		<button type="button" id="linbtn" class="linregbtn" autofocus>Login</button>
		<button type="button" id="regbtn" class="linregbtn">Register</button>
	</div>  
	<div id='linform'>
		<form class="box" id="loginform" action="linprocess.php" method="POST">
			<h1>Login</h1>
			<input type="text" id='user' name="user" placeholder="Username">	
			<input type="password" id=pass name="pass" placeholder="Password">
			<input type="submit" id='sublinbtn' value="Login">
		</form>
	</div>
	<div id='regform'>
		<form class="box" id="regform" action="regnew.php" method="POST">
			<h1>Register</h1>
			<input type="submit" id="subregbtn" value="Click here to go to the Registration Page">
		</form>
	</div>

</body>
</html>