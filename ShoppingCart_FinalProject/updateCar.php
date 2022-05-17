<?php
include "connectdb.php";
if (!empty($_POST))
{
    $carid_num = mysqli_real_escape_string($conn, $_POST["carid"]);
    $cat = mysqli_real_escape_string($conn, $_POST["category"]);
    $title = mysqli_real_escape_string($conn, $_POST["cartitle"]);
    $price = mysqli_real_escape_string($conn, $_POST["carprice"]);
    $desc = mysqli_real_escape_string($conn, $_POST["cardesc"]);
    $image = mysqli_real_escape_string($conn, $_POST["carimage"]);
    $stock = mysqli_real_escape_string($conn, $_POST["carstock"]);
    $selectedSize = mysqli_real_escape_string($conn, $_POST["carsize"]);
    

    $sql = "UPDATE car_store SET cat_id = ?, car_title = ?, car_price = ?, car_desc = ?, car_image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isissi', $cat, $title, $price, $desc, $image, $carid_num);
    $stmt->execute();
    


    $sql1 = "UPDATE car_inventory SET item = ?, size_id = ?, car_stock = ? WHERE id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('siii', $title, $selectedSize, $stock, $carid_num);
    $stmt1->execute();
    
    echo "<p style='text-align:center;  font-family: sans-serif; font-size: 125%;'>CarUpdated</p>";
    echo "<p style='text-align:center; margin-top: 5%;'><a href='manageInventory.php'>Return to Inventory Manager</a></p>";
    
    $conn->close();
}


else
{

}
?>