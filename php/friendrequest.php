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
    $friend=$_POST['friend'];    
    $value=$_POST['value'];    
    $stmt = $conn->prepare("update friendrequest set accept=?,timestamp=current_timestamp() where sid=? and fid=?;");
    $stmt->bind_param("sss",$value,$friend,$_SESSION['id']);   
    if ($stmt->execute() === TRUE) {
        echo "Friend request sent";
    }
    else
        echo "Error";
?>