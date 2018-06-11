<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="css/post.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php session_start();?>
        <div class="topnav">
          <a href="chome.php">Home</a>
          <a class="active" href="post.php">Post</a>
          <a href="applicant.php">Applicants</a>
          <a href="company.php">Company</a>
          <p class="a">
          <span style="float:right;"><a href="php/logout.php">Signout</a></span>
          <span class="b" style="float:right;">Welcome <?php echo $_SESSION['name'] ?></span></p>
        </div>
        <br><b>Post new announcement:</b><br><br>
        
        <div>
            <label for="location"><b>Location</b></label>
            <input class="t" type="text" id="location" placeholder="Enter location" name="location">
            <label for="title"><b>Title</b></label>
            <input class="t" type="text" id="title" placeholder="Enter title" name="title">
            <label for="salary"><b>Salary</b></label>
            <input class="t" type="text" id="salary" placeholder="Enter salary" name="salary">
            <label for="requirement"><b>Requirements</b></label>
            <input class="t" type="text" id="requirement" placeholder="Enter requirements" name="requirement">
            <label for="desc"><b>Description</b></label>
            <input class="t" type="text" id="desc" placeholder="Enter description" name="desc">
        </div>
        
        <button type="button" id="post">Post</button>
        
        
        <script src="js/post.js"></script>
    </body>
</html>