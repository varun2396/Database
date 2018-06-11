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
    $utype=$_POST['utype'];
    if($utype==='Student')
        $stmt = $conn->prepare("select sid as id,sname as name from student where username=? and password=?;");
    else{
        $stmt = $conn->prepare("select cid as id,cname as name from company where username=? and password=?;");
    }
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        session_start();
        session_regenerate_id();
        $_SESSION['user'] = $uname;
        $_SESSION['id'] = $result["id"];
        $_SESSION['name'] = $result["name"];
        $_SESSION['utype'] = $utype;
        session_write_close();
        echo 'Login';
        exit();
	}
    else
        echo 'invalid';
?>