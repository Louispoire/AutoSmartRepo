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


.align-center {
    text-align: center;
}
.hash-list {
    display: block;
    padding: 0;
    margin: 0 auto;
}

@media (min-width: 768px){
    .hash-list.cols-3 > li:nth-last-child(-n+3) {
        border-bottom: none;
    }
}
@media (min-width: 768px){
    .hash-list.cols-3 > li {
        width: 33.3333%;
    }
}
.hash-list > li {
    display: block;
    float: left;
    border-right: 1px solid rgba(0, 0, 0, 0.2);
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}
.pad-30, .pad-30-all > * {
    padding: 30px;
}
img {
    border: 0;
}
.mgb-20, .mgb-20-all > * {
    margin-bottom: 20px;
}
.wpx-100, .wpx-100-after:after {
    width: 100px;
}
.img-round, .img-rel-round {
    border-radius: 50%;
}
.padb-30, .padb-30-all > * {
    padding-bottom: 30px;
}

.mgb-40, .mgb-40-all > * {
    margin-bottom: 40px;
}
.align-center {
    text-align: center;
}
[class*="line-b"] {
    position: relative;
    padding-bottom: 20px;
    border-color: #E6AF2A;
}
.fg-text-d, .fg-hov-text-d:hover, .fg-active-text-d.active {
    color: #222;
}
.font-cond-b {
    font-weight: 700 !important;
    }

.normal-button {
  display: inline-block;
  padding: 12px 24px;
  background: rgb(220,220,220);
  font-weight: bold;
  color: rgb(120,120,120);
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
  transition: ease .3s;
} 

.normal-button:hover {
  background: #8BC34A;
  color: #ffffff;
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
<?php

$discounted = "";
$get_car_sql = "SELECT c.id as id, c.title, si.car_title, si.car_price, si.car_desc, si.car_image FROM car_store AS si LEFT JOIN categories AS c on c.id = si.cat_id WHERE si.id = '".$_GET["car_id"]."'";
$get_item_res = mysqli_query($conn, $get_car_sql);
if (mysqli_num_rows($get_item_res) < 1)
{
   echo "<p><em>Invalid item selection.</em></p>";
 }
 else
 {
   while($item_info = mysqli_fetch_assoc($get_item_res)) 
   {
	   $cat_id = $item_info['id'];
	   $cat_title = strtoupper(stripslashes($item_info['title']));
	   $car_title = stripslashes($item_info['car_title']);
	   $car_price = $item_info['car_price'];
	   $car_desc = stripslashes($item_info['car_desc']);
	   $car_image = $item_info['car_image'];
	}
    
    

	$sql_result = "SELECT id FROM car_store WHERE id = '" . $_GET["car_id"] . "'";
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
            $discounted = "ON SALE";
            break;
            
		 }
	  }
	}

	
   
   $returnButton = "<p><strong><em>You are viewing:</em><br/>
   <a href=\"seestore.php?cat_id=".$cat_id."\" > ".$cat_title."</a> &gt; ".$car_title."</strong></p>";
     

   $get_item_res->free();

   $get_sizes_sql = "SELECT car_size, inv.size_id FROM store_car_size AS sc LEFT JOIN car_inventory AS inv ON sc.size_id = inv.size_id WHERE inv.id = " . $_GET["car_id"] . " 
   GROUP BY car_size ORDER BY car_size";
   $get_sizes_res = mysqli_query($conn, $get_sizes_sql);


  if (mysqli_num_rows($get_sizes_res) > 0) {

        $temp = "";
        $notEmpty = false;
        while ($sizes = mysqli_fetch_assoc($get_sizes_res)) {
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
    }

   //free result
   $get_sizes_res->free();
}
//close connection to mysqli
$conn->close();
?>
<div class="container" style="font-family: sans-serif; font-size: 100%; border: 1px solid grey;">
  <div class="row">
    <div class="col-sm-6">
      <img style="margin-top: 5%; margin-bottom: 5%" src="Images\<?php echo $car_image; ?>"/>
    </div>
    <div class="col-sm-6">
      <p><?php echo $returnButton; ?></p>
      <h2><?php echo $car_title; ?></h2>
	  <p><?php echo $car_desc; ?></p>
      <p><strong>Characteristic</strong></p>
      <ul>
          <li><?php echo "$$car_price <p style='color:red'>$discounted</p>"; ?></li>
          <li><?php echo $car_size; ?></li>
      </ul>
      <?php echo "<form style=\"margin-top: 5%;\"method=\"post\" action=\"addtocart.php\">
   <input type=\"hidden\" name=\"sel_item_id\" value=\"".$_GET["car_id"]."\"/>
   <input type=\"hidden\" name=\"discount\" value=\"" . $yeetus . "\">
   <p><input type=\"submit\" class=\"normal-button\" name=\"submit\" value=\"Add to Cart\"/></p>
   </form>"; ?>
    </div>
  </div>
</div>
<?php
if (!empty($_SESSION["username"]))
{
		$_SESSION["fProduct"]=$car_title;
		echo "<br><h3 style=\"text-align:center\"><a href=\"feedback.php\">Post a review!</a></h3><br>";
}
else
{
	echo "<br><h2 style=\"text-align:center\">You must be signed in to post a review!</h2>";
    echo "<br><h5 style=\"text-align:center\"><a href=\"LoginChoice.php\">Sign in</a></h5><br><br><br>";
}
?>
<div class="container">
    <div class="mgb-40 padb-30 auto-invert line-b-4 align-center">
        <h4 class="font-cond-b fg-text-d lts-md fs-300 fs-300-xs no-mg" contenteditable="false">Some reviews</h4>
    </div>
    <ul class="hash-list cols-3 cols-1-xs pad-30-all align-center text-sm">
        <?php
        $maxReviews = 0;
        $xml = simplexml_load_file("comments.xml");
        foreach ($xml as $i) 
        {
               if ($i->product == $car_title && $i->status == "Accepted") 
               {
                   $maxReviews++;
                   if ($maxReviews > 4)
                   {
                       break;
                   }
                   else
                   {
                       echo "<li>
                            <img src='https://bootdey.com/img/Content/avatar/avatar1.png' class='wpx-100 img-round mgb-20' data-edit='false' data-editor='field' data-field='src[Image Path]; title[Image Title]; alt[Image Alternate Text]'>
                            <p class='fs-110 font-cond-l' contenteditable='false'>$i->text</p>
                            <h5 class='font-cond mgb-5 fg-text-d fs-130' contenteditable='false'>$i->username</h5>
                        </li>";
                   }

               }
        }
        
        ?>
      </ul>
</div>
<footer style="margin-top: 20%;">
<img style="margin-left: 40%; text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript"></script>
</body>
</html>
