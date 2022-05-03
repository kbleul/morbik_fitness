<?php
session_start();
include 'database_connect.php';

  $wid = $_REQUEST['r'];
  $mid = $_SESSION['id'];

   if(isset($REQUEST['r'])) {
  
  $query = "SELECT * FROM member_workout_table WHERE Mid ='$mid' AND workoutid = '$wid'";

  $output = "";
        if($result= $con->query($query))
        { 
            while($row = $result -> fetch_assoc() ){
                $output = "found";
            }
        }

        if($output == "") { 
              $query = "INSERT INTO member_workout_table (Mid,workoutid) VALUES ('$mid','$wid')";

            if( mysqli_query($con,$query))
            { echo "added"; } 
            else { echo mysqli_error($con); }  
        }
        else { echo $output; }

    }

    if(isset($_REQUEST['p'])) {
        
        $output = "";

    $query = "SELECT * FROM member_workout_table WHERE Mid = '$mid' ";
        if($result= $con->query($query))
            { 
                while($row = $result -> fetch_assoc() ){
                    $tempstr = $row['workoutid'] . " ";
                   $output .= $tempstr;
                }
            }
        else { $output = " error"; }

            echo $output;
    }


?>