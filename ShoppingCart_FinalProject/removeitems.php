<?php
session_start();
require 'cart_class.php';
if (isset($_SESSION["carsList"])) 
{
    unset($_SESSION['carsList']);
	header("Location: showcart.php");
}
else
{
    header("Location: seestore.php");
    exit();
}

?>