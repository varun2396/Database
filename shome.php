<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="css/shome.css">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
    </head>
    <body>
        <?php session_start(); ?>
        <div class="topnav">
          <a class="active" href="shome.php">Home</a>
          <a href="notification.php">Notifications</a>
          <a href="message.php">Message</a>
          <a href="friend.php">Friends</a>
          <a href="company.php">Company</a>
          <p class="a">
          <span style="float:right;"><a href="php/logout.php">Signout</a></span>
          <span class="b" style="float:right;">Welcome <?php echo $_SESSION['name'] ?></span></p>
        </div>
        
        <br>
        Job ID:
        <input type="text" placeholder="Enter Job ID" id="jid">
        <button type="button" id="Apply">Apply</button>
        
        <br>
        Job ID:
        <input type="text" placeholder="Enter Job ID" id="jid2">
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
                echo "<button type='button' id='fwd'>Forward</button><br>";
            }
            else
                echo "You have no friends to forward this job.<br>"
        ?>
        <?php           
            $sid=1;
            echo "<br><b>Announcement feed:</b><br><br>";
            $query= ("select aid,cname,a.* from announcement a,company c where c.cid=a.cid order by timestamp desc;");
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
				echo "<table id='table'><tr><th>Job ID</th><th>company name</th><th>location</th><th>title</th><th>salary</th><th>requirements</th><th>description</th></tr>";
				while($row = $result->fetch_assoc()) {       
                    echo "<tr><td>".$row["aid"]."</td><td>".$row["cname"]."</td><td>".$row["location"]."</td><td>".$row["title"]."</td><td>".$row["salary"]."</td><td>".$row["requirements"]."</td><td>".$row["description"]."</td>";	
				}
				echo "</table>";
			}
        ?>
        <script src="js/shome.js"></script>

    </body>
</html>