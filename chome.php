<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="css/chome.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php session_start();?>
        <div class="topnav">
          <a class="active" href="chome.php">Home</a>
          <a href="post.php">Post</a>
          <a href="applicant.php">Applicants</a>
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
            $cid=$_SESSION['id'];
            echo "<br><b>Your recent job announcements:</b>";
            $query= ("select * from announcement where cid=? order by timestamp desc;");
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $cid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
				echo "<table id='table'><tr><th>Job Id</th><th>location</th><th>title</th><th>salary</th><th>requirements</th><th>description</th></tr>";
				while($row = $result->fetch_assoc()) {       
                    echo "<tr><td align='center'><a href='#' class='a'>".$row["aid"]."</a></td><td>".$row["location"]."</td><td>".$row["title"]."</td><td>".$row["salary"]."</td><td>".$row["requirements"]."</td><td>".$row["description"]."</td><br>";	
				}
				echo "</table>";
			}
            echo "<br><b>Click on Job ID to find total number of applicants<br><br>";
            
            echo "Click the button to forward a job to specific students";
            echo "<button type='button' id='forward'>Forward</button><br><br>"
        ?>
        
        Select Job ID to delete the job announcement: 
        <?php 
                    $query= ("select aid from announcement where cid=?;");
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $_SESSION['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        echo "<select id='aid'>";
                        while($row = $result->fetch_assoc()) {       
                            echo "<option value=".$row["aid"].">".$row["aid"]."</option>";	
                        }
                        echo "</select>";
                    }
                ?>
        <button type='button' id='delete'>Delete</button>
        
        <div class="modal" id="modal">
          <div class="modal-content animate">
            <p align="center">Filter</p>
            <span class="close">&times;</span>
            <div class="container">
              <label for="jid"><b>Job ID</b></label>
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
                        echo "</select><br>";
                    }
                ?>
              <label for="uname"><b>University</b></label>
              <?php
                $query= ("select * from university;");
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<select id='select'><option value='' selected disabled hidden>Choose here</option>";
                    while($row = $result->fetch_assoc()) {       
                        echo "<option value=".$row["uid"].">".$row["uname"]."</option>";	
                    }
				echo "</select><br>";
                }
              ?>

              <label for="major"><b>Major</b></label>
              <input class="t" type="text" id="major" placeholder="Enter Major" name="major">
              
              <label for="gpa"><b>GPA</b></label>
              <input class="t" type="text" id="gpa" placeholder="Enter GPA" name="gpa">
              <label for="resume"><b>Resume</b></label>
              <input class="t" type="text" id="resume" placeholder="Enter Major" name="resume">
              <br>
              <button type="submit" id="filter" class="b">Forward</button>
            </div>
          </div>
        </div>
        <script src="js/chome.js"></script>
    </body>
</html>