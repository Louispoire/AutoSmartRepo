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
<div style="font-family: sans-serif; font-size: 125%;">
<?php
//connect to database
require 'cart_class.php';

$display_block = "<h1 style='margin-top: 5%'>Your Shopping Cart</h1>";
	if (isset($_SESSION["carsList"])) 
	{
        $nocars = $_SESSION["carsList"];
		
		if (!empty($_SESSION["carsList"]) && $nocars != "a:0:{}")
		{
		$cars = unserialize($_SESSION["carsList"]);
		$sum = 0;
		$taxes = 0;
		$total_price=0;
		$total1=0;
		foreach($cars as $i)
		{
			$discounts = fopen("salesdiscounts.txt", "r");
			$discountPercentage = 0;
			while (!feof($discounts)) 
			{
				$data = explode(",", fgets($discounts));
				$data = str_replace(array("\r", "\n"), "", $data);
				if (!empty($data)) 
				{
					if ($data[0] == $i->getID()) 
					{
						//$total_price = sprintf("%.02f", $i->getPrice() * $i->getQuantity() - ($i->getPrice() * $i->getQuantity()) * ($data[1] / 100));
						//$sum += $total_price;
						$discountPercentage = $data[1];	
					} 
					else 
					{
						$discountPercentage = 0;
					}
				}
			}
			fclose($discounts);
			$total_price = sprintf("%.02f", $i->getPrice() * $i->getQuantity() - ($i->getPrice() * $i->getQuantity()) * ($discountPercentage / 100));
			$sum += $total_price;
		}
		$taxes = $sum * 0.15;
		$total1 = $taxes+$sum;
		echo "<p style=\"text-align:center\"> Total price without taxes: $" . number_format($sum, 2) ."</p>";
		echo "<p style=\"text-align:center\"> Taxes: $" . number_format($taxes, 2) ."</p>";
		echo "<strong><p style=\"text-align:center\">TOTAL PRICE: $" . number_format($total1, 2) . "</p></strong>";
		echo "<p style=\"text-align:center\"><a href=\"seestore.php\">Continue Shopping</a></p>";
		echo "<p style=\"text-align:center\"><a href=\"removeitems.php\">Empty cart</a>";
		$size ="";
		$color = "";
		$count = -1;
		$display_block .= "
		<table celpadding=\"3\" cellspacing=\"2\" border=\"1\" width=\"98%\">
		<tr>
		<th>Item</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Discount</th>
		<th>Action</th>
		</tr>";
	
        foreach ($cars as $i) 
		{
		$count++;
		$yeet = $i->getPrice() * (1 - $i->getDiscount()/100);
		$id_no = $i->getID();
   	    $display_block .= "
   	    <tr>
   	    <td align=\"center\">" . $i->getTitle() . "<br></td>
   	    <td align=\"center\"> $". number_format($yeet,2) . " <br></td>
   	    <td align=\"center\">" . $i->getQuantity() . "<br></td>
		<td align=\"center\">" . $i->getDiscount() . "%</td>
		<td align=\"center\"><a href=\"removefromcart.php?id=". $count."\"><img src='Images/trashIcon.png' width='20' height='20'></a></td>
		</tr>
		<br>";
		}
		/*
		$shipping = array(
		"slow" => 0.99,
		"normal" => 2.99,
		"express" => 6.99
		);
		
		$_SESSION['ship'] = $shipping;
		*/
        }
        else
        {
            $display_block .= "<p>You have no items in your cart.
            Please <a href=\"seestore.php\">continue to shop</a>!</p>";
        }
    }
	else
	{
	$display_block .= "<p>You have no items in your cart.
    Please <a href=\"seestore.php\">continue to shop</a>!</p>";
	}
    $display_block .= "</table>";
    
?>
<?php 
echo "<div style=\"width: 50%; margin:auto\">".$display_block." </div>";
if (!empty($_SESSION["carsList"]))
{
	echo "<h2 style=\"text-align:center; margin-top: 5%;\"><a href=\"checkout.php\">Checkout</a></h2>";
}
	else
{
	echo "";
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
