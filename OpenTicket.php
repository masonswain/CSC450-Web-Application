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
		<div id="ticketsOpen">
		<?php 
			echo $tickets; ?> Ticket(s) Open</div>
		<div id="messagesWaiting">1 Messages(s) Waiting</div>
	</span>
	<br><br>
	<span class="buttons">
		<div id="openTicket"><button type="button" class="button" onClick="location.href='OpenTicket.php'">Open Ticket</button></div>
		<div id="viewTickets"><button type="button" class="button" onClick="location.href='ViewTicket.php'">View Tickets</button></div>
	</span>
	<br><br><br>
            <form action="create-ticket.php" method="post" id="newTicket">
                <div class="newTicket">

                <!-- Short Description -->
                <label for="ticketTitle">Title</label>
                <input required type="text" class="form-control" name="ticketTitle" id="ticketTitle"><br>

                <!-- Tech -->

                <label for="techUN">Assigned To:</label>
                <div class="scrollable">
                <select required class="form-control" name="techUN" id="techUN" size="5" multiple="multiple">
                    <option value="" disabled selected hidden>Select Assignee</option>
                    <?php
                        $option = $conn->query("SELECT FNAME, LNAME, USERNAME FROM USER");
                        while ($dropdown = $option->fetch_assoc()) {
                            unset($un, $fn, $ln);
                            $un = $dropdown['USERNAME'];
                            $fn = $dropdown['FNAME'];
                            $ln = $dropdown['LNAME'];
                            echo '<option value="'.$un.'">'.$fn.' '.$ln.'</option>';
                        }
                    ?>
                </select></div><br>
                
               <!-- Building dropdown -->

                <label for="buildingDropDown">Building:</label>
                <select required class="form-control" name="building" id="building">
                    <option value="" disabled selected hidden>Choose Building</option>
                    <option value="main">Main</option>
                    <option value="secondary">Secondary</option>
                    <option value="admin">Admin</option>
                    <option value="library">Library</option>
                </select><br>

                <!-- Room # -->

                <label for="room">Room #:</label>
                <input required type="number" class="form-control" name="room" id="room"><br>

                <!-- Extension -->

                <label for="phone">Phone</label>
                <input required type="number" class="form-control" name="phone" id="phone"><br>

                <!-- Additional notes -->

                <label for="note">Additional Information</label>
                <textarea rows="5" cols="75" class="form-control" form="newTicket" name="note" id="note">Notes</textarea><br><br>



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