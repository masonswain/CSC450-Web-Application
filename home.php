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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

<div class="logout">
	<h3>
		<?php
			echo "User: $_SESSION[currentFirstName]
			 $_SESSION[currentLastName]";
		?>
	</h3>
	<form action="logout.php">
		<input type="submit" class="button" style="float:left;color:white;cursor:pointer;" value="Logout"/>
	</form>
</div>

<h1>South St Paul Technology</h1>

</head>

<body>
    <h2>Home</h2>
	<span class="notifications">
		<!-- The following values will be inserted from the database -->
		<div id="ticketsOpen">
		<?php
			echo $tickets; ?> Ticket(s) Open</div>
		<div id="messagesWaiting"> Messages(s) Waiting</div>
	</span>
	<br><br>
	<button type="button" class="button" style="float:left;color:white;cursor:pointer;"onClick="location.href='OpenTicket.php'">Open Ticket</button>
	<br><br>
	<h3>Assigned to me</h3>

	
	<?php		
			//GET TICKETS ASSIGNED TO TECH USER
			//BUILD QUERY STRING
			$sql2 = "SELECT * FROM TICKET WHERE TECH_UN='".$_SESSION['currentUser']."'";

			//ASSIGN DATA TO ARRAY
			$result2=$conn->query($sql2);			
			
			//CREATE TABLE AND DISPLAY DATA
			//
			
						//if condition for no ticket scenario
						if($result2->num_rows > 0){							
							echo "<table style='width:100%' border='3'>";
							echo "<tr>";
							echo "<th>View</th>";
							echo "<th>Ticket ID</th>";
							echo "<th>Title</th>";
							echo "<th>Status</th>";
							echo "<th>Assigned To</th>";
							echo "<th>Unread Messages</th></tr>";
							//while loop formats table data
							while($row2 = $result2->fetch_assoc()){
								$id2 = $row2["TICKET_ID"];
								// link to view ticket
								echo "<tr>";
								echo "<td><form action='EditTicket.php' method='post'><input name='viewTicket' type='submit' id='viewTicket' value='Edit this ticket' class='button' style='color:white;cursor:pointer;'";
								//echo "<input type='text' name='selectedID' value='$id;'/>";
								echo "</td>";
								//ticket ID
								echo "<td>";?>
								<input type="hidden" name="selectedID" value="<?php echo (isset($id2)) ? $id2: ''?>"/>
								<?php
								echo "</form>";						
								echo $row2["TICKET_ID"];
								echo "</td>";
								//title
								echo "<td>";
								echo $row2["TICKET_TITLE"];
								echo "</td>";
								//status
								echo "<td>";
								echo $row2["STATUS"];
								echo "</td>";
								//assigned user
								echo "<td>";
								echo $row2["TECH_UN"];
								echo "</td>";
								//unread Messages
								echo "<td>";
								$sqlURM = "SELECT * FROM NOTE WHERE TICKET_ID= '".$row2['TICKET_ID']."' order by NOTE_ID desc limit 1";
								$resultURM=$conn->query($sqlURM);
								if (mysqli_num_rows($resultURM) > 0) {
									$dataURM = mysqli_fetch_array($resultURM);
								}
								ECHO "</br>";
								ECHO $dataURM['UNREAD_TECH'];
								ECHO "</br>";
								ECHO $row2['TICKET_ID'];
								if($dataURM['UNREAD_TECH'] === '0'){
									echo "No";
								}
								if($dataURM['UNREAD_TECH'] === '1'){
									echo "Yes";
								}
								echo "</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
						//if there are no tickets found
						else {
							echo "<br>";
							echo "No tickets are currently assigned to: ";
							echo "<br>";
							echo $_SESSION['currentUser'].$conn->error;
						}
				
			
		 

			//GET TICKETS ASSIGNED TO USER
			//BUILD QUERY STRING
			$sql3 = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."'";

			//ASSIGN DATA TO ARRAY
			$result3=$conn->query($sql3); 	
			
			echo "<h3>Active Tickets</h3>";
			
			
			//CREATE TABLE AND DISPLAY DATA
			//
			//echo "<span>";
						//if condition for no ticket scenario
						if($result3->num_rows > 0){							
							echo "<table style='width:100%' border='3'>";
							echo "<tr>";
							echo "<th>View</th>";
							echo "<th>Ticket ID</th>";
							echo "<th>Title</th>";
							echo "<th>Status</th>";
							echo "<th>Created By</th>";
							echo "<th>Unread Messages</th></tr>";
							//echo "</tr>";
							//while loop formats table data
							while($row3 = $result3->fetch_assoc()){
								$id3 = $row3["TICKET_ID"];
								// link to view ticket
								echo "<tr>";
								echo "<td><form action='ViewTicket.php' method='post'><input name='viewTicket' type='submit' id='viewTicket' value='View this ticket' class='button' style='color:white;cursor:pointer;'";
								//echo "<input type='text' name='selectedID' value='$id;'/>";
								echo "</td>";
								//ticket ID
								echo "<td>";?>
								<input type="hidden" name="selectedID" value="<?php echo (isset($id3)) ? $id3: ''?>"/>
								<?php
								echo "</form>";						
								echo $row3["TICKET_ID"];
								echo "</td>";
								//title
								echo "<td>";
								echo $row3["TICKET_TITLE"];
								echo "</td>";
								//status
								echo "<td>";
								echo $row3["STATUS"];
								echo "</td>";
								//affected user
								echo "<td>";
								echo $row3["USER_UN"];
								echo "</td>";
								//unread Messages
								echo "<td>";
								
								$sqlURM = "SELECT * FROM NOTE WHERE TICKET_ID= '".$row3['TICKET_ID']."' order by NOTE_ID desc limit 1";
								$resultURM=$conn->query($sqlURM);
								if (mysqli_num_rows($resultURM) > 0) {
									$dataURM = mysqli_fetch_array($resultURM);
								}
								ECHO $dataURM['UNREAD'];
								if($dataURM['UNREAD'] === '0'){
									echo "No";
								}
								if($dataURM['UNREAD'] === '1'){
									echo "Yes";
								}
								echo "</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
						//if there are no tickets found
						else {
							echo "<br>";
							echo "No tickets are currently assigned to: ";
							echo $_SESSION['currentUser'].$conn->error;
						}
				
			//echo "</span>";

			$conn->close();

	?>
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
