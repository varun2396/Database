<html>
    <head>
        <title>Notifications</title>
        <link rel="stylesheet" href="css/notification.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php session_start(); ?>
        <div class="topnav">
          <a href="shome.php">Home</a>
          <a class="active" href="notification.php">Notifications</a>
          <a href="message.php">Message</a>
          <a href="friend.php">Friends</a>
          <a href="company.php">Company</a>
          <p>
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
            $sid=$_SESSION['id'];
            
            $query= ("select s.sid,sname from friendrequest f, student s where s.sid=f.sid and accept='pending' and fid=? order by timestamp desc;");
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<b>Friend requests from :</b> <select id='friend'>";
                while($row = $result->fetch_assoc()) {  
                                 
                    echo "<option value=".$row["sid"].">".$row["sname"]."</option>";	//value is sid of student
                }
                echo "</select>";
                echo "<button type='button' id='accept'>Accept</button>";
                echo "<button type='button' id='reject'>Reject</button>";
                echo "<button type='button' id='block'>Block</button>";
            }        
            $query= ("select aid,cname,a.* from announcement a,company c where c.cid=a.cid and aid in (select aid from notifyme where sid=?)  order by timestamp desc;");
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
				echo "<br><b>Recent job notifications:</b><br><table id='table'><tr><th>Job ID</th><th>company name</th><th>location</th><th>title</th><th>salary</th><th>requirements</th><th>description</th></tr>";
				while($row = $result->fetch_assoc()) {       
                    echo "<tr><td>".$row["aid"]."</td><td>".$row["cname"]."</td><td>".$row["location"]."</td><td>".$row["title"]."</td><td>".$row["salary"]."</td><td>".$row["requirements"]."</td><td>".$row["description"]."</td><br>";	
				}
				echo "</table>";
			}
        ?>
        <br>
        Job ID:
        <input type="text" placeholder="Enter Job ID" id="jid">
        <button type="button" id="Apply">Apply</button>
        
        <br>
        Job ID:
        <input type="text" placeholder="Enter Job ID" id="jid2">
            <?php
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
                echo "<button type='button' id='fwd'>Forward</button>";
            }
            else
                echo "You have no friends to forward this job."
        ?>
        
        <script src="js/notification.js"></script>
    </body>
</html>