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
    $cid=$_POST['cid'];
    $stmt = $conn->prepare("insert into follow values(?,?);");
    $stmt->bind_param("ss", $_SESSION['id'],$cid);
    if ($stmt->execute() === TRUE) {
        echo "Followed";
    }
    else
        echo "Already following";
?>