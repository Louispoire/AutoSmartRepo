<?php include('SessionPHP.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartAuto Official Website </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
<!-- ============================ HEADER ================================= -->
<div style="text-align:center; background-color:#ce3235; padding-bottom:2%; padding-top: 2%">
<!--<img style="width: 400px; height= 200px;" src="Images\autosmart.png" alt="Logo" href="Indexx.html">-->
<h1 style="color:white; font-family: sans-serif; font-size: 500%;">Auto Smart Inc.</h1>
</div>

<!-- ============================ NAVBAR ================================= -->
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

<!-- ============================ COMPONENT 1 ================================= -->
<h2 style="text-align:center">Add new discounts:</h2>
<h4 style="text-align:center">Store</h4>
<div style="text-align:center">
<br>

<?php
	$count=0;
    $filecount = 0;
    $continueLoop;
	$filename = "salesdiscounts.txt";
    $contents = file($filename);
    $fileData = fopen($filename, "r");
	if (file_exists($filename)) 
	{
		echo "<strong><p style=\"text-align:center\">Discounts file connected.</strong></p>";
	}
    else
    {
        echo "<strong><p style=\"text-align:center\">Discounts file not connected.</strong></p>";
    }
          
	$get_order_sql = "SELECT car_title,id FROM car_store";
    $get_order_res = mysqli_query($conn, $get_order_sql);
	echo "<form method=\"get\" action=\"textfile.php\">";
	if (mysqli_num_rows($get_order_res) > 0) 
    {
        if (filesize("salesdiscounts.txt") != 0)
        {
                while($row = $get_order_res->fetch_assoc()) 
                {
                       $count++;
                       $continueLoop = false;
                    
                       /*
                       while (!feof($fileData)) 
                       {
                            $line = fgets($fileData);
                            $data = explode(",", $line);
                            $car_id = $data[0];
                            //if (strpos($car_id, strval($row["id"])) !== false && !empty($line))
                            
                            */
                        foreach ($contents as $line) 
                        {
                            $explodedLine = explode(',', $line);
                            //if ($car_id == $row["id"])
                            if (strpos($explodedLine[0], strval($row["id"])) !== false && !empty($line))
                            {
                                //echo "<div style=\"text-align:center\"><p>" . $row["car_title"]. " | ID: ". $row["id"]. "</p><p style='color:red'>Discount already applied</p><br>";
                                echo "";
                                $continueLoop = true;
                                continue;

                            }
                            else if (empty($line))
                            {
                                $continueLoop = true;
                                break;
                            }
                        }
                        if ($continueLoop == true)
                        {
                            continue;

                        }
                        else
                        {
                            echo "<div style=\"text-align:center\"><p>" . $row["car_title"]. " | ID: ". $row["id"]. "</p><input style=\"text-align:center\" id=\"$count\" type=\"number\" name=\"$count\" min=\"0\" max=\"100\" value=\"0\" placeholder=\"Enter Discount\"></div><br>";
                        }
                }
            }
            else
            {
                while($row = $get_order_res->fetch_assoc()) 
                {
                    $count++;
                    echo "<div style=\"text-align:center\"><p>" . $row["car_title"]. " | ID: ". $row["id"]. "</p><input style=\"text-align:center\" id=\"$count\" type=\"number\" name=\"$count\" min=\"0\" max=\"100\" value=\"0\" placeholder=\"Enter Discount\"></div><br>";
                }
            
            }
        
        echo "<div style=\"text-align:center\"><input type=\"submit\" name=\"print\" id=\"print\" value=\"Add discounts\"></div>";
	    echo "</form><br>";

    }
	else 
    {
	   echo "0 results";
	}
	$conn->close();
?>
</div>
<br>
<p style="text-align:center"><a href="currentDiscounts.php">Return to Dis-Manager</a></p><br>
<footer>
<img style="margin-left: 37%; text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>

<!-- ============================ FOOTER ================================= -->
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript"></script>
<script>
$(document).ready(function(){
  $("input").focus(function(){
    $("span").css("display", "inline").fadeOut(2000);
  });
});
</script>
</body>
</html>
