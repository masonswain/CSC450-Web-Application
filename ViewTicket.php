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

	<title>South St. Paul Technology - View Ticket</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

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
	
    <h2>Ticket Details</h2>
	<span class="notifications">
		<div id="ticketsOpen">
		<?php 
			echo $tickets; ?> Ticket(s) Open</div>
		<div id="messagesWaiting"> Messages(s) Waiting</div>
	</span>
	<br><br>
	<span class="buttons">
		<div id="openTicket"><button type="button" class="button" style="float:left;color:white;cursor:pointer;" onClick="location.href='OpenTicket.php'">Open Ticket</button></div>
	</span>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ticketID=$_POST['selectedID'];
        }
        $sql2 = "SELECT TICKET_TITLE, TECH_UN, STATUS, BUILDING, ROOM, PHONE FROM TICKET WHERE TICKET_ID = '".$_POST['selectedID']."'";
        $result2=$conn->query($sql2);
        if (mysqli_num_rows($result2) > 0) {
	        $data = mysqli_fetch_array($result2);
        }

    ?>
	<br><br><br>
        <form action="add-note.php" method="post" id="viewTicket">
            <table width="100%" border='3'>
                <tr><!-- Ticket ID -->
                    <th width="25%"><label>Ticket ID</label></th>
                    <td><label>
                    <?php 
                        echo $_POST['selectedID']; ?></label></td>
                </tr>
                <tr><!-- Short Description -->
                    <th width="25%"><label>Title</label></th>
                    <td><label>
                    <?php 
                        echo $data['TICKET_TITLE']; ?></label></td>
                </tr>
                <tr><!-- Assignee -->
                    <th width="25%"><label>Assingee</label></th>
                    <td><label>
                    <?php 
                        echo $data['TECH_UN']; ?></label></td>
                </tr>
                <tr><!-- Status -->
                    <th width="25%"><label>Status</label></th>
                    <td><label>
                    <?php 
                        echo $data['STATUS']; ?></label></td>
                </tr>
                <tr><!-- Building -->
                    <th width="25%"><label>Building</label></th>
                    <td><label>
                    <?php 
                        echo $data['BUILDING']; ?></label></td>
                </tr>
                <tr><!-- Room -->
                    <th width="25%"><label>Room</label></th>
                    <td><label>
                    <?php 
                        echo $data['ROOM']; ?></label></td>
                </tr>
                <tr><!-- Phone -->
                    <th width="25%"><label>Phone</label></th>
                    <td><label>
                    <?php 
                        echo $data['PHONE']; ?></label></td>
                </tr>
            </table> 
            <table width="100%" border='3'>
                <tr>
                    <td><label for="ticketHistory">Ticket History</label></td>
                </tr>
                <tr>
                    <td><textarea rows="20%" cols="60%" class="form-control" form="viewTicket" name="ticketHistory" id="ticketHistory" readonly><!-- Value from POST --></textarea>
                </tr>
                <tr>
                    <td><textarea rows="10%" cols="60%" class="form-control" form="viewTicket" name="note" id="note">Add Message</textarea>
                </tr>
            </table>


                    <!-- User's username will be inserted here
    <label for="message">Message from username</label>
    <textarea class="form-control" id="message" rows="8">Type comments here...</textarea> -->

                <span class="buttons2">
                    <button type="submit" style="color:white;cursor:pointer;" class="button">Submit</button>
                    <button type="button" style="color:white;cursor:pointer;" class="button" onclick="location.href='home.php'">Cancel</button>
                    <!--<div id="cancel"><button type="button" class="button">Cancel</button></div>-->
                 </span>
            </form>
	
    
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>