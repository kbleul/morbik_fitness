<?php
 include 'database_connect.php';

  session_start();

   if(isset($_REQUEST['a'])) {
       $mid = $_REQUEST['a'];
       $processedby = $_SESSION['name'];

       $query = "SELECT * FROM main_members_table WHERE ID= $mid ";

       if($result = $con->query($query)) {
           while($row = $result->fetch_assoc()) {
               $fee = $row['Price'];

        $query = "INSERT INTO payment_history (Mid,ProcessedBy,Fee) VALUES ('$mid','$processedby','$fee')";

          if(mysqli_query($con,$query))  { echo "New Recipt Updated Successfully "; }
          else { 
              $error = mysql_error();
              echo "<script>console.log(". $error . ")</script>";
          }
           }
       }
   }

?>