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
//Total Tickets
$sql = "SELECT COUNT(*) FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."' OR TECH_UN = '".$_SESSION['currentUser']."'";
$result=$conn->query($sql);
$row = mysqli_fetch_array($result);
$totalTickets = $row[0];
//User created tickets
$sqlc = "SELECT COUNT(*) FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."'";
$resultc=$conn->query($sqlc);
$rowc = mysqli_fetch_array($resultc);
$createdTickets = $rowc[0];
//Assigned Tickets
$sqla = "SELECT COUNT(*) FROM TICKET WHERE TECH_UN = '".$_SESSION['currentUser']."'";
$resulta=$conn->query($sqla);
$rowa = mysqli_fetch_array($resulta);
$assignedTickets = $rowa[0];

//GET TICKETS THAT CURRENT USER IS INVOLVED WITH
$sqlUN = "SELECT * FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."' OR TECH_UN='".$_SESSION['currentUser']."'";
$resultUN=$conn->query($sqlUN);
//String for holding ticket SQL query text
$IdString = '';
//build string
if($resultUN->num_rows > 0){
	//while loop formats table data
	while($rowUN = $resultUN->fetch_assoc()){
		$IdString = $IdString . 'TICKET_ID=' . $rowUN['TICKET_ID'] . ' OR ';
	}
}
//remove last OR
$IdString = substr($IdString, 0, -4);
//get count of unread tickets from $IdString
$sqlUnCt = "SELECT COUNT(*) FROM NOTE WHERE (".$IdString.") AND OWNER_UN!='".$_SESSION['currentUser']."' AND UNREAD=1";
$resultUnCt=$conn->query($sqlUnCt);
$rowUnCt = mysqli_fetch_array($resultUnCt);
$Unread = $rowUnCt[0];

/////IF NOTE HAS BEEN VIEWED FEATURE////////
//The user loading the page is either the creator or the assignee of the selected ticket.
if($_SESSION['currentUser'] === $data['USER_UN'] || $data['TECH_UN']){
	//If the current user is the assignee of the ticket.
	if($_SESSION['currentUser'] === $data['TECH_UN']){
		//If the Creator user did create the most recent comment
		if($_SESSION['currentUser'] === $data1['OWNER_UN'] ){
			//echo "</br>";
			//echo "Unread is not changed, you made the last comment.";
		}
		//If the Creator user did NOT create the most recent comment
		if($_SESSION['currentUser'] !== $data1['OWNER_UN'] ){
			//echo "</br>";
			//echo "Unread is being changed, you did not make the last comment.";
			//Make change on ticket UNREAD VALUE
			$sql5 = "UPDATE NOTE SET UNREAD_TECH = 0 WHERE TICKET_ID = '".$_POST['selectedID']."' AND NOTE_ID = '".$data1['NOTE_ID']."' ";
			$result5=$conn->query($sql5);
			$sql6 = "SELECT * FROM NOTE WHERE TICKET_ID= '".$_POST['selectedID']."' order by NOTE_ID desc limit 1";
			$result6=$conn->query($sql6);
			if (mysqli_num_rows($result6) > 0) {
				$data2 = mysqli_fetch_array($result6);
			}
		}
	}
}


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
                    <tr><!-- Tech -->
                        <th><label for="techUN">Assigned To:</label></th>
                        <td> 
                            <select required class="form-control" name="techUN" id="techUN" size="3" multiple="multiple">
                                <option value="" disabled selected hidden>Select Assignee</option>
                                <?php
                                    $option = $conn->query("SELECT FNAME, LNAME, USERNAME FROM USER WHERE ADMIN = 'Y'");
                                    while ($dropdown = $option->fetch_assoc()) {
                                        unset($un, $fn, $ln);
                                        $un = $dropdown['USERNAME'];
                                        $fn = $dropdown['FNAME'];
                                        $ln = $dropdown['LNAME'];
                                        echo '<option value="'.$un.'">'.$fn.' '.$ln.'</option>';
                                    }
                                ?>
                            </select>
                        </td>
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