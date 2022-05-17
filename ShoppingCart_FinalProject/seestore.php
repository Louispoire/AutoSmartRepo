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
    
/* ======== DROPDOWN LIST CSS ========== */
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
    
* {
  box-sizing: border-box;
}

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

<!-- ============ HEADER AND WEBSITE TITLE ================ -->
<div style="text-align:center; background-color:#ce3235; padding-bottom:2%; padding-top: 2%">
<!--<img style="width: 400px; height= 200px;" src="Images\autosmart.png" alt="Logo" href="Indexx.html">-->
<h1 style="color:white; font-family: sans-serif; font-size: 500%;">Auto Smart Inc.</h1>
</div>

<!-- ============ NAVBAR ================ -->
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

<!-- ============ SEARCH BAR ================ -->
<div style="text-align:center; margin-bottom: 5%">
<form style="margin:auto;max-width:300px" class="search" action="searchCar.php" method="POST">
<input type="text" placeholder="Search.." name="search" id="search" required>
<button type="submit"><i class="fa fa-search"></i></button>
</form>
</div>
    

<!-- ============ STORE COMPONENT ================ -->
<div style="font-family: sans-serif; font-size: 125%;">
<?php
$display_block = "<h1>Categories</h1>
<p>Select a category to see which car is available!.</p>";

    
//show categories first
$get_cats_sql = "SELECT * FROM categories ORDER BY title";
$get_cats_res = mysqli_query($conn, $get_cats_sql);                                                                                                    
//$get_cats_res = $conn->query($get_cats_sql);
    

if(mysqli_num_rows($get_cats_res) < 1) {
   $display_block = "<p><em>Sorry, no categories to browse.</em></p>";
 }
 else{
   while ($cats = mysqli_fetch_assoc($get_cats_res)) {
        $cat_id  = $cats['id'];
        $cat_title = strtoupper(stripslashes($cats['title']));
        $cat_desc = stripslashes($cats['description']);

        $display_block .= "<p><strong><a href=\"".$_SERVER["PHP_SELF"]."?cat_id=".$cat_id."\">".$cat_title."</a></strong><br/>".$cat_desc."</p>";

        if (isset($_GET["cat_id"])) {
			if ($_GET["cat_id"] == $cat_id) {
			   //get items
			   $get_car_sql = "SELECT id, car_title, car_price FROM car_store WHERE cat_id = '".$cat_id."' ORDER BY car_title";
			   //$get_items_res = $conn->query($get_items_sql) or die("Couldn't connect");
                $get_items_res = mysqli_query($conn, $get_car_sql); 

			   if (mysqli_num_rows($get_items_res) < 1/*$get_items_res->num_rows < 1*/) {
					$display_block = "<p><em>Sorry, no items in this category.</em></p>";
					$display_block .= "<ul>";
        }
        else{
					while ($items = mysqli_fetch_assoc($get_items_res)) {
					   $car_id  = $items['id'];
					   $car_title = stripslashes($items['car_title']);
					   $car_price = $items['car_price'];

					   $display_block .= "<li><a href=\"showitem.php?car_id=".$car_id."\">".$car_title."</a></strong> (\$".$car_price.")</li>";
                       
					}

					$display_block .= "</ul>" . "<br>";
                    
				}

				//free results
				$get_items_res->free();

			}
		}
	}
//free results
$get_cats_res->free();
}
//close connection to mysqli
mysqli_close($conn);
?>
<?php echo "<div style=\"width: 50%; margin:auto\">".$display_block." </div>";?>
</div>

<!-- ============ FOOTER ================ -->
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
