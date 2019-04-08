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

        $sql3 = "SELECT * FROM NOTE WHERE TICKET_ID= '".$_POST['selectedID']."' ORDER BY NOTE_ID DESC";
        $result3=$conn->query($sql3);
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
                    <td><label for="ticketHistory"><h4>Ticket History</h4></label></td>
                </tr>
                <tr>
                    <td><div name="ticketHistory" id="ticketHistory" style="overflow-y: scroll;">
                        Notes<br>
                        -------------------------------<br>
                        <?php
			            if ($result3->num_rows > 0){
				            while($row3 = $result3->fetch_assoc()){
					            echo "From:  ";
					            echo $row3["OWNER_UN"];
					            echo "<br/>";
					            echo $row3["NOTE_ID"];
					            echo "<br/>";
					            echo $row3["NOTE"];
					            echo "<br/>";
					            echo "-------------------------------";
					            echo "<br/>";
				            }
			            } else {
				            echo "** No Notes Found **".$conn->error;
			            }
                        ?>
                    </div></td>
                </tr>
                <tr>
                    <td><textarea rows="10%" cols="60%" class="form-control" form="viewTicket" name="note" id="note" placeholder="Add Message"></textarea></td>
                </tr>
            </table>

            <!-- Sending Ticket_ID for inserting note into database -->
            <input type="hidden" name="ticketID" value="<?php echo (isset($ticketID)) ? $ticketID: ''?>"/>


            <span style="float: center;">
                <button type="submit" style="color:white;cursor:pointer;" class="button">Submit</button>
                <button type="button" style="color:white;cursor:pointer;" class="button" onclick="location.href='home.php'">Cancel</button>
            </span>
        </form>
	
    
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>