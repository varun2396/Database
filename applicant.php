<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="css/chome.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php session_start();?>
        <div class="topnav">
          <a href="chome.php">Home</a>
          <a href="post.php">Post</a>
          <a class="active" href="applicant.php">Applicants</a>
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
        ?>
        <br><b>Select Job ID:</b>
        <?php 
            $query= ("select aid from announcement where cid=?;");
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
				echo "<select id='jid'>";
				while($row = $result->fetch_assoc()) {       
                    echo "<option value=".$row["aid"].">".$row["aid"]."</option>";	
				}
				echo "</select>";
			}
        ?>
        <button type="button" id="fetch">Fetch</button>
        <?php 
            $cid=$_SESSION['id'];
            $query= ("select * from announcement where cid=? order by timestamp desc;");
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $cid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
				echo "<table id='table'><tr><th>Job Id</th><th>location</th><th>title</th><th>salary</th><th>requirements</th><th>description</th></tr>";
				while($row = $result->fetch_assoc()) {       
                    echo "<tr><td align='center'>".$row["aid"]."</td><td>".$row["location"]."</td><td>".$row["title"]."</td><td>".$row["salary"]."</td><td>".$row["requirements"]."</td><td>".$row["description"]."</td><br>";	
				}
				echo "</table>";
			}

          if(isset($_COOKIE['jid'])) {
              $id=$_COOKIE['jid'];
              setcookie("jid", "", time()-1);
              $query= ("select s.sid,sname,uname, major, gpa, interests, resume from student s, applied a, university u where s.sid=a.sid and s.uid=u.uid and aid=? group by sid;");
              $stmt = $conn->prepare($query);
              $stmt->bind_param("s", $id);
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
        ?>
        
        
        <script src="js/applicant.js"></script>
    </body>
</html>