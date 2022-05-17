<?php
function displayAllCars() 
{	
    include "connectdb.php";
    echo "<div>
            <table class='styled-table'>
                <thead>
                    <tr>
                        <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">ID</th>
                        <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Title</th>
                        <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Price</th>
                    </tr>
                </thead>";
    $getCars = "SELECT * FROM car_store";
    $getCars_res = mysqli_query($conn, $getCars);
    if (mysqli_num_rows($getCars_res) > 0)
    {

        // output data of each row
        while($row = mysqli_fetch_assoc($getCars_res)) 
        {
            echo "<tr>
                    <td style=\"border: 1px solid black; border-collapse: collapse; width: 10%; text-align:center\">" . $row["id"]. "</td>
                    <td style=\"border: 1px solid black; border-collapse: collapse; width: 17%; text-align:center\">" . $row["car_title"]. "</td>
                    <td style=\"border: 1px solid black; border-collapse: collapse; text-align:center; width: 10%\">$" . $row["car_price"] . "</td>
                </tr>";

        }
    }
    else 
    {
        echo "0 results";
    }  
    echo "</table></div>";
}
?>