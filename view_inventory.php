<?php
 session_start(); 
 include('database_connect.php');
 
    if(isset($_REQUEST['s'])) { 
        $output = "";
        $query = "";
        $counter = 0;
        if($_REQUEST['s'] == "all") {  $query = "SELECT * FROM inventory"; }
        else  if($_REQUEST['s'] == "name") {  $query = "SELECT * FROM inventory ORDER BY Name";  }
        else  if($_REQUEST['s'] == "type") {   $query = "SELECT * FROM inventory ORDER BY Type";  }
        else {  $query = "SELECT * FROM inventory ORDER BY Last_Added DESC";    }

            if($result= $con->query($query)){  
        $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>type</li><li>Price</li><li>Last Added Date</li></ul>";
               while($row= $result -> fetch_assoc() ){ 
                    $id = $row['id'];
                    $name = $row['Name'];
                    $disc = $row['Discription'];
                    $quan = $row['Quantity'];
                    $type = $row['Type'];
                    $price = $row['Price'];
                    $added = $row['Last_Added']; 

        $output = $output . "<ul class='inventory_ul ul$counter' id='ul$counter' onclick='editItem($counter)'>
        <li class='hidden'>$id</li>
        <li>$name</li><li>$disc</li><li>$quan</li><li>$type</li><li>$price</li>
        <li>$added</li></ul>";

        $counter++;

                }

                $output = $output . "</div>";

                echo $output; 
            } else { echo "unsucessfully"; } 
        }

   

   else if(isset($_REQUEST['c'])) { 
    $output = "";
    $query = "";

    if($_REQUEST['c'] == "all_types") { $query = "SELECT * FROM inventory"; }
    else if($_REQUEST['c'] == "weights") {   $query = "SELECT * FROM inventory WHERE Type = 'Weights'";  }
    else if($_REQUEST['c'] == "machines") {    $query = "SELECT * FROM inventory WHERE Type = 'Machine'";  }
    else { $query = "SELECT * FROM inventory WHERE Type = 'Others'"; }


        if($result= $con->query($query)){  
    $output = "<div class='inventory_wrapper'><ul class='inventory_ul'><li>Name</li><li>Discription</li><li>Quantity</li><li>Type</li><li>Price</li><li>Last Added Date</li></ul>";
           while($row= $result -> fetch_assoc() ){ 
                $id = $row['id'];
                $name = $row['Name'];
                $disc = $row['Discription'];
                $quan = $row['Quantity'];
                $type = $row['Type'];
                $price = $row['Price'];
                $added = $row['Last_Added']; 

    $output = $output . "<ul class='inventory_ul'>
    <li class='hidden'>$id</li>
    <li>$name</li><li>$disc</li><li>$quan</li><li>$type</li><li>$price</li>
    <li>$added</li></ul>";

            }

            $output = $output . "</div>";

            echo $output; 
        } else { echo "unsucessfully"; } 
    }
?> 