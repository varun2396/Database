<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/message.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
        <?php session_start(); ?>
        <div class="topnav">
          <a href="shome.php">Home</a>
          <a href="notification.php">Notifications</a>
          <a class="active" href="message.php">Message</a>
          <a href="friend.php">Friends</a>
          <a href="company.php">Company</a>
          <p class="a">
          <span style="float:right;"><a href="php/logout.php">Signout</a></span>
          <span class="b" style="float:right;">Welcome <?php echo $_SESSION['name'] ?></span></p>
        </div>
    
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
        //*************************************Generate all messages to be shown*********************************************
        $id=$_SESSION['id'];              
        $query= ("select body,(timestamp) as time,sname from message m, student s where s.sid=m.senderid and receiverid=? order by timestamp;");
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {       
                echo "<div class='container'>
                      <p>(".$row["sname"]."): ".$row['body']."</p>
                      <span class='time-left'>".$row['time']."</span>
                      </div>";	
			}
		}
        
       //*******************************************Populate friends dropdown*******************************************             
        $id=$_SESSION['id'];
        $st= ("select sid,sname from student where sid in (select fid as id from friendrequest where sid=? and accept='yes')
                union
              select sid,sname from student where sid in (select sid from friendrequest where fid=? and accept='yes');");
                  
        $stmt = $conn->prepare($st);
        $stmt->bind_param("ss", $id,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Send to : <select id='select'>";
			while($row = $result->fetch_assoc()) {  
                             
                echo "<option value=".$row["sid"].">".$row["sname"]."</option>";	//value is sid of student
			}
            echo "</select>";
		}
    ?>
    <div class="clearfix">
        <textarea id="text" class="text" cols="40" rows="2"></textarea>
        <button type="submit" class="send" id="send">Send</button>
    </div>
    
    <script src="js/message.js"></script>

</body>
</html>
