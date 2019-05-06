<?php
session_start();
//DB CONNECTION CREDENTIALS
$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";

//BUILD CONNECTION STRING
$conn = new mysqli($servername, $username, $pw, $dbName);

//TRY CONNECTION
if($conn->connect_error){
	die("Connection failed: ".$dbConn->connect_error);
}

//RECEIVE POST DATA
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ticketID=$_POST['ticketID'];
	$techUN=$_POST['techUN'];
	$status=$_POST['status'];
    $note=$_POST['note'];
}

// Update Ticket in TICKET table
$sql2 = "UPDATE TICKET SET TECH_UN = '".$techUN."', STATUS = '".$status."' WHERE TICKET_ID = '".$ticketID."'";
$conn->query($sql2);

/*Get unread tickets for currentUser
$sqlUnread = "SELECT * FROM NOTE WHERE (".$ticketID.")  AND OWNER_UN!='{$_SESSION['currentUser']}' AND UNREAD=1 ORDER BY NOTE_ID ASC";
$resultUnread=$conn->query($sqlUnread);
$row = mysqli_fetch_array($resultUnread);
//iterate through query result and change UNREAD value to 0.
if ($resultUnread->num_rows > 0){
				//update unread value
				while($row = $resultUnread->fetch_assoc()){
					//Get unread tickets for currentUser
					$sqlUnreadChange = "UPDATE NOTE SET UNREAD=0 WHERE NOTE_ID='".$row["NOTE_ID"]."' ";				
				}
} */

//if statement to flip adjust UNREAD boolean accordingly
$sql="INSERT INTO NOTE (TICKET_ID, OWNER_UN, NOTE, UNREAD_USER, UNREAD_TECH) VALUES ('".$ticketID."','{$_SESSION['currentUser']}','".$note."','1','0')";

if ($conn->query($sql) === TRUE) {
	echo "alert(Note created successfully);";
	$sql = "UPDATE NOTE SET UNREAD=0 WHERE TICKET_ID=".$ticketID." AND OWNER_UN!='{$_SESSION['currentUser']}'";
	if($conn->query($sql) === TRUE) {
		echo "Unread flag cleared.";
	}
	else{
		echo "Unread flag not cleared."; 
	}
	echo "<script>location.href='home.php';</script>";
} 
else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo "<script>location.href='home.php';</script>";



?>