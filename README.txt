
This is the final version of my shopping cart!
I've included a SQL script in case everything goes wrong with the database creation system!


Here are the list and password from the users (I don't remember the other ones)

Username             Password
michel_FT	     thelegend
T_Account123	     test12345
PierreLeRocher       lerocher 

       

PierreLeRocher is an admin! Connect to his account to access admin options



There is more information in the script named externalDatabaseCreationScript. Please read on how to create database easily!

/----------------------------------------------------------------------------------------------------------------------------------------------\

To run this script, please make sure to be connected to another database because WampServer64 
does not allow to create a database while having a connection to that said database having a connection to another one!


How to use the database creation system:

1. Please comment the "include "connectdb.php";" at the top of the page.

2. Remove comments around the connection code below

3. Replace carstoredb_v1 with another database (for instance studentdb or inventorydb. It can be anything)

4. Run the PHP script and the click on Engage table creation system 



Thank you!


