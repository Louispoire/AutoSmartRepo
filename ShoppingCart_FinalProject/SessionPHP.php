<?php
include "connectdb.php";
/*
BEFORE
<li style="margin-right: 0%;"><?php echo $loginInfo ?></li>


AutoSmart V2
<?php echo $submenu; ?>

*/
session_start();
$submenu;
$loggedUsername;
if (!empty($_SESSION["username"]))
{
    $checkUsername = $_SESSION["username"];
    $getUser = "SELECT * FROM users WHERE username = '$checkUsername'";
    $getUser_res = mysqli_query($conn, $getUser); 
    if(mysqli_num_rows($getUser_res) < 1) {
        echo "<p style=\"text-align:center\">Error has occured. Please contact support";
    }
    else
    {
        while ($userInfo = mysqli_fetch_assoc($getUser_res)) 
        {
            $loggedUsername = $_SESSION["username"];
            $loginInfo = $loggedUsername;
            $rank = $userInfo['user_rank'];
            if ($rank == "admin")
            {
                $submenu = "<div class='dropdown'>
                <a class='nav-link dropbtn'>$loginInfo</a>
                <div class='dropdown-content'>
                <a href='userSetting.php'>Settings</a>
                <a href='admin.php'>Admin Menu</a>
                <a href='currentDiscounts'>Dis-Manager</a>
                <a href='manageInventory.php'>Manage inventory</a>
                </div>
                </div>";
            }
            else
            {
                $submenu = "<a class='nav-link' href='userSetting.php'>$loginInfo</a>";
            }
        }
    }
}
else
{
	$submenu = "<a class='nav-link' href='loginChoice.php'>Login</a>";
}
?>