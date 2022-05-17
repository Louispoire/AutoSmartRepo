<?php
function displayDiscounts($file, $type) 
{
include "connectdb.php";	
$display = "";
if ($type == "discounts") 
{
	if (file_exists($file)) 
	{
        if (filesize("salesdiscounts.txt") != 0)
        {
            if ($fileData = fopen($file, "r")) 
            {
                $total = 0;
                while (!feof($fileData)) 
                {
                    $line = fgets($fileData);
                    if (!empty($line) || $line != "") 
                    {
                        $line = str_replace(array("\r", "\n"), "", $line);
                        $data = explode(",", $line);
                        $item_id = $data[0];
                        $discount_list = $data[1];
                        $price=0;
                        $getCars = "SELECT * FROM car_store WHERE id='$item_id'";
                        $getCars_res = mysqli_query($conn, $getCars);
                        if (mysqli_num_rows($getCars_res) > 0)
                        {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($getCars_res)) 
                            {
                                $price = $row["car_price"];
                                $total = $price - ($price*($discount_list/100));
                                $car_image = $row["car_image"];
                                echo "
                                <div>
                                    <table class='styled-table'>
                                    <thead>
                                        <tr>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Item</th>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Title</th>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">ID</th>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Original price</th>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">Discount</th>
                                            <th style=\"border: 1px solid black; border-collapse: collapse; text-align:center\">NEW PRICE!</th>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td style=\"border: 1px solid black; text-align:center; border-collapse: collapse\"><img src=\"Images\\$car_image\" style=\"width:200px; height: 150px;\"></td>
                                            <td style=\"border: 1px solid black; font-size: 150%; border-collapse: collapse; width: 17%; text-align:center\">" . $row["car_title"]. "</td>
                                            <td style=\"border: 1px solid black; font-size: 150%; border-collapse: collapse; width: 10%; text-align:center\">" . $row["id"]. "</td>
                                            <td style=\"border: 1px solid black; font-size: 150%; border-collapse: collapse; text-align:center; width: 10%\">$" . $row["car_price"] . "</td>
                                            <td style=\"border: 1px solid black; font-size: 150%; border-collapse: collapse; text-align:center;\">$discount_list%</td>
                                            <td style=\"border: 1px solid black; font-size: 150%; border-collapse: collapse; text-align:center;\"><span style=\"text-decoration: underline;\">$$total</span></td>
                                        </tr>
                                    </table>
                                    </div>";
                                //echo "<div style=\"text-align:center\"><p>Item: " . $row["item_title"]. " | Item ID: ". $row["id"]. "</p></div><br>";
                            }
                        }
                        else 
                        {
                            echo "0 results";
                        }
                    }
                }
                fclose($fileData);
            }
        }
        else 
        {
            echo "<h3 style=\"text-align:center\">No discounts available.</h3>";
        }
    }

} 
else 
{
if (file_exists($file)) 
{
	if ($fileData = fopen($file, "r")) 
	{
		while (!feof($fileData)) 
		{
			$line = fgets($fileData);
			if (!empty($line)) 
			{
			$line = str_replace(array("\r", "\n"), "", $line);
			$display .= "<tr><td>" . $line . "</td></tr>";
			}
		}
		fclose($fileData);
	}
}
}
return $display;
}
?>