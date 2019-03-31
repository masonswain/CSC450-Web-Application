<?php
session_start();
if($_SESSION['status'] != "Active") {
	header("Location: index.html");
}	
$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";
$conn = new mysqli($servername, $username, $pw, $dbName);
$sql = "SELECT COUNT(*) FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."'";
$result=$conn->query($sql);
$row = mysqli_fetch_array($result);
$tickets = $row[0];
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>South St. Paul Technology - Home Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
       <!--Test-->

<div class="logout">
	<h3>
		<?php
			echo "User: $_SESSION[currentFirstName] $_SESSION[currentLastName]";
		?>
	</h3>
	<form action="logout.php">
		<input type="submit" class="button" value="Logout"/>
	</form>
</div>

</head>
<body>

	<h1>South St Paul Technology</h1>
	
    <h2>Home</h2>
	<span class="notifications">
		<!-- The following values will be inserted from the database -->
		<div id="ticketsOpen">
		<?php
			echo $tickets;
		?>
		 Ticket(s) Open</div>
		<div id="messagesWaiting">1 Messages(s) Waiting</div>
	</span>
	<br><br>
	<span class="buttons">
		<div id="openTicket"><button type="button" class="button" onClick="location.href='OpenTicket.php'">Open Ticket</button></div>
		<div id="viewTickets"><button type="button" class="button" onClick="location.href='ViewTicket.php'">View Tickets</button></div>
	</span>

	<br><br>
	
	<div>
	<?php
			//GET TICKETS ASSIGNED TO TECH USER
			//BUILD QUERY STRING
			$sql2 = "SELECT * FROM TICKET WHERE TECH_UN='".$_SESSION['currentUser']."'";

			//ASSIGN DATA TO ARRAY
			$result=$conn->query($sql2);			
			
			//CREATE TABLE AND DISPLAY DATA
			//
			echo "<span>";
				echo "Assigned Tickets";
				echo "<table style='width:100%'>";
					echo "<tr>";
						echo "<th>Ticket #</th>";
						echo "<th>Title</th>";
						echo "<th>Status</th>";
						echo "<th>Affected User</th>";
						//if condition for no ticket scenario
						if($result->num_rows > 0){
							//while loop formats table data
							while($row = $result->fetch_assoc()){
								//ticket ID
								echo "<tr>";
									echo "<th>";
									echo $row["TICKET_ID"];
									echo "</th>";
									//title
									echo "<th>";
									echo $row["TICKET_TITLE"];
									echo "</th>";
									//status
									echo "<th>";
									echo $row["STATUS"];
									echo "</th>";
									//affected user
									echo "<th>";
									echo $row["USER_UN"];
									echo "</th>";
								echo "</tr>";
							}
						}
						//if there are no tickets found
						else {
							echo "No tickets are currently assigned to: ";
							echo $_SESSION['currentUser'].$conn->error;
						}

					echo "</tr>";
				echo "</table>";
			echo "</span>";

			//GET TICKETS ASSIGNED TO USER
			//BUILD QUERY STRING
			$sql2 = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."'";

			//ASSIGN DATA TO ARRAY
			$result=$conn->query($sql2);			
			
			//CREATE TABLE AND DISPLAY DATA
			//
			echo "<span>";
				echo "Your current Tickets";
				echo "<table style='width:100%'>";
					echo "<tr>";
						echo "<th>Ticket #</th>";
						echo "<th>Title</th>";
						echo "<th>Status</th>";
						echo "<th>Affected User</th>";
						//if condition for no ticket scenario
						if($result->num_rows > 0){
							//while loop formats table data
							while($row = $result->fetch_assoc()){
								//ticket ID
								echo "<tr>";
									echo "<th>";
									echo $row["TICKET_ID"];
									echo "</th>";
									//title
									echo "<th>";
									echo $row["TICKET_TITLE"];
									echo "</th>";
									//status
									echo "<th>";
									echo $row["STATUS"];
									echo "</th>";
									//affected user
									echo "<th>";
									echo $row["USER_UN"];
									echo "</th>";
								echo "</tr>";
							}
						}
						//if there are no tickets found
						else {
							echo "No tickets are currently assigned to: ";
							echo $_SESSION['currentUser'].$conn->error;
						}

					echo "</tr>";
				echo "</table>";
			echo "</span>";

			$conn->close();

	?>
	</div>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
