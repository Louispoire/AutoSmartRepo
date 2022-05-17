<?php
session_start();
require 'cart_class.php';
if (isset($_SESSION["carsList"])) 
{
	$items = unserialize($_SESSION["carsList"]);
	array_splice($items, $_GET["id"], 1);
	$_SESSION["carsList"] = serialize($items); 
	if (empty($_SESSION["carsList"]))
	{
		session_destroy();
	}
	header("Location: showcart.php");
}
else
{

    header("Location: seestore.php");
    exit();
}

?>
