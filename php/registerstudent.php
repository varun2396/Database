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
    
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $sname=$_POST['sname'];
    $uid=$_POST['uid'];
    $major=$_POST['major'];
    $gpa=$_POST['gpa'];
    $interests=$_POST['interests'];
    $resume=$_POST['resume'];
    
    //**************************************Check if user exists**********************************
    $stmt = $conn->prepare("select username from student where username=?;");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'User exists';
        exit();
	}
    
    //**************************************Insert values***************************************
    $stmt = $conn->prepare("insert into student(sname, uid, major, gpa, interests, resume, username, password) values (?,?,?,?,?,?,?,?);");
    $stmt->bind_param("ssssssss", $sname,$uid,$major,$gpa,$interests,$resume,$uname,$pass);
    if($stmt->execute()===TRUE)
        echo 'Registered';
    else
        echo "error";
?>