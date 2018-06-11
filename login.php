<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="modal">
  <div class="modal-content animate">
    <div class="imgcontainer">
      <img src="img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" id="uname" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" id="pass" placeholder="Enter Password" name="psw" required>
      <label for="utype"><b>What type of user are you?</b></label> 
      <select id='select'>
        <option value="Student">Student</option>
        <option value="Company">Company</option>
      </select>
      <button type="submit" id="login">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <script>
          var i=0;
          for(i=0;i<189;i++)
              document.write("&nbsp;");
      </script>
      <b>Not Registered?</b>
      <button type="button" id="signup" class="signup">Sign up</button>      
    </div>
</div>

<script src="js/login.js"></script>

</body>
</html>