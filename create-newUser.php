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
				$fname=$_POST['fname'];
				$lname=$_POST['lname'];
				$uname=$_POST['uname'];
				$authpw=$_POST['authpw'];
			}
						
			//USED FOR TESTING
			/*
			$fname="John";
			$lname="Deere";
			$uname="jdeere";
			$authpw="12345";
			$isadmin="Y";
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
			
			//BUILD QUERY STRING
			$sql = "INSERT INTO USER (FNAME, LNAME, USERNAME, PASSWORD, ADMIN) VALUES ('$fname', '$lname', '$uname', '$authpw', 'N')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "New user: ".$fname." ".$lname." created successfully";
				echo "<br><br>";
				echo '<button type="button" class="button" onclick="';
				echo "location.href='index.html'";
				echo '">Login</button>';
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			/*	
			//TRY CONNECTION
			if ($conn->query($sql) === TRUE) {
			echo "New user: ".$fname." ".$lname." created successfully";
			//echo '<button type="button" class="button" onclick="location.href='home.html'>Home</button>';
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			*/

			$conn->close();

	?>
		
	</div>
	
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>