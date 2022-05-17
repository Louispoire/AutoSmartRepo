<?php
session_start();
include "connectdb.php";
require 'cart_class.php';
if (!isset($_POST["id"])) 
{
    $get_iteminfo_sql = "SELECT car_title FROM car_store WHERE id =".$_POST["sel_item_id"];
    $get_iteminfo_res = $conn->query($get_iteminfo_sql) or die("Couldn't connect");
	
     if ($get_iteminfo_res->num_rows < 1) 
	 {
		echo "yeetus";
		exit();
	 }
	 else
     {
   	    while ($item_info = $get_iteminfo_res->fetch_array()) 
		{
   	    	$car_title =  stripslashes($item_info['car_title']);
			$_SESSION["carTitle"] = $car_title;
		}
	 }
	 $get_itemprice_sql = "SELECT car_price FROM car_store WHERE id =".$_POST["sel_item_id"];
	 $get_itemprice_res = $conn->query($get_itemprice_sql) or die ("Couldn't connect");
	 
	 if ($get_itemprice_res->num_rows < 1)
	 {
		 echo "yeetus";
		 exit();
	 }
	 else
	 {
		//get info
   	    while ($item_infotwo = $get_itemprice_res->fetch_array()) 
		{
   	    	$car_price =  stripslashes($item_infotwo['car_price']);
			$_SESSION["temporaryCarPrice"] = $car_price;
			
		}
	  }
        if (empty($_SESSION["carsList"])) {
		  $cars = array();
		}
		else {
		  $cars = unserialize($_SESSION["carsList"]);
		}
		$_SESSION["carPrice"] = $_SESSION["temporaryCarPrice"] * 1; 
		$_SESSION["carID"] = $_POST["sel_item_id"];
		$_SESSION["carQuantity"] = 1;
		$newCar = new car( $_SESSION["carTitle"], $_SESSION["carID"], $_SESSION["carPrice"],$_SESSION["carQuantity"], $_POST["discount"]);
		array_push($cars, $newCar);
		$_SESSION["carsList"] = serialize($cars);
   	    //redirect to showcart page
   	    header("Location: showcart.php");
  	    exit();
}
else 
{
    header("Location: seestore.php");
    exit();
}
?>
