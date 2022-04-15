<?php
    include('database_connect.php');

    session_start();
    $id = $_SESSION["id"];


    if(isset($_REQUEST["q"]))
    {  

        $starttime = $_REQUEST["q"];

  $query = "SELECT * FROM member_program_junction WHERE Private_Trainer_Id = '$id' AND Start_Time = '$starttime'";

  if($result_check = $con->query($query)){
    while($row_check = $result_check -> fetch_assoc() ){
        $memid = $row_check['Mid'];
        $time = $row_check['Start_Time']." - ". $row_check['End_Time'];

        $query = "SELECT * FROM member WHERE ID = '$memid'";

        
        if($result_two = $con->query($query)){
            while($row_two = $result_two -> fetch_assoc() ){
                $name = $row_two['FName']." ".$row_two['LName'];
             echo "Conflicts with :  $name at $time";
            }
        } else { echo mysqli_error($con);}

    }
} else { echo mysqli_error($con);}

    }

    else if(isset($_REQUEST["r"]))
    {  
 
         $memid = $_REQUEST["r"];

         $query = "UPDATE trainer_request SET Status = 'Rejected' WHERE Mid = '$memid' AND Eid = '$id' ";
     
         if(mysqli_query($con,$query))
         { echo "rejected success".$id." ".$memid;  }

         else { 
            echo mysqli_error($con);  
            echo "<script>console.log('decline'+$memid)</script>"; 
         }
    }
    
?>