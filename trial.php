/*
if(isset($_POST['submit_member'])) {
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender= $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $password = $_POST['password'];
    $program = $_POST['program'];
    $plan = $_POST['plan'];
        if( $_POST['plan'] == "15 days a month") { $plan = "Fortnight"; } else { $plan = "Full Month"; }
    $trainer = $_POST['trainer'];
    $start_time = $_POST['time_start'];
    $endtime = $_POST['time_end'];
    $schedule = $_POST['schedule'];
    $package = $_POST['package'];

    
echo 'successfull2';
 
    $query = "INSERT into member (FName,LName,Gender,DOB,Weight,Height,Email,Username,Password) VALUES 
          ('$fname','$lname','$gender','$dob','$weight','$height','$email','$uname','$password');";

    if( mysqli_query($con,$query))
    {echo 'successfull'; 
        $query = "SELECT * FROM member where Password='$password'";

        if($result= $con->query($query)){
            while($row=$result -> fetch_assoc() ){
                $id = $row['ID'];
                $query = "INSERT INTO member_contact(MemID,Phone_Number) VALUES ('$id','$phone');";

                if( mysqli_query($con,$query)) { echo 'successfull2';
                    $query = "SELECT * FROM main_program where Name='$program'";  
                    if($result_two=$con-> query($query))
                    { echo 'successfull3';
                         while($row_two=$con->fetch_assoc()) { 
                        $main_pid=$row_two['Id'];
            
                        if(($program == "Aerobics" || $program == "Yoga") && $trainer == "no")
                        { 
                            $query = "SELECT * FROM program WHERE ProgramId='$main_pid' AND Name='$program'.'-Group' And Plan='$plan';";
                            if($result_four= $con->query($query)){ echo 'successfull4';
                                while($row_four=$result -> fetch_assoc() ){
                                    $pid = $row_four['ID'];
    
    $query = "INSERT into member-program-junction` (Pid,MainPId,Private_Trainer_Id,Start_Time,End_Time,Timeid) VALUES 
          ('$pid','$main_pid','','','','Yoga2');";

                                    if( mysqli_query($con,$query))
                                    {echo 'successfull5'; } 
                                    else { echo "Error4" }
                                                                    }
                                    }else { echo "Error10" }
                        } 
                                                        }
                        } else { echo "Error4" }

                echo 'successfull6'; }
                else {  
                    $error = mysqli_error($con);
                    echo "<script>echo('unsccessfull director insert operation... '.$error);</script>";
                     }
            }
         } else { echo "error 6"}
         } 
    } else { 
echo "error";

} */