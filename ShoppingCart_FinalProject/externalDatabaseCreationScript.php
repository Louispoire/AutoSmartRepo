<?php
//include "connectdb.php";

//To run this script, please make sure to be connected to another database because WampServer64 does not allow to create a database while having a connection to that said database having a connection to another one!


//How to use the database creation system:

//1. Please comment the "include "connectdb.php";" at the top of the page.

//2. Remove comments around the connection code below

//3. Replace carstoredb_v1 with another database (for instance studentdb or inventorydb. It can be anything)

//4. Run the PHP script and the click on Engage table creation system 



$conn = mysqli_connect("127.0.0.1","root","","carstoredb_v1","3306");
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}







$sql = "CREATE DATABASE carstoredb_v1";
         
if (mysqli_query($conn, $sql)) 
{
    echo "1- Database created successfully";
    echo "<br><br>";
} 
else
{
    echo "Error creating database: " . mysqli_error($conn);
}

echo "<p><a href='createSQLDatabase.php'>Engage table creation system!</a></p>";

?>