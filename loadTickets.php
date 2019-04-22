<?php
	include('header.php');
?>
<html>
	<body>
		<form action = "<?php $_PHP_SELF ?>" method = "POST">
			Filter Tickets: <select name= "status">
			<option >Select Status</option>
			<option value="All">All</option>
			<option value="Active" selected>Active</option>
			<option value="Closed">Closed</option>
			</select>
			<input type = "submit" />
		</form>

		<?php
			//Get Admin value for current user
			$status = $_POST['status'];
			if (!isset($status)) {
				$status = "Active";
			}
			$sqlAll = "SELECT ADMIN FROM USER WHERE USERNAME='".$_SESSION['currentUser']."'";
			$resultAll = $conn->query($sqlAll);
			$isAdmin = $resultAll->fetch_assoc(); 

			//Tickets retrieved on USER_UN -- All users
			echo '<h3>My Tickets ('.$status.')</h3>';
			//All tickets
			if($status == 'All'){
				$sqlAll = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."' AND STATUS='Active' OR STATUS='Closed'";
				include('displayTable.php');
			}
			//Active or Closed options
			else {
				$sqlAll = "SELECT * FROM TICKET WHERE USER_UN='".$_SESSION['currentUser']."' AND STATUS='".$status."'";
				include('displayTable.php');
			}

			//If user is Admin
			if($isAdmin['ADMIN'] == 'Y'){
				echo '<h3>Assigned to me ('.$status.')</h3>';
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