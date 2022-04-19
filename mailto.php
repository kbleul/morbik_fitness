<?php
include 'database_connect.php';
         $tempstr = explode(' ',$_REQUEST['s']);

         $email = $tempstr[0];
         $code = $tempstr[1];

   
   $query = "SELECT * FROM important_employee_main WHERE Email = '$email'";

   if($result = $con->query($query)){
      while( $row = $result -> fetch_assoc() ) {
            $memid = $row['ID']; 
            $query = "SELECT * FROM recovery_table WHERE Eid='$memid'";

            if($result_two = $con->query($query)){
               while( $row_two = $result_two -> fetch_assoc() ) {
                     $maincode = $row_two['Recovery_code'];

                     if($maincode == $code) { 
            $query = "DELETE FROM recovery_table where Eid = $memid";
            
              if(mysqli_query($con,$query))
                      {  echo "Match-".$memid; }
                      else { echo mysqli_error($con); }  
                     }
                     else { echo "Not matched"; }
               }
            } else { echo mysqli_error($con); }  
      }
   } else { echo mysqli_error($con); }
   
      ?>