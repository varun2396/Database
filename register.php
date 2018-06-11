<html>
<head>
    <link rel="stylesheet" href="css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="modal">
  <form class="modal-content animate">
    <div class="container" method="post" id="form" action=""> 
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      
      <label for="utype"><b>What type of user are you?</b></label> 
      <select id='select'>
        <option value="Student">Student</option>
        <option value="Company">Company</option>
      </select>
      <br>
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" id="uname" >

      <label for="pass"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" id="pass" >

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" id="pass2" name="psw-repeat" >
        
        <div id="company" style="display:none">
          <label for="cname"><b>Company Name</b></label>
          <input type="text" placeholder="Enter Name" id="cname" >
          <label for="industry"><b>Industry</b></label>
          <input type="text" placeholder="Enter industry" id="industry" >
          <label for="location"><b>location</b></label>
          <input type="text" placeholder="Enter location" id="location" >
        </div>
        
        <div id="student">
          <label for="sname"><b>Student Name</b></label>
          <input type="text" placeholder="Enter Name" id="sname" >
          <label for="university"><b>University</b></label>
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
                $query= ("select * from university;");
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<select id='university'>";
                    while($row = $result->fetch_assoc()) {       
                        echo "<option value=".$row["uid"].">".$row["uname"]."</option>";	
                    }
				echo "</select><br><br>";
                }
              ?>
          <label for="major"><b>Major</b></label>
          <input type="text" placeholder="Enter major" id="major" >
          <label for="gpa"><b>GPA</b></label>
          <input type="text" placeholder="Enter gpa" id="gpa" >
          <label for="interests"><b>Interests</b></label>
          <input type="text" placeholder="Enter interests" id="interests" >
          <label for="resume"><b>Resume</b></label><br>
          <textarea placeholder="Copy paste your resume" id="resume" cols="100" rows="40"></textarea>
        </div>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" id="cancelbtn" class="cancelbtn">Cancel</button>
        <button type="submit" id="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script src="js/register.js"></script>

</body>
</html>
