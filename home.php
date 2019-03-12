<?php
session_start();
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

</head>

<body>

	<h1>South St Paul Technology</h1>
	<h2>
		<?php
		//echo "Welcome $_SESSION[currentUser]";
		echo "Welcome $_SESSION[currentFirstName] $_SESSION[currentLastName]";
		?>
	</h2>
    <h3>Home</h3>
	<span class="notifications">
		<!-- The following values will be inserted from the database -->
		<div id="ticketsOpen">1 Ticket(s) Open</div>
		<div id="messagesWaiting">1 Messages(s) Waiting</div>
	</span>
	<br><br>
	<span class="buttons">
		<div id="openTicket"><button type="button" class="button" onClick="location.href='OpenTicket.html'">Open Ticket</button></div>
		<div id="viewTickets"><button type="button" class="button" onClick="location.href='ViewTicket.html'">View Tickets</button></div>
	</span>
	<br><br>
	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
