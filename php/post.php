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
    $query="";
    $location=$_POST['location'];
    $title=$_POST['title'];
    $salary=$_POST['salary'];
    $requirement=$_POST['requirement'];
    $desc=$_POST['desc'];
    $stmt = $conn->prepare("insert into announcement(cid,location,title,salary,requirements,description) values (?,?,?,?,?,?);");
    $stmt->bind_param("ssssss", $_SESSION['id'], $location, $title, $salary,$requirement,$desc);    
    if ($stmt->execute() === TRUE) {
        echo "Announcement posted successfully";
    }
    else{
        echo mysqli_error($conn);
    }
    //***********************************Find all students who follow the company and insert notifications*************************
    $stmt = $conn->prepare("select sid,max(aid) as max from follow f,announcement where f.cid = ? group by sid;");
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {       
            $sid[]=$row["sid"];
            $jid=$row["max"];
		}
        foreach($sid as $id){
            $query.="insert into notifyme(sid,aid,data,timestamp) values (".$id.",".$jid.",'',current_timestamp());";        
        }
        if ($conn->multi_query($query) === TRUE) {
        }
	}    
?>