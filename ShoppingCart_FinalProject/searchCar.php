<?php include('SessionPHP.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartAuto Official Website </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    
/* Style the search field */
form.search input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

/* Style the submit button */
form.search button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.search button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.search::after {
  content: "";
  clear: both;
  display: table;
}
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
<div style="font-family: sans-serif; font-size: 100%;">
<?php
$car_id;
$carIsFound = false;
$searchedCar = mysqli_real_escape_string($conn, $_POST["search"]);
$display_block = "<h1>$searchedCar</h1>";
//$get_car_sql = "SELECT * FROM car_store WHERE car_title = '".$_POST["search"]."'";
//$get_item_res = mysqli_query($conn, $get_car_sql);

$sql = "SELECT * FROM car_store WHERE car_title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $searchedCar);
$stmt->execute();
$result = $stmt->get_result();
    
if (mysqli_num_rows($result) < 1)
{
   echo "<div style='text-align:center; margin-bottom: 5%'>
   <h3 style='text-align:center;'>No results found for <em><strong>$searchedCar</strong></em></h3><br><br>
   <form style='margin:auto;max-width:300px' class='search' action='searchCar.php' method='POST'>
   <input type='text' placeholder='Search..' name='search' id='search' required>
   <button type='submit'><i class='fa fa-search'></i></button>
   </form><br><br>
   <a href='seestore.php'>Go back to store</a>
   </div>"
   ;
 }
 else
 {
   $carIsFound = true;
   while($item_info = $result->fetch_assoc()) {
	   $car_id = $item_info['id'];
	   $car_title = stripslashes($item_info['car_title']);
	   $car_price = $item_info['car_price'];
	   $car_desc = stripslashes($item_info['car_desc']);
	   $car_image = $item_info['car_image'];
	}

	$sql_result = "SELECT id FROM car_store WHERE id = '" . $car_id . "'";
    $res = mysqli_query($conn, $sql_result);
	$id = mysqli_fetch_assoc($res);
	$discounts = fopen("salesdiscounts.txt", "r");
	$yeetus = 0;
	while (!feof($discounts)) 
	{
      $line = explode(",", fgets($discounts));
      $line = str_replace(array("\r", "\n"), "", $line);
      if (!empty($line)) 
	  {
         if ($line[0] == $id["id"]) 
		 {
			$yeetus = $line[1];
            $car_price = $car_price - ($car_price * ($line[1] / 100));
            break;
		 }
	  }
	}
   $display_block .="
   <table cellpadding=\"5\" cellspacing=\"5\">
   <tr>
   <td valign=\"middle\" align=\"center\"><img src=\"Images\\$car_image\"/></td>
   <td valign=\"middle\"><p style=\"margin-left:20%\"><strong>Description:</strong><br>".$car_desc."</p>
   <p style=\"margin-left:20%\"><strong>Price:</strong> $".$car_price."</p>
   <form style=\"margin-left:20%\"method=\"post\" action=\"addtocart.php\">";


   $stmt->free_result();
   //$get_sizes_sql = "SELECT car_size, inv.size_id FROM store_car_size AS sc LEFT JOIN car_inventory AS inv ON sc.size_id = inv.size_id WHERE inv.id = " . $car_id . " 
   //GROUP BY car_size ORDER BY car_size";
   //$get_sizes_res = mysqli_query($conn, $get_sizes_sql);
   
    $sql = "SELECT car_size, inv.size_id FROM store_car_size AS sc LEFT JOIN car_inventory AS inv ON sc.size_id = inv.size_id WHERE inv.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $car_id);
    $stmt->execute();
    $result2 = $stmt->get_result();

  if (mysqli_num_rows($result2) > 0) {

        $temp = "";
        $notEmpty = false;
        while ($sizes = $result2->fetch_assoc()) {
            $car_size = $sizes['car_size'];
            if (!empty($car_size)) {
                if (!empty($_SESSION["size"]) && $_SESSION["size"] == $sizes['size_id']) {
                    $temp .= "<option value=\"" . $sizes['size_id'] . "\" selected>" . $car_size . "</option>";
                    unset($_SESSION["size"]);
                }
                else {
                    $temp .= "<option value=\"" . $sizes['size_id'] . "\">" . $car_size . "</option>";
                }
                $notEmpty = true;
            }
        }
        // Check if needs to display the color
        if ($notEmpty) {
            $display_block .= "<p><strong>Size:</strong> $car_size<br/></p>";
        }
    }

   //free result
   $stmt->free_result();

   $display_block .= "
   <p><strong>Select Quantity:</strong>
   <select name=\"sel_item_qty\">";

   for($i=1; $i<11; $i++) {
       $display_block .= "<option value=\"".$i."\">".$i."</option>";
   }

   $display_block .= "
   </select>
   <input type=\"hidden\" name=\"sel_item_id\" value=\"". $car_id ."\"/>
   <input type=\"hidden\" name=\"discount\" value=\"" . $yeetus . "\">
   <p><input type=\"submit\" name=\"submit\" value=\"Add to Cart\"/></p>
   </form>
   </td>
   </tr>
   </table>";
}
//close connection to mysqli
$conn->close();
?>
    
    
<?php 

if ($carIsFound==true)
{
echo "<div style=\"width: 50%; margin:auto;\">".$display_block." </div>"; 
if (!empty($_SESSION["username"]))
{
		$_SESSION["fProduct"]=$car_title;
		echo "<br><h3 style=\"text-align:center;\"><a href=\"feedback.php\">Post a review!</a></h3><br>";
}
else
{
	echo "";
}
?>
<br>
<h3 style="text-align:center; margin-top: 10%;">REVIEWS</h3>
<br>
<?php
$xml = simplexml_load_file("comments.xml");
foreach ($xml as $i) 
{
	if ($i->product == $car_title && $i->status == "Accepted") 
	{
		
		echo "<p style=\"text-align:center\"><strong>By: " . $i->username . "</strong></p><br>";
		echo "<p style=\"text-align:center\">" . $i->text . "</p><br>";
        echo "<br>";
	}
}
}
else
{
    
}

?>
</div>
<footer>
<img style="margin-left: 37%; text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript"></script>
</body>
</html>
