<?php
	include('header.php');
?>
<html>
	<body>
		<?php
			$status = $_POST['filter'];
			if (!isset($status)) {
				$status = "Active";
			}

			//Get Admin value for current user
			$sqlAdmin = "SELECT ADMIN FROM USER WHERE USERNAME='".$_SESSION['currentUser']."'";
			$resultAdmin = $conn->query($sqlAdmin);
			$isAdmin = $resultAdmin->fetch_assoc();

			// USER INTERFACE
			if ($isAdmin['ADMIN'] == 'N') {
				//Tickets retrieved on USER_UN
				echo '<h3>My Tickets ('.$status.')</h3>';

				//All tickets
				if ($status == 'All') {
					$sqlAll = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."' AND STATUS='Active' OR STATUS='Closed'";
					include('displayTable.php');
				}

				//Active or Closed options
				else {
					$sqlAll = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."' AND STATUS='".$status."'";
					include('displayTable.php');
				}

			// ADMIN INTERFACE
			} else if ($isAdmin['ADMIN'] == 'Y') {
				// Unassigned Tickets
				echo '<h3>Unassigned Ticket List</h3>';
				$sqlAll = "SELECT * FROM TICKET WHERE TECH_UN='Unassigned'";
				include('displayTable.php');

				// Assigned Tickets
				echo '<h3>Assigned Ticket List ('.$status.')</h3>';

				//All tickets
				if($status == 'All'){
					$sqlAll = "SELECT * FROM TICKET WHERE TECH_UN='".$_SESSION['currentUser']."' AND STATUS='Active' OR STATUS='Closed'";
					include('displayTable.php');
				}
				//Active or Closed options
				else {
					$sqlAll = "SELECT * FROM TICKET WHERE TECH_UN='".$_SESSION['currentUser']."' AND STATUS='".$status."'";
					include('displayTable.php');
				}
			}
						
		?>
	</body>
</html>