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
		
			//INCOMING POST DATA
			$techUN=$_POST['techUN'];
			$status=$_POST['status'];
			
			//USED FOR TESTING
			/*
			$techUN="jknutson";
			$status="Active";
			*/
			
			//SERVER CONNECTION CREDENTIALS
			$servername = "joelknutson.net";
			$username = "joelknut_csc450";
			$pw = "CSP@2019";
			$dbName = "joelknut_csc450";

			//BUILD CONNECTION STRING
			$conn = new mysqli($servername, $username, $pw, $dbName);

			//TRY CONNECTION
			if($conn->connect_error){

				die("Connection failed: ".$dbConn->connect_error);
			}
			
			//BUILD QUERY STRING
			$sql = "SELECT * FROM TICKET WHERE TECH_UN='".$techUN."' AND STATUS='".$status."'";

			//ASSIGN DATA TO ARRAY
			$result=$conn->query($sql);			
			
			//PARSE ARRAY AND DISPLAY DATA
			//
			echo "Tickets";
			echo "<br/>";
			echo "-------------------------------";
			echo "<br/>";
			
			if ($result->num_rows > 0){
					
				while($row = $result->fetch_assoc()){

					echo "<a href=\"return-ticket-notes.php?ticketID=".$row["TICKET_ID"]."\">";
					echo "Ticket ID:  ";
					echo $row["TICKET_ID"];
					echo "<br/>";
					echo "Title:  ";
					echo $row["TICKET_TITLE"];
					echo "<br/>";
					echo "Status:  ";
					echo $row["STATUS"];
					echo "<br/>";
					echo "End User:  ";
					echo $row["USER_UN"];
					echo "<br/>";
					echo "-------------------------------";
					echo "</a>";
					echo "<br/>";
					
				}

			} else{
				echo "** No Tickets Found **".$conn->error;
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