<?php
include "Tables/adminDiscountTable.php";
include('SessionPHP.php'); 
?>
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
     <a class="navbar-brand" href="Indexx.php">
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
<h2 style="text-align:center">Pending reviews:</h2>
<br>
<?php
$xml = simplexml_load_file("comments.xml");
foreach ($xml as $i) 
{
	echo "
		<form style=\"text-align:center\" method=\"get\" action=\"changeStatus.php\">
		<table class='styled-table'>
			<thead>
				<tr>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">#ID</th>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">Username</th>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">Product</th>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">Review</th>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">Current Status</th>
					<th style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">Change Status</th>
				</tr>
			</thead>
			<tr>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">" . $i->ID . "</td>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">" . $i->username . "</td>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">" . $i->product . "</td>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">" . $i->text . "</td>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">" . $i->status . "</td>
				<td style=\"border: 1px solid black; border-collapse: collapse; padding: 10px; text-align:center\">
				<select name=\"st\" id=\"st\">
				<option value=\"acc\">Accepted</option>
				<option value=\"den\">Denied</option>
				</select>
				</td>
			</tr>
		</table>
		<br>
		<button class=\"btn btn-dark\" style=\"background:#5afa95; color: white;\" type=\"submit\">Change Status</button><br>
		<br>
		<input type=\"hidden\" name=\"hiddenfield\" value=\"$i->ID\">
		</form>";
}

?>
<br>
<p style="text-align:center"><a href="admin.php">Return to admin settings</a></p><br>
<footer>
<img style="margin-left: 37%; text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("input").focus(function(){
    $("span").css("display", "inline").fadeOut(2000);
  });
});
</script>
</html>
