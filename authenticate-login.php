<?php
session_start();
$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";
$conn = new mysqli($servername, $username, $pw, $dbName);
$user=$_POST['un'];
$authpw=$_POST['authpw'];
?>
<!doctype html>
<html lang="en">
<head>
	<title>South St. Paul Technology - Authenticate Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="login">
<?php
if (isset($_POST['un']) && isset($_POST['authpw']) ) {
	if($conn->connect_error){
		die("Connection failed: ".$dbConn->connect_error);
	}
	// authentication 
	$sql = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='$user' AND PASSWORD='$authpw'";
	$result=$conn->query($sql);

	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			// setup session
			$_SESSION["currentUser"] = $user;
			

			

			$_SESSION['status'] = "Active";
			$name = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='$user'";
			$resultOfQuery = mysqli_query($conn, $name);

			if (mysqli_num_rows($resultOfQuery) > 0) {
				$data = mysqli_fetch_array($resultOfQuery);
				$_SESSION['currentFirstName'] = $data['FNAME'];
				$_SESSION["currentLastName"] = $data['LNAME'];
			}
			echo "<script>location.href='home.php';</script>";
		}
	} else {
		echo "Login failed.  Double check your username and password.";
		echo "<br><br>";
		echo '<button type="button" class="button" onclick="';
		echo "location.href='/web/index.php'";
		echo '">Try again.</button>';
	}
	$conn->close();
}
?>
</div>
</body>
</html>
