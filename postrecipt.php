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
               $discount = $row['Discount'];
               $name = $row['FName']. " ".$row['LName'];
               $total;

               if($discount == 1 || $discount == "1")
               { 
                $total = $fee * 0.1;
                $total = $fee - $total;
            //   echo "<script>console.log('one '". $total . ")</script>";

               } else if($discount == 2 || $discount == "2")
               { 
                $total = ($fee * 12 )* 0.15;
              // echo "<script>console.log('two '". $total . ")</script>";

                $total = ($fee * 12 )- $total;
             //  echo "<script>console.log('two '". $total . ")</script>";

               } else { 
                   $total = $fee; 
             //  echo "<script>console.log('three '". $total . ")</script>";
                
                }


        $query = "INSERT INTO payment_history (Mid,ProcessedBy,Fee) VALUES ('$mid','$processedby','$total')";

          if(mysqli_query($con,$query))  {
            $msg = "Yor monthly payment has been processed successfuly. 
            Thank you for paying on time. ";
            $cashirid = $_SESSION["id"];
            $cashirename = $_SESSION["name"];

            $query = "INSERT INTO member_notice (Senderid,Name,Mid,Message) VALUES ('$cashirid','$cashirename','$mid','$msg');";

          if(mysqli_query($con,$query))  { echo "New Recipt added for ". $name. " Successfully"; }
          else { 
            $error = mysql_error();
            echo "<script>console.log(". $error . ")</script>";
        }

          }
          else { 
              $error = mysql_error();
              echo "<script>console.log(". $error . ")</script>";
          }
           }
       }
   }

?>