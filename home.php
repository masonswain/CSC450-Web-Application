<?php
	//add header
	include('header.php');
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
			echo $totalTickets;?> 
			Ticket(s) Open (<?php 
			echo $createdTickets;?>
			Created, 
			<?php 
			echo $assignedTickets;?>
			 Assigned)
			</div>
		<div id="messagesWaiting"> 
		<?php
			echo $Unread; ?> Ticket(s) Awaiting Reply</div>
	</span>
	<br><br>
	<button type="button" class="button" style="float:left;color:white;cursor:pointer;"onClick="location.href='OpenTicket.php'">Open Ticket</button>
	<br>
	<br>
	
	<?php
		//Dropdown
		include('loadTickets.php');
		echo "<br>";
	?>
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
