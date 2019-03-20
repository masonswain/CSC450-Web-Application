<?php
// creating session
session_start();

$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";
$conn = new mysqli($servername, $username, $pw, $dbName);

$user=$_POST['un'];
$authpw=$_POST['authpw'];
$_SESSION["currentUser"] = $user;
$name = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='$user'";
$resultOfQuery = mysqli_query($conn, $name);

if (mysqli_num_rows($resultOfQuery) > 0) {
	$data = mysqli_fetch_array($resultOfQuery);

	$_SESSION['currentFirstName'] = $data['FNAME'];
	$_SESSION["currentLastName"] = $data['LNAME'];
}
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
			if($conn->connect_error){

				die("Connection failed: ".$dbConn->connect_error);
			}

			// authentication 
			$sql = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='".$user."' AND PASSWORD=".$authpw;
			$result=$conn->query($sql);

			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					header("Location:home.php");
				}
			} else {
				echo "Login failed.  Double check your username and password.";
				echo "<br><br>";
				echo '<button type="button" class="button" onclick="';
				echo "location.href='index.html'";
				echo '">Try again.</button>';
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