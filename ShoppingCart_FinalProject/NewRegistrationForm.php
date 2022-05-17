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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
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
<div>
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <h4 class="text-warning text-center pt-5">Sign Up</h4>
    <label>
      <input type="text" class="input" name="email" placeholder="Enter email:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
        <input type="text" class="input" name="fname" placeholder="Enter first name:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
    <label>
        <input type="text" class="input" name="lname" placeholder="Enter last name:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    
    <label>
        <input type="text" class="input" name="uname" placeholder="Enter username:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
        <input type="password" class="input" name="pass" placeholder="Enter password:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
      <input type="password" class="input" name="checkpass" placeholder="Confirm password:"/>
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>
    <button class="normal-button" type="submit">submit</button>
  </form>
</div>
<?php
if (!empty($_POST))
{
$firstname = mysqli_real_escape_string($conn, $_POST["fname"]);
$lastname = mysqli_real_escape_string($conn, $_POST["lname"]);
$username = mysqli_real_escape_string($conn, $_POST["uname"]);
$password = mysqli_real_escape_string($conn, $_POST["pass"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$checkPassword = mysqli_real_escape_string($conn, $_POST["checkpass"]);
$rank = "user";
	//check if password match
	if ($password == $checkPassword)
	{
            $encrypted_password = md5($password);
            try
            {
                $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssss', $firstname, $lastname, $username, $encrypted_password, $email);
                $results = $stmt->execute();
                if (false == $results)
                {
                    echo "<p style='color:red; text-align:center;  font-family: sans-serif; font-size: 125%;'>Username already taken</p>";
                }
                else
                {
                    echo "<p style='color:green; text-align:center;  font-family: sans-serif; font-size: 125%;'>Account created!</p>";
                    echo "<p style='text-align:center;  font-family: sans-serif; font-size: 125%;'><a href='LoginChoice.php'>Go Back</a></p>";
                }
            } 
            catch(Exception $e) 
            {
                echo $e->getMessage();
            }
        
   
        
			//we read the file in order to extract the values inside
            /*
			$fileData = fopen($accounts, "r");
			$line = fgets($fileData);
			$line = str_replace(array("\r", "\n"), "", $line);
			$data1 = explode(",", $line);
			//here, we compare the first string of the file to the username entered in the form
			//if the not the same
			if ($data1[0] != $name)
			{
				$data2 = "$name,$password1,$email\n";
				file_put_contents($accounts, $data2, FILE_APPEND);
				echo "<strong><p style=\"text-align:center\">Account Created! </strong></p>";
				echo "<div style=\"text-align:center\"><a href=\"LoginChoice.php\">Return to login</a></div>";
			}
			//if the same
			else
			{
				echo "<strong><p style=\"text-align:center; color:red;\">Username already exist</p></strong>";
			}
            */  
	}
	else
	{
		//Here are the error message if the password doesn't match
		echo "<strong><p style=\"text-align:center; color:red;\">Password doesn't match</p></strong>";
		echo "<strong><p style=\"text-align:center; color:red;\">Try again!</p></strong>";
	}

}
    $conn->close();
?>
<br>
<footer style="text-align:center">
<img style="text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
</script>
</body>
</html>