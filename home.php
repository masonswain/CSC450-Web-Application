<?php
	//add header
	include('header.php');
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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

<div class="logout">
	<h3>
		<?php
			echo "User: $_SESSION[currentFirstName]
			 $_SESSION[currentLastName]";
		?>
	</h3>
	<form action="logout.php">
		<input type="submit" class="button" style="float:left;color:white;cursor:pointer;" value="Logout"/>
	</form>
</div>

<?php
	//Get Admin value for current user
	$sqlAdmin = "SELECT ADMIN FROM USER WHERE USERNAME='".$_SESSION['currentUser']."'";
	$resultAdmin = $conn->query($sqlAdmin);
	$isAdmin = $resultAdmin->fetch_assoc();

	//Header displayed based on user's Admin status
	if ($isAdmin['ADMIN'] == 'N') {
		echo "<h1>South St Paul Schools</h1>";
	} else if ($isAdmin['ADMIN'] == 'Y') {
		echo "<h1>South St Paul Schools Technology Command Center</h1>";
	}
?>

</head>

<body>
    <h2>Home</h2>
	<span class="notifications">
		<!-- The following values will be inserted from the database -->
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
	<?php
		if ($isAdmin['ADMIN'] == 'N') {
			echo "<button type='button' class='button' style='float:left;' onClick='location.href=\"openTicket.php\"'>Open Ticket</button>";
		}
	?>
	<br><br>
	<form  name="filterForm" action="<?php $_PHP_SELF ?>" method="POST">
		Filter Tickets: <select name="filter" id="filter" onchange="filterForm.submit();">
							<option >Select Status</option>
							<option value="All">All</option>
							<option value="Active">Active</option>
							<option value="Closed">Closed</option>
						</select>
	</form>
	<div id="tickets">
	</div>
	<?php
		//Dropdown
		include('loadTickets.php');
		echo "<br>";
	?>
	<script>
	$(document).ready(function() {
		$('#filter').change(function() {

			var filter = $(this).val();

			$.ajax({
				url:"loadTickets.php",
				method:"POST",
				data:{filter:filter},
				success:function(data) {
					$('#tickets').html(data);
				}
			});
		});
	});
	</script>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
