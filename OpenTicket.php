<?php
//add header
include('header.php');
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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

<div class="logout">
	<h3>
		<?php
			echo "User: $_SESSION[currentFirstName] $_SESSION[currentLastName]";
		?>
	</h3>
	<form action="logout.php">
		<input type="submit" class="button" value="Logout" style="float:left;color:white;cursor:pointer;"/>
	</form>
</div>

</head>
<body>

	<h1>South St Paul Technology</h1>
	
    <h2>Create New Issue</h2>
	<span class="notifications">
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
		<div id="openTicket"><button type="button" class="button" style="float:left;color:white;cursor:pointer;" onClick="location.href='OpenTicket.php'">Open Ticket</button></div>

	<br><br><br>
            <form action="create-ticket.php" method="post" id="newTicket">
                <div class="newTicket">
                <table style="width:100%" border='3'>
                    <tr><!-- Short Description -->
                        <th><label for="ticketTitle">Title</label></th>
                        <td><input required type="text" class="form-control" name="ticketTitle" id="ticketTitle"><br></td>
                    </tr>
                    <tr><!-- Building dropdown -->                        
                        <th><label for="buildingDropDown">Building:</label></th>
                        <td>                       
                            <select required class="form-control" name="building" id="building">
                                <option value="" disabled selected hidden>Choose Building</option>
                                <option value="main">Main</option>
                                <option value="secondary">Secondary</option>
                                <option value="admin">Admin</option>
                                <option value="library">Library</option>
                            </select><br>
                        </td>
                    </tr>
                    <tr><!-- Room # -->
                        <th><label for="room">Room #:</label></th>
                        <td><input required type="number" class="form-control" name="room" id="room"><br></td>
                    </tr>
                    <tr><!-- Extension -->
                        <th><label for="phone">Phone</label></th>
                        <td><input required type="number" class="form-control" name="phone" id="phone"><br></td>
                    </tr>
                    <tr><!-- Additional notes -->
                        <th><label for="note">Additional Information</label></th>
                        <td><textarea required rows="25%" cols="50%" class="form-control" form="newTicket" name="note" id="note" placeholder="Message"></textarea><br><br></td>
                    </tr>                             
                </table>

                    <!-- User's username will be inserted here
    <label for="message">Message from username</label>
    <textarea class="form-control" id="message" rows="8">Type comments here...</textarea> -->

                    <br /><br />
                    <span class="buttons2">
                        <button type="submit" style="color:white;cursor:pointer;" class="button">Send</button>
                        <button type="button" style="color:white;cursor:pointer;" class="button" onclick="location.href='home.php'">Cancel</button>
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