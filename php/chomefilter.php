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
    $query="";
    $jid=$_POST['jid'];
    $uid=$_POST['uid'];
    $major="%{$_POST['major']}%";
    $gpa=$_POST['gpa'];
    $resume="%{$_POST['resume']}%";
    $stmt = $conn->prepare("select sid from student where uid=? and gpa>=? and resume like ? and major like ?;");
    $stmt->bind_param("ssss", $uid, $gpa, $resume, $major);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {       
            $sid[]=$row["sid"];
		}
	}
    foreach($sid as $id){
        $query.="insert into notifyme(sid,aid,data,timestamp) values (".$id.",".$jid.",'',current_timestamp());";        
    }
    echo $query;
    if ($conn->multi_query($query) === TRUE) {
        echo "New records created successfully";
    }
    else
       echo mysqli_error($conn);
?>