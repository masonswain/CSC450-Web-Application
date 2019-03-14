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
	<div id="login">
		
		<?php
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				//POST Data assignment
				$ticketID=$_POST['ticketID'];
				$ticketTitle=$_POST['ticketTitle'];
				$techUN=$_POST['techUN'];
				$userUN=$_POST['userUN'];
				$status=$_POST['status'];
				$building=$_POST['building'];
				$room=$_POST['room'];
				$phone=$_POST['phone'];

				
				
			}
			
			/*
			$ticketID="123456712";
			$techUN="jknutson";
			$userUN="dsager";
			$status="active";
			$building="kaposia";
			$room="S21";
			$phone="6452";
			*/
			
			//DB CONNECTION CREDENTIALS
			$servername = "joelknutson.net";
			$username = "joelknut_csc450";
			$pw = "CSP@2019";
			$dbName = "joelknut_csc450";

			//BUILD CONNECTION STRING
			//$conn = new mysqli($servername, $username, $pw, $dbName);
			$conn = mysqli_connect($servername, $username, $pw, $dbName);

			//TRY CONNECTION
			if($conn->connect_error){

				die("Connection failed: ".$dbConn->connect_error);
			}
			
			$sql = "INSERT INTO TICKET (TICKET_ID, TICKET_TITLE, TECH_UN, USER_UN, STATUS, BUILDING, ROOM, PHONE) VALUES ('$ticketID', '$ticketTitle', '$techUN', '$userUN', '$status', '$building', '$room', '$phone')";
			$result = mysqli_query($conn, $sql);				
			if ($result) {
				echo "New ticket: ".$ticketID." made by ".$userUN." created successfully";
				echo "<br>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();

	?>
		
	</div>
	
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>