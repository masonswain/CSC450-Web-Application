<?php
session_start();
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
	<div id="login">
		
		<?php
			$user=$_POST['un'];
			$authpw=$_POST['authpw'];

			// creating session variable
			$_SESSION["currentUser"] = $user;

			$servername = "joelknutson.net";
			$username = "joelknut_csc450";
			$pw = "CSP@2019";
			$dbName = "joelknut_csc450";

			$conn = new mysqli($servername, $username, $pw, $dbName);

			if($conn->connect_error){

				die("Connection failed: ".$dbConn->connect_error);
			}
			//echo "Connection successful<br/>";
			//echo "username is ".$user;

			$sql = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='".$user."' AND PASSWORD=".$authpw;
			$result=$conn->query($sql);

			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					header("Location:home.php");
					echo "New user: ".$fname." ".$lname." created successfully";
				}
			} else {
				echo "Authentication Failed";
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