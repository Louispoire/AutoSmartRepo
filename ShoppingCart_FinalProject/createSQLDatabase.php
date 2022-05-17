<?php

$conn = mysqli_connect("127.0.0.1","root","","carstoredb_v1","3308");
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}

//TABLE CREATION SCRIPT


//-------------- Car Store ---------------------
$sql_car_store = "CREATE TABLE  car_store (
  id int(11) NOT NULL AUTO_INCREMENT,
  cat_id int(11) NOT NULL,
  car_title varchar(75) DEFAULT NULL,
  car_price float DEFAULT NULL,
  car_desc varchar(250) DEFAULT NULL,
  car_image varchar(50) DEFAULT NULL,
  PRIMARY KEY (id)
)";

if (mysqli_query($conn, $sql_car_store)) 
{
    echo "2- table car_store created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating table car_store: " . mysqli_error($conn);
}

$sql_insert_car_store = "INSERT INTO car_store (id, cat_id, car_title, car_price, car_desc, car_image) VALUES
(1, 1, 'Dodge Demon', 100000, 'The heart of this demonic Challenger is its 808-hp supercharged 6.2-liter Hemi V-8', 'demon.jpeg'),
(2, 1, 'Fiat 500 Abarth', 35000, '160-hp turbocharged four-cylinder Italian car with a great handling, speed and fabulous design', 'fiat500abarth.jpg'),
(3, 3, 'Mercedes E-Class', 56000, 'The 2021 Mercedes-Benz E-class epitomizes sophistication with its bleeding technology, classy appearance, and extravagant cabin', 'eclass.jpeg'),
(4, 3, 'BMW Series 5', 65800, 'If quiet luxury and handsome styling are high on your new-car priorities list, the 2021 BMW 5-series sedan could very well be the answer', 'bmw5.jpeg'),
(5, 2, 'Nissan Juke', 26800, 'Ugly, but reliable. Will go from point A to point B', 'juke.jpeg'),
(6, 2, 'PT Cruiser', 5785, 'Used PT Cruiser GT. This car is very delicious, beautiful and, quite frankly, sexy. You will become a love symbol while driving this car, guaranteed!' , 'ptcruiser.jpeg');";

if (mysqli_query($conn, $sql_insert_car_store)) 
{
    echo "Data successfully inserted in table car_store";
    echo "<br><br>";
} 
else
{
    echo "Error inserting data: " . mysqli_error($conn);
}

//-------------- Categories ---------------------
$sql_categories = "CREATE TABLE categories (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(50) DEFAULT NULL,
  description varchar(150) DEFAULT NULL,
  PRIMARY KEY (id)
)";

if (mysqli_query($conn, $sql_categories)) 
{
    echo "3- table categories created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating table categories: " . mysqli_error($conn);
}

$sql_insert_categories = "INSERT INTO categories (id, title, description) VALUES
(1, 'Sports Car', 'Great sports car for the braves!'),
(2, 'SUV', 'To go above and beyond!'),
(3, 'Sedans', 'For the enthusiast who wants more!');";

if (mysqli_query($conn, $sql_insert_categories)) 
{
    echo "Data successfully inserted in table categories";
    echo "<br><br>";
} 
else
{
    echo "Error inserting data: " . mysqli_error($conn);
}

//-------------- store_car_size ---------------------
$sql_store_car_size ="CREATE TABLE store_car_size (
  size_id int(11) NOT NULL AUTO_INCREMENT,
  car_size varchar(25) DEFAULT NULL,
  PRIMARY KEY (size_id),
  UNIQUE KEY size_id_UNIQUE (size_id)
)";

if (mysqli_query($conn, $sql_store_car_size)) 
{
    echo "4- table store_car_size created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating table store_car_size: " . mysqli_error($conn);
}

$sql_insert_store_car_size = "INSERT INTO store_car_size (size_id, car_size) VALUES
(1, 'Muscle'),
(2, 'Midsize Sedan'),
(3, 'Midsize SUV'),
(4, 'Vividly Horrendous SUV'),
(5, 'Sports Car');";

if (mysqli_query($conn, $sql_insert_store_car_size)) 
{
    echo "Data successfully inserted in table store_car_size";
    echo "<br><br>";
} 
else
{
    echo "Error inserting data: " . mysqli_error($conn);
}

//-------------- Car Inventory ---------------------
$sql_car_inventory = "CREATE TABLE car_inventory (
  item varchar(255) DEFAULT NULL,
  id int(11) NOT NULL AUTO_INCREMENT,
  size_id int(11) NOT NULL,
  car_stock int(11) NOT NULL,
  PRIMARY KEY (id,size_id),
  KEY fk_car_inventory_car_store_idx (id),
  KEY fk_car_inventory_store_car_size1_idx (size_id)
)";

if (mysqli_query($conn, $sql_car_inventory)) 
{
    echo "5- table car_inventory created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating table car_inventory: " . mysqli_error($conn);
}

$sql_insert_car_inventory = "INSERT INTO car_inventory (item, id, size_id, car_stock) VALUES
('Dodge Demon', 1, 1, 3),
('Fiat 500 Abarth', 2, 5, 5),
('Mercedes E-Class', 3, 2, 7),
('BMW Series 5', 4, 2, 2),
('Nissan Juke', 5, 3, 14),
('PT Cruiser', 6, 3, 1);";

if (mysqli_query($conn, $sql_insert_car_inventory)) 
{
    echo "Data successfully inserted in table car_inventory";
    echo "<br><br>";
} 
else
{
    echo "Error inserting data: " . mysqli_error($conn);
}

$sql_car_inventory_constraints = "ALTER TABLE car_inventory
  ADD CONSTRAINT fk_car_inventory_car_store FOREIGN KEY (id) REFERENCES car_store (id) ON DELETE CASCADE,
  ADD CONSTRAINT fk_car_inventory_store_car_size1 FOREIGN KEY (size_id) REFERENCES store_car_size (size_id) ON DELETE CASCADE;";

if (mysqli_query($conn, $sql_car_inventory_constraints)) 
{
    echo "Constraints added for car_inventory";
    echo "<br><br>";
} 
else
{
    echo "Error adding constraints: " . mysqli_error($conn);
}

//-------------- Users ---------------------
$sql_users = "CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  firstname varchar(125) DEFAULT NULL,
  lastname varchar(125) DEFAULT NULL,
  username varchar(125) UNIQUE NOT NULL,
  password varchar(300) NOT NULL,
  email varchar(125) DEFAULT NULL,
  user_rank varchar(125) DEFAULT NULL DEFAULT 'user',
  PRIMARY KEY (id)
)";

if (mysqli_query($conn, $sql_users)) 
{
    echo "6- table users created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating table users: " . mysqli_error($conn);
}

$sql_insert_users = "INSERT INTO users (id, firstname, lastname, username, password, email, user_rank) VALUES
(10, 'TestAccount', 'Tremblay', 'T_Account123', 'c06db68e819be6ec3d26c6038d8e8d1f', 't_account@xyz.com', 'user'),
(8, 'Brian', 'Smith', 'bsmith345', 'bb3b28c895dce2e40ecc92dc2c6779a9', 'briansmith@outlook.com', 'user'),
(9, 'Benoit', 'Thiviege', 'BLT74', '10ff747875fc8abdc3aae3d594808cee', 'benoitthiviege', 'user'),
(7, 'Pierre', 'Laberge', 'PierreLeRocher', '2fb6b0aaf6f2f0a0175e23946399fbc6', 'pierrelaberge@gmail.com', 'admin'),
(11, 'Michel', 'ForeverTonight', 'michel_FT', '1ea00ae084f92e9913ee42e61525f4ef', 'michealft@forevertonight.com', 'user'),
(12, 'Marcus', 'Severus', 'mseverus', '1aaf637e9550ec0544d43bb6949ea46f', 'marcusseverus@gmail.com', 'user'),
(13, 'alex', 'alex', 'alexalex', '0bf4375c81978b29d0f546a1e9cd6412', 'alex@alex.com', 'user'),
(14, 'james', 'john', 'jamesJ', '0875bdd6907a5b0cebb6170c84fe8b14', 'jamesjohn@johnny.com', 'user'),
(15, 'alicia', 'Smith', 'aliciaSmith', '25d55ad283aa400af464c76d713c07ad', 'aliciasmith@outlook.com', 'user'),
(16, 'patricia', 'test', 'test123', '05a671c66aefea124cc08b76ea6d30bb', 'patriciatest@test.test', 'user'),
(17, 'vincent', 'vincent', 'vvincent', '1a1e37b9d883641cc6fd04cc7286e421', 'vincent@vincent.vincent', 'admin'),
(18, 'Conan', 'OBrien', 'conan34', '2edcccef9a7c7e97fd85da66c46af132', 'conanobrien@show.com', 'user'),
(19, 'Jean-Marc', 'Marc', 'JeanMarcSmith', '25d55ad283aa400af464c76d713c07ad', 'jeanmarcsmith@outlook.com', 'user');";

if (mysqli_query($conn, $sql_insert_users)) 
{
    echo "Data successfully inserted in table users";
    echo "<br><br>";
} 
else
{
    echo "Error inserting data: " . mysqli_error($conn);
}

mysqli_close($conn);

echo "<p><a href='Indexx.php'>Go Back</a></p>";

?>