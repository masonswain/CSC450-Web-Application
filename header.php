<?php
/// *** Create Session *** ///
session_start();
if($_SESSION['status'] != "Active") {
	header("Location: index.html");
}	
$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";
$conn = new mysqli($servername, $username, $pw, $dbName);

/// *** Ticket Counter *** /// 
//Total Tickets
$sql = "SELECT COUNT(*) FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."' OR TECH_UN = '".$_SESSION['currentUser']."'";
$result=$conn->query($sql);
$row = mysqli_fetch_array($result);
$totalTickets = $row[0];
//User created tickets
$sqlUserCount = "SELECT COUNT(*) FROM TICKET WHERE USER_UN = '".$_SESSION['currentUser']."'";
$resultUserCount=$conn->query($sqlUserCount);
$rowUserCount = mysqli_fetch_array($resultUserCount);
$createdTickets = $rowUserCount[0];
//Assigned Tickets
$sqlTechCount = "SELECT COUNT(*) FROM TICKET WHERE TECH_UN = '".$_SESSION['currentUser']."'";
$resultTechCount=$conn->query($sqlTechCount);
$rowTechCount = mysqli_fetch_array($resultTechCount);
$assignedTickets = $rowTechCount[0];

/// *** Tickets to Reply to *** /// 
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
?>