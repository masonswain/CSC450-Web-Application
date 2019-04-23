<?php
//add header
include('header.php');
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
	<span class="buttons">
		<?php
		    if ($isAdmin['ADMIN'] == 'N') {
			    echo "<button type='button' class='button' style='float:left;' onClick='location.href='OpenTicket.php''>Open Ticket</button>";
		    }
	    ?>
	</span>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ticketID=$_POST['selectedID'];
        }
        $sql2 = "SELECT TICKET_TITLE, TECH_UN, USER_UN, STATUS, BUILDING, ROOM, PHONE FROM TICKET WHERE TICKET_ID = '".$_POST['selectedID']."'";
        $result2=$conn->query($sql2);
        if (mysqli_num_rows($result2) > 0) {
	        $data = mysqli_fetch_array($result2);
        }

        $sql3 = "SELECT * FROM NOTE WHERE TICKET_ID= '".$_POST['selectedID']."' ORDER BY NOTE_ID DESC";
        $result3=$conn->query($sql3);

		//get most recent note Owner -- used with Unread messages feature
		
		$sqlT4 = "SELECT * FROM NOTE WHERE TICKET_ID= '".$_POST['selectedID']."' order by NOTE_ID desc limit 1";
        $resultT4=$conn->query($sqlT4);
		if (mysqli_num_rows($resultT4) > 0) {
	        $data1 = mysqli_fetch_array($resultT4);
        }

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
	<br><br><br>
        <form action="edit-note.php" method="post" id="viewTicket">
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
                <tr><!-- Owner -->
                    <th width="25%"><label>Created By</label></th>
                    <td><label>
                    <?php 
                        echo $data['USER_UN']; ?></label></td>
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
                <tr><!-- Assignee -->
                    <th width="25%"><label>Assignee</label></th>
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
                                    if($data['TECH_UN'] == $dropdown['USERNAME']) {
                                        echo '<option value="'.$un.'" selected="selected">'.$fn.' '.$ln.'</option>';
                                    } else {
                                        echo '<option value="'.$un.'">'.$fn.' '.$ln.'</option>';
                                    } 
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><!-- Status -->
                    <th width="25%"><label>Status</label></th>
                    <td>
                    <?php
                        if($data['STATUS'] == "Active" || $data['STATUS'] == "Unassigned") {
                            echo '<input type="radio" name="status" value="Active" checked="checked">Active<br>';
                            echo '<input type="radio" name="status" value="Closed">Closed';
                        } else {
                            echo '<input type="radio" name="status" value="Active">Active<br>';
                            echo '<input type="radio" name="status" value="Closed" checked="checked">Closed';
                        }
                    ?>   
                    </td>
                </tr>
            </table> 
            <table width="100%" border='3'>
                <tr>
                    <td><label for="ticketHistory"><h4>Ticket History</h4></label></td>
                </tr>
                <tr>
                    <td><div name="ticketHistory" class="scrollable">
                        Notes<br>
                        -------------------------------<br>
                        <?php
			            if ($result3->num_rows > 0){
				            while($row3 = $result3->fetch_assoc()){
					            echo $row3["OWNER_UN"];
								echo " | ";
								echo $row3["NOTE_ID"];
								echo "<br/>";
								echo " Replied:  ";
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
                <button type="submit" class="button">Submit</button>
                <button type="button" class="button" onclick="location.href='home.php'">Cancel</button>
            </span>
        </form>
	
    
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>