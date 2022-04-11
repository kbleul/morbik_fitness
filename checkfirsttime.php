<?php
   include('database_connect.php');

// get the q parameter from URL
  $email = $_REQUEST["q"];


    $query = "SELECT * FROM important_employee_main where Email = '$email' AND PASSWORD IS NULL";

   if($result = $con->query($query)){
    while($row = $result -> fetch_assoc() ){
        
            echo $row['ID'];
        }
    }
    else {
        echo "Not Found";
    }

?>