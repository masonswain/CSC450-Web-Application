﻿<?php
//session_start();
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>South St. Paul Technology - Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> 

</head>

<body>

	<h2>South St Paul Technology</h2>
	<form action="authenticate-login.php" method="post">
		<div id="login">
			<input required class="form-control" name="un"  type="text" id="username" placeholder="Username"><br><br>
			<input required class="form-control" name="authpw" type="password" id="password" placeholder="Password"><br><br>
		
			<!--<a href="http://csc450.joelknutson.net/authenticate-login.php?un=jknutson&authpw=12345">-->
				<button type="submit" class="button">Login</button>
				<button type="button" class="button" onclick="location.href='newUser.html'">Create Account</button>
			<!--</a>-->
		</div>
	</form>
	
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>