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
    $jid=$_POST['jid'];    
    $stmt = $conn->prepare("delete from announcement where aid=?;");
    $stmt->bind_param("s", $jid);   
    if ($stmt->execute() === TRUE) {
        echo "Deleted post";
    }
    else
        echo "Error";
?>