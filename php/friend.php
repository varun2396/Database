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
    $uname=$_POST['uname'];    
    $stmt = $conn->prepare("insert into friendrequest values(?,(select sid from student where username=?),'pending',current_timestamp());");
    $stmt->bind_param("ss",$_SESSION['id'], $uname);   
    if ($stmt->execute() === TRUE) {
        echo "Friend request sent";
    }
    else
        echo "Error";
?>