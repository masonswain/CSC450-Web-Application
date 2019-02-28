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
			$ticketID=$_GET['ticketID'];
			
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
			
			//START TICKET INFORMATION
			/*EXAMPLE
			Ticket ID: 123456789
			Title: Synergy Login Issues
			Status: Active
			End User: mmohamed
			*/
			
			//BUILD QUERY STRING
			$sql = "SELECT * FROM TICKET WHERE TICKET_ID='".$ticketID."'";
			
			//ASSIGN DATA TO ARRAY
			$result=$conn->query($sql);			
			
			//ASSIGN DATA TO ARRAY
			if ($result->num_rows > 0){
					echo "Ticket";
					echo "<br/>";
					echo "-------------------------------";
					echo "<br/>";

				while($row = $result->fetch_assoc()){

					//return array("fname","lname");
					//echo "<a href=\"return-ticket-notes.php?".$row["TICKET_ID"]."\">";
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
					//echo "</a>";
					echo "<br/>";
					
				}

			} else{
				echo "Connection Failed".$conn->error;
			}
			//END TICKET INFORMATION
			
			//START NOTES LIST
			/*EXAMPLE
			Note From: jdeere
			2019-02-19 12:37:23
			My problem is fixed! Thank you!
			-------------------------------
			Note From: jknutson
			2019-02-19 12:37:06
			Please restart your computer.
			-------------------------------
			*/
			
			//Returns all notes for a certain ticket from newest to oldest
			$sql = "SELECT * FROM NOTE WHERE TICKET_ID='".$ticketID."' ORDER BY NOTE_ID DESC";

			$result=$conn->query($sql);
			
			echo "Notes";
			echo "<br/>";
			echo "-------------------------------";
			echo "<br/>";
				
			if ($result->num_rows > 0){

				while($row = $result->fetch_assoc()){

					echo "From:  ";
					echo $row["OWNER_UN"];
					echo "<br/>";
					echo $row["NOTE_ID"];
					echo "<br/>";
					echo $row["NOTE"];
					echo "<br/>";
					echo "-------------------------------";
					//echo "</a>";
					echo "<br/>";
					
				}

			} else{
				echo "** No Notes Found **".$conn->error;
			}
			//END NOTES LIST

			$conn->close();

	?>
		
	</div>
	
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>