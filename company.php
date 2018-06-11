<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/company.css">   
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
</head>
<body>
    <?php session_start(); 
        if($_SESSION['utype']=="Student")
            echo "<div class='topnav'>
                  <a href='shome.php'>Home</a>
                  <a href='notification.php'>Notifications</a>
                  <a href='message.php'>Message</a>
                  <a href='friend.php'>Friends</a>";
        else
            echo "<div class='topnav'>
                  <a class='active' href='chome.php'>Home</a>
                  <a href='post.php'>Post</a>
                  <a href='applicant.php'>Applicants</a>";
      ?>
      <a class="active" href="company.php">Company</a>
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
        echo "<br><b>Enter text in search box to search company:</b><br><br>";
        $id=$_SESSION['id'];

        if(isset($_COOKIE['cname'])) {
            $cname=$_COOKIE['cname'];
            setcookie("cname", "", time()-1);
            $query= ("SELECT cid,cname,location,industry FROM company WHERE cname=?;");    
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $cname);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<table id='table'><tr><th>Name</th><th>Location</th><th>industry</th></tr>";
                while($row = $result->fetch_assoc()) {       
                    echo "<tr><td>".$row["cname"]."</td><td>".$row["location"]."</td><td>".$row["industry"]."</td></tr>";
                    $cid=$row["cid"];                    
                }
                echo "</table>";
                echo "<br><b>Recent announcements by ".$cname."</b><br><br>";          
                $query= ("select * from announcement where cid=? order by timestamp desc;");    
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $cid);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<table id='table'><tr><th>Job ID</th><th>Location</th><th>Title</th><th>Salary</th><th>Requirements</th><th>Description</th></tr>";
                    while($row = $result->fetch_assoc()) {       
                        echo "<tr><td>".$row["aid"]."</td><td>".$row["location"]."</td><td>".$row["title"]."</td><td>".$row["salary"]."</td><td>".$row["requirements"]."</td><td>".$row["description"]."</td></tr>";
                    }
                    echo "</table><br>";
                    echo "<input type='hidden' id='cid' value=".$cid.">";
                    if($_SESSION['utype']=="Student")
                        echo "<button type='button' id='follow'>Follow</button>";
                }
            }
            
        }
    ?>
    
    <script src="js/company.js"></script>

</body>
</html>
