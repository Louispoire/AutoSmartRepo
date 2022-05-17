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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
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
<div>
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <h4 class="text-warning text-center pt-5">Add new car</h4>
     
      <label>
      <select class="input" name="category">
          <option value="1">Sports Car</option>
          <option value="2">SUV</option>
          <option value="3">Sedans</option>
        </select>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      

    <label>
        <input type="text" class="input" name="cartitle" placeholder="Enter car name:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
    <label>
        <input type="number" class="input" name="carprice" placeholder="Enter price:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    
    <label>
        <input type="text" class="input" name="cardesc" placeholder="Enter car description:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
     <label>
        <input type="number" class="input" name="carstock" placeholder="Enter car current stock:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    
    <label>
      <select class="input" name="carsize">
          <option value="1">Muscle</option>
          <option value="2">Midsize Sedan</option>
          <option value="3">Midsize SUV</option>
          <option value="4">Vividly Horrendous SUV</option>
          <option value="5">Sports Car</option>
        </select>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
        <p><strong>Please note that the image should be 480 x 360</strong></p>
        <input type="text" class="input" name="carimage" placeholder="Enter image url:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    <button class="normal-button" type="submit">Add car</button>
  </form>
</div>
<?php
if (!empty($_POST))
{
    $cat = mysqli_real_escape_string($conn, $_POST["category"]);
    $title = mysqli_real_escape_string($conn, $_POST["cartitle"]);
    $price = mysqli_real_escape_string($conn, $_POST["carprice"]);
    $desc = mysqli_real_escape_string($conn, $_POST["cardesc"]);
    $image = mysqli_real_escape_string($conn, $_POST["carimage"]);
    $stock = mysqli_real_escape_string($conn, $_POST["carstock"]);
    $selectedSize = mysqli_real_escape_string($conn, $_POST["carsize"]);

    $sql = "SELECT * FROM car_store WHERE car_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $title);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) 
    { 
        echo "<p style='color:red; text-align:center;  font-family: sans-serif; font-size: 125%;'>Car already exist in database!</p>";
    }
    else
    {
        $sql = "INSERT INTO car_store (cat_id, car_title, car_price, car_desc, car_image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isiss', $cat, $title, $price, $desc, $image);
        $stmt->execute();
        
        $sql = "INSERT INTO car_inventory (item, size_id, car_stock) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $title, $selectedSize, $stock);
        $stmt->execute();
        
        echo "<h2 style='text-align:center;  font-family: sans-serif; font-size: 125%;'>Car added!</h2>";

        $conn->close();
    }

}
else
{

}
    
?>
<p style="text-align:center; margin-top: 5%;"><a href="manageInventory.php">Return to Inventory Manager</a></p>
<br>
<footer style="text-align:center">
<img style="text-align:center; height: 200px; width: 400px" src="https://www.logolynx.com/images/logolynx/3a/3a7fbf8a460effa698ae1ad25f26dd0f.png" alt="Security">
<p style="text-align:center">2021 AutoSmart Inc. All rights reserved. </p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
</script>
</body>
</html>