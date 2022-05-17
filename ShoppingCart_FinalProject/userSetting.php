<?php include('SessionPHP.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartAuto Official Website </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="designstyling.css">
</head>
      
<style>
    
/*DROPDOWN LIST CSS */
.dropbtn {
  color: white;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
    
    
    
<body>
<div style="text-align:center; background-color:#ce3235; padding-bottom:2%; padding-top: 2%">
<!--<img style="width: 400px; height= 200px;" src="Images\autosmart.png" alt="Logo" href="Indexx.html">-->
<h1 style="color:white; font-family: sans-serif; font-size: 500%;">Auto Smart Inc.</h1>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" style="margin-bottom: 5%;">
  <div class="container">
     <a class="navbar-brand" href="#">
          <img style="width: 80px; height= 60px;" src="Images\carLogo.png" alt="">
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="Indexx.php">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="seestore.php">Store</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ContactUs.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showcart.php">Cart</a>
        </li>
        <li class="nav-item">
         <?php echo $submenu; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h2 style="text-align:center;">Account Information</h2>
<br>
<?php
if (!empty($_SESSION["username"])){
    $checkUsername = $_SESSION["username"];
    $getUser = "SELECT * FROM users WHERE username = '$checkUsername'";
    $getUser_res = mysqli_query($conn, $getUser); 
    if(mysqli_num_rows($getUser_res) == 0) {
        echo "<p style=\"text-align:center\">Error has occured. Please contact support";
    }
    else
    {
        while ($userInfo = mysqli_fetch_assoc($getUser_res)) 
        {
            $firstname  = $userInfo['firstname'];
            $lastname = $userInfo['lastname'];
            $username = $userInfo['username'];
            $email = $userInfo['email'];
            $rank = $userInfo['user_rank'];
            
            if ($rank == "user")
            {
                echo "<div style='text-align:center'>";
                echo "<h3>Username: $username</h3>" . "<br><br>";
                echo "<p>First Name: $firstname</p>" . "<br>";
                echo "<p>Last Name: $lastname</p>" . "<br>";
                echo "<p>Email: $email</p>" . "<br><br>";
                echo "<p style=\"text-align:center\"><a href=\"userLogout.php\">Logout</a></p>";
                echo "</div>";
            }
            else
            {
                echo "<div style='text-align:center'>";
                echo "<h3>Username: $username</h3>" . "<br><br>";
                echo "<p>First Name: $firstname</p>" . "<br>";
                echo "<p>Last Name: $lastname</p>" . "<br>";
                echo "<p>Email: $email</p>" . "<br>";
                echo "<p style=\"text-align:center; padding-bottom:5%\"><a href=\"admin.php\">Admin Settings</a></p>" . "<br><br>";
                echo "<p style=\"text-align:center\"><a href=\"userLogout.php\">Logout</a></p>";
                echo "</div>";
            }
        }
    }
}
else
{
	echo "<p style=\"text-align:center\"><strong>Not connected</strong></p>";
	echo "<p style=\"text-align:center\"><a href=\"LoginChoice.php\">Please connect</a></p>";
}
?>
<br>
<footer style="text-align:center">
<img style="text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript"></script>
</body>
</html>
