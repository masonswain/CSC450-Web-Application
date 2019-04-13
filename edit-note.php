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

//if statement to flip adjust UNREAD boolean accordingly
if($techUN == $_SESSION['currentUser']){
	//Create Note in NOTE table as Assigned Tech, should be false/0
	$sql="INSERT INTO NOTE (TICKET_ID, OWNER_UN, NOTE, UNREAD) VALUES ('".$ticketID."','{$_SESSION['currentUser']}','".$note."','0')";
}
if($techUN !== $_SESSION['currentUser']){
	//Create Note in NOTE table as user, should be True/Default
	$sql="INSERT INTO NOTE (TICKET_ID, OWNER_UN, NOTE, UNREAD) VALUES ('".$ticketID."','{$_SESSION['currentUser']}','".$note."','0')";
}

if ($conn->query($sql) === TRUE) {
	echo "alert(Note created successfully);";
	header("Location: home.php");
} 
else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: home.php');



?>