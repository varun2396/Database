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
    
    $uname=$_POST['username'];
    $pass=$_POST['pass'];
    $cname=$_POST['cname'];
    $industry=$_POST['industry'];
    $location=$_POST['location'];
    
    //**************************************Check if user exists**********************************
    $stmt = $conn->prepare("select username from company where username=?;");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'User exists';
        exit();
	}
    
    //**************************************Insert values***************************************
    $stmt = $conn->prepare("insert into company(cname, username, password, location, industry) values(?,?,?,?,?);");
    $stmt->bind_param("sssss", $cname, $uname, $pass, $location, $industry);
    if($stmt->execute()===TRUE)
        echo 'Registered';
    else
        echo "error";
?>