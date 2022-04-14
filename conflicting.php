<?php
    include('database_connect.php');
    session_start();

    $starttime = $_REQUEST["q"];

    $id = $_SESSION["id"];

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

  




?>