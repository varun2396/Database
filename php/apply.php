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
    $stmt = $conn->prepare("insert into applied(sid,aid) values(?,?);");
    $stmt->bind_param("ss", $_SESSION['id'], $jid);   
    if ($stmt->execute() === TRUE) {
        echo "Job application sent";
    }
    else
        echo "Error";
?>