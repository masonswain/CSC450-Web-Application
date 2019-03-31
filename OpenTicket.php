﻿<?php
session_start();
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>South St. Paul Technology - Open Ticket</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


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
	<span class="notifications">
		<!-- The following values will be inserted from the database -->
		<div id="ticketsOpen">1 Ticket(s) Open</div>
		<div id="messagesWaiting">1 Messages(s) Waiting</div>
	</span>
	<br><br>
        <span class="buttons">
            <div id="openTicket"><button type="button" class="button" onclick="location.href='OpenTicket.php'">Open Ticket</button></div>
            <div id="viewTickets"><button type="button" class="button" onclick="location.href='ViewTicket.php'">View Tickets</button></div>
        </span>
	<br><br><br>
            <form action="create-ticket.php" method="post">
                <!-- Ticket # -->
                <div class="newTicket">
 
                <!-- Short Description -->
                <label for="ticketTitle">Short Description</label>
                <input type="text" class="form-control" name="ticketTitle" id="ticketTitle">


                <!-- Tech -->

                <label for="submittedBy">Assigned To:</label>
                <input type="text" class="form-control" name="techUN" id="techUN">

                <!-- User -->

                <label for="submittedBy">Submitted By:</label>
                <input type="text" class="form-control" name="userUN" id="userUN">


                <!-- Status -->

                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="hold">On Hold</option>
                </select>

               <!-- Building dropdown -->

                <label for="buildingDropDown">Building:</label>
                <select class="form-control" name="building" id="building">
                    <option value="" disabled selected hidden>Choose Building</option>
                    <option value="main">Main</option>
                    <option value="secondary">Secondary</option>
                    <option value="admin">Admin</option>
                    <option value="library">Library</option>
                </select>

                <!-- Room # -->

                <label for="room">Room #:</label>
                <input type="number" class="form-control" name="room" id="room">

                <!-- Extension -->

                <label for="phone">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone">



                    <!-- User's username will be inserted here
    <label for="message">Message from username</label>
    <textarea class="form-control" id="message" rows="8">Type comments here...</textarea> -->

                    <br /><br />
                    <span class="buttons2">
                        <button type="submit" class="button">Send</button>
                        <button type="button" class="button" onclick="location.href='home.php'">Cancel</button>
                        <!--<div id="cancel"><button type="button" class="button">Cancel</button></div>-->

                    </span>
                </div>
            </form>
	
    
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>