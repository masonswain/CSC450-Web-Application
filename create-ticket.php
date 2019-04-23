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
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				//POST Data assignment
				$ticketTitle=$_POST['ticketTitle'];
				$techUN=$_POST['techUN'];
				$building=$_POST['building'];
				$room=$_POST['room'];
				$phone=$_POST['phone'];	
				$note=$_POST['note'];
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
			
			$sql = "INSERT INTO TICKET (TICKET_TITLE, TECH_UN, USER_UN, STATUS, BUILDING, ROOM, PHONE) VALUES ('$ticketTitle', '$techUN', '{$_SESSION['currentUser']}', 'Unassigned', '$building', '$room', '$phone')";
			$result = mysqli_query($conn, $sql);				
			if ($result) {
				echo "alert(Ticket made by $_SESSION[currentUser] created successfully);";
				echo "<br>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			//Select the Ticket ID of the most recent ticket created by user
			$sql2 = "SELECT TICKET_ID FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."' ORDER BY TICKET_ID DESC LIMIT 1";

			$result2=$conn->query($sql2);
		    $row2=$result2->fetch_assoc();
		    $ticketID=$row2["TICKET_ID"];
		    //echo "TICKET ID ".$ticketID;
			
			
            //Create Note in NOTE table
            $sql3="INSERT INTO NOTE (TICKET_ID, OWNER_UN, NOTE) VALUES ('".$ticketID."','{$_SESSION['currentUser']}','".$note."')";
			
			if ($conn->query($sql3) === TRUE) {
				echo "alert(Note created successfully);";
				header("Location: home.php");
			} 
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();

	?>
	<br><br>
	<span class="buttons">
		<div id="openTicket"><button type="button" class="button" onClick="location.href='OpenTicket.php'">Open Another Ticket</button></div>
		<div id="viewTickets"><button type="button" class="button" onClick="location.href='home.php'">Home</button></div>
	</span>	
	</div>
	
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>