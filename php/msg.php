<?php 
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
    $body=$_POST['msg'];
    $senderid=1;
    $receiverid=$_POST['rid'];
    $stmt = $conn->prepare("INSERT INTO message (senderid,receiverid,body,timestamp) VALUES (?, ?, ?, CURRENT_TIMESTAMP())");
    $stmt->bind_param("sss", $senderid, $receiverid, $body);
    $stmt->execute();
?>