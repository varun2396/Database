<?php 
    session_start();
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
    $jid=$_POST['jid'];    
    $fid=$_POST['fid'];    
    $stmt = $conn->prepare("insert into notifyme(sid,aid) values (?,?);");
    $stmt->bind_param("ss", $fid, $jid);   
    if ($stmt->execute() === TRUE) {
        echo "Notification sent";
    }
    else
        echo mysqli_error($conn);
?>