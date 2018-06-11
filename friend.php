<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/friend.css">   
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
</head>
<body>
    <?php session_start(); ?>
    <div class="topnav">
      <a href="shome.php">Home</a>
      <a href="notification.php">Notifications</a>
      <a href="message.php">Message</a>
      <a class="active" href="friend.php">Friends</a>
      <a href="company.php">Company</a>
      <p class="a"><label>Search:</label><input type='text' id='search' value='' class='search'>
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
        echo "<br><b>Your friends:</b>";
        $id=$_SESSION['id'];
        $st= ("select sname,username from student where sid in (select fid as id from friendrequest where sid=? and accept='yes')
                union
              select sname,username from student where sid in (select sid from friendrequest where fid=? and accept='yes');");
                  
        $stmt = $conn->prepare($st);
        $stmt->bind_param("ss", $id,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<table id='table'><tr><th>Name</th><th>Username</th></tr>";
			while($row = $result->fetch_assoc()) {       
                echo "<tr><td>".$row["sname"]."</td><td>".$row["username"]."</td><br>";	
			}
			echo "</table>";
		}
        
        echo "<br><b>Users from your university:</b>";
        $st= ("SELECT sname,username FROM student WHERE uid=(select uid from student where sid=?) and sid!=?;");                 
        $stmt = $conn->prepare($st);
        $stmt->bind_param("ss", $id,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<table id='table'><tr><th>Name</th><th>Username</th></tr>";
			while($row = $result->fetch_assoc()) {       
                echo "<tr><td>".$row["sname"]."</td><td>".$row["username"]."</td><br>";	
			}
			echo "</table>";
		}
        else
            echo "<br>None<br><br>";
        $friend="no";
        //***************************************Search user***********************************
        if(isset($_COOKIE['username'])) {
            echo "<b>Profile of ".$_COOKIE['username'].":</b><br>";
            $uname=$_COOKIE['username'];
            echo "<input type='hidden' id='uname' value=$uname>";
            setcookie("username", "", time()-1);
            if($uname!=$_SESSION['user']){
                $query= ("select accept from friendrequest where sid=(select sid from student where username=?) and fid=?
                        union
                            select accept from friendrequest where fid=(select sid from student where username=?) and sid=?;");
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssss", $uname,$_SESSION['id'],$uname,$_SESSION['id']);
                $stmt->execute();
                $result = $stmt->get_result();          
                if ($result->num_rows > 0) {
                    $result = $result->fetch_assoc();
                    if($result["accept"]=="yes"){
                        echo "<br>Friends with ".$uname;
                        $friend="yes";
                    }
                    if($result["accept"]=="blocked"){
                        exit();
                    }
                    if($result["accept"]=="pending")
                        echo "Friend request is pending<br>";
                }
                else{       // no entry since no request ever sent
                    echo "<button type='button' id='send'>Send Friend Request</button>";
                }
            }
            if($uname==$_SESSION['user']){
                $friend="yes";
            }
            if($friend=="yes"){
                $query= ("select s.sid,sname,uname, major, gpa, interests, resume from student s, university u where s.uid=u.uid and username=?;");    
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $uname);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<table id='table'><tr><th> Name</th><th>University</th><th>Major</th><th>GPA</th><th>Interests</th><th>Resume</th></tr>";
                    while($row = $result->fetch_assoc()) {       
                        echo "<tr><td>".$row["sname"]."</td><td>".$row["uname"]."</td><td>".$row["major"]."</td><td>".$row["gpa"]."</td><td>".$row["interests"]."</td><td>".$row["resume"]."</td><br>";	
                    }
                    echo "</table>";
                }
            }
            else{
                $query= ("select s.sid,sname,uname from student s, university u where s.uid=u.uid and username=?;");    
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $uname);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<table id='table'><tr><th> Name</th><th>University</th></tr>";
                    while($row = $result->fetch_assoc()) {       
                        echo "<tr><td>".$row["sname"]."</td><td>".$row["uname"]."</td><br>";	
                    }
                    echo "</table>";
                }
            }
        }
    ?>
    
    <script src="js/friend.js"></script>

</body>
</html>
