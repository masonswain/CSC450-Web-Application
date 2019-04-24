<?php
	//ASSIGN DATA TO ARRAY
	$resultAll=$conn->query($sqlAll);
	//CREATE TABLE AND DISPLAY DATA
	if($resultAll->num_rows > 0){							
		echo "<table style='width:100%' border='3'>";
		echo "<tr>";
		echo "<th>View</th>";
		echo "<th>Ticket ID</th>";
		echo "<th>Title</th>";
		echo "<th>Status</th>";
		echo "<th>Assigned To</th>";
		echo "<th>Unread Messages</th></tr>";
		//while loop formats table data
		while($row2 = $resultAll->fetch_assoc()){
			$id2 = $row2["TICKET_ID"];
			// *** if user is not admin *** /// 
			if($isAdmin['ADMIN'] == 'Y'){
				//link to EditTicket.php
				echo "<tr>";
				echo "<td><form action='EditTicket.php' method='post'><input name='viewTicket' type='submit' id='viewTicket' value='Edit' class='button' style='color:white;cursor:pointer;'";
				echo "</td>";
			}
			else {
				// link to ViewTicket.php
				echo "<tr>";
				echo "<td><form action='ViewTicket.php' method='post'><input name='viewTicket' type='submit' id='viewTicket' value='View' class='button' style='color:white;cursor:pointer;'";
				echo "</td>";
			}
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
			if($isAdmin['ADMIN'] == 'Y'){
				if($dataURM['UNREAD_TECH'] === '0'){
					echo "No";
				}
				if($dataURM['UNREAD_TECH'] === '1'){
					echo "Yes";
				}
			}
			if($isAdmin['ADMIN'] == 'N'){
				if($dataURM['UNREAD_USER'] === '0'){
					echo "No";
				}
				if($dataURM['UNREAD_USER'] === '1'){
					echo "Yes";
				}
			}
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
	}
	//if there are no tickets found
	else {
		echo "No tickets found for this criteria.";
	}
?>