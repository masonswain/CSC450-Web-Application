<?php
session_start();
//DB CONNECTION CREDENTIALS
$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";

//BUILD CONNECTION STRING
$conn = mysqli_connect($servername, $username, $pw, $dbName);

//TRY CONNECTION
if($conn->connect_error){
	die("Connection failed: ".$dbConn->connect_error);
}

//RECEIVE POST DATA
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ticketID=$_POST['ticketID'];
    $note=$_POST['note'];
}

//Create Note in NOTE table
$sql="INSERT INTO NOTE (TICKET_ID, OWNER_UN, NOTE, UNREAD_USER, UNREAD_TECH) VALUES ('".$ticketID."','{$_SESSION['currentUser']}','".$note."','0','1')";
			
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