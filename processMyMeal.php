<?php
include 'database_connect.php'; 
  session_start();

  $membid = $_SESSION["id"];


  if(isset($_REQUEST['p'])) {

    $mealid = $_REQUEST['p'];
  
    $query = "SELECT * FROM member_meal_table WHERE membid ='$membid' AND mealid = '$mealid'";
  
    $output = "";
          if($result= $con->query($query))
          { 
              while($row = $result -> fetch_assoc() ){
                  $output = "Already saved";
              }
          }  else { echo mysqli_error($con); }
  
          if($output == "") { 
                $query = "INSERT INTO member_meal_table (membid,mealid) VALUES ('$membid','$mealid')";
  
              if( mysqli_query($con,$query))
              { echo "Saved"; } 
              else { echo mysqli_error($con); }  
          }
          else { echo $output; }
  
      }

  if(isset($_REQUEST['f'])) {

    $query = "SELECT * FROM member_meal_table WHERE membid ='$membid' ";

    $output = "";
    if($result= $con->query($query))
    { 
        while($row = $result -> fetch_assoc() ){
            $mealid = $row['mealid']. "-";
            $output .= $mealid;
        }
    } else { echo mysqli_error($con); }


    if($output == "") { $output = "Empty"; }

        echo $output;


  }

  

?>