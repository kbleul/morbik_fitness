<?php
 session_start(); 
 include('database_connect.php');
 
    if(isset($_REQUEST['o'])) { 
        $output = "";
        if($_REQUEST['o'] == "all") {  
            $query = "SELECT * FROM inventory";

            if($result= $con->query($query)){  
        $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>type</li><li>Price</li><li>Last Added Date</li></ul>";
               while($row= $result -> fetch_assoc() ){ 
                    $name = $row['Name'];
                    $disc = $row['Discription'];
                    $quan = $row['Quantity'];
                    $type = $row['Type'];
                    $price = $row['Price'];
                    $added = $row['Last_Added']; 

        $output = $output . "<ul class='inventory_ul'><li>$name</li><li>$disc</li><li>$quantity</li><li>$type</li><li>$price</li>
        <li>$added</li></ul>";

                }

                $output = $output . "</div>";

                echo $output; 
            } else { echo "unsucessfully"; } 
        }

        else  if($_REQUEST['o'] == "name") {  
            $query = "SELECT * FROM inventory ORDER BY Name";

            if($result= $con->query($query)){  
        $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>type</li><li>Price</li><li>Last Added Date</li></ul>";
               while($row= $result -> fetch_assoc() ){ 
                    $name = $row['Name'];
                    $disc = $row['Discription'];
                    $quan = $row['Quantity'];
                    $type = $row['Type'];
                    $price = $row['Price'];
                    $added = $row['Last_Added']; 

        $output = $output . "<ul class='inventory_ul'><li>$name</li><li>$disc</li><li>$quantity</li><li>$type</li><li>$price</li>
        <li>$added</li></ul>";

                }

                $output = $output . "</div>";

                echo $output; 
            } else { echo "unsucessfully"; } 
        }

        else  if($_REQUEST['o'] == "type") {  
            $query = "SELECT * FROM inventory ORDER BY Type";

            if($result= $con->query($query)){  
        $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>type</li><li>Price</li><li>Last Added Date</li></ul>";
               while($row= $result -> fetch_assoc() ){ 
                    $name = $row['Name'];
                    $disc = $row['Discription'];
                    $quan = $row['Quantity'];
                    $type = $row['Type'];
                    $price = $row['Price'];
                    $added = $row['Last_Added']; 

        $output = $output . "<ul class='inventory_ul'><li>$name</li><li>$disc</li><li>$quantity</li><li>$type</li><li>$price</li>
        <li>$added</li></ul>";

                }

                $output = $output . "</div>";

                echo $output; 
            } else { echo "unsucessfully"; } 
        }
        else  if($_REQUEST['o'] == "date") {  
            $query = "SELECT * FROM inventory ORDER BY Last_Added DESC";

            if($result= $con->query($query)){  
        $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>type</li><li>Price</li><li>Last Added Date</li></ul>";
               while($row= $result -> fetch_assoc() ){ 
                    $name = $row['Name'];
                    $disc = $row['Discription'];
                    $quan = $row['Quantity'];
                    $type = $row['Type'];
                    $price = $row['Price'];
                    $added = $row['Last_Added']; 

        $output = $output . "<ul class='inventory_ul'><li>$name</li><li>$disc</li><li>$quantity</li><li>$type</li><li>$price</li>
        <li>$added</li></ul>";

                }

                $output = $output . "</div>";

                echo $output; 
            } else { echo "unsucessfully"; } 
        }
    }

?>