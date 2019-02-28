<!doctype html>
<html class="no-js" lang="">

<head>

</head>

<body>

<?php
$user=$_GET['un'];
$authpw=$_GET['authpw'];

$servername = "joelknutson.net";
$username = "joelknut_csc450";
$pw = "CSP@2019";
$dbName = "joelknut_csc450";

$conn = new mysqli($servername, $username, $pw, $dbName);

if($conn->connect_error){

    die("Connection failed: ".$dbConn->connect_error);
}
//echo "Connection successful<br/>";
//echo "username is ".$user;

$sql = "SELECT FNAME, LNAME FROM USER WHERE USERNAME='".$user."' AND PASSWORD=".$authpw;
$result=$conn->query($sql);

if ($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        //return array("fname","lname");
        echo $row["FNAME"];
        echo ",";
        echo $row["LNAME"];


    }

} else{
    echo "Authentication Failed";
}

$conn->close();

?>

</body>

</html>
