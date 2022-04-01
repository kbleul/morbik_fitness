<?php
include 'database_connect.php'; 

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
    $schedule_temp = explode("(",$_POST['schedule'],2);
    $schedule = $schedule_temp[0];


    $package = $_POST['package'];

echo 'successfull'; 
echo $email;
echo $schedule;

    $query = "INSERT into member (FName,LName,Gender,DOB,Weight,Height,Email,Username,Password) VALUES 
    ('$fname','$lname','$gender','$dob','$weight','$height','$email','$uname','$password');";

    if( mysqli_query($con,$query))
    {echo 'successfull2'; 
    $query = "SELECT * FROM member where Password='$password'";

        if($result= $con->query($query)){
        while($row=$result -> fetch_assoc() ){echo 'successfull3';
            $id = $row['ID'];
            $query = "INSERT INTO member_contact(MemID,Phone_Number) VALUES ('$id','$phone');";

                if( mysqli_query($con,$query)) { echo 'successfull4';
                    $query = "SELECT * FROM main_program where Name='$program'";  
                    if($result_two=$con-> query($query))
                    { echo 'successfull5';    
                     while($row_two=$result_two->fetch_assoc()) { 
                        $main_pid=$row_two['Id'];
                        if(($program == "Aerobics" || $program == "Yoga") && $trainer == "no")
                        { echo "yes";

                            $tempprogram = $program.'-Group';  echo $tempprogram;

                     $query = "SELECT * FROM `program-time` WHERE Class='$schedule' And Timeid LIKE '%'.$program.'%'";
                      if($result_three = $con->query($query)){echo 'successfull6';
                          while($row_three = $con->fetch_assoc()){
                              $timeid = $row_three['Timeid'];

                              $query = "SELECT * FROM program WHERE ProgramId='$main_pid' AND Name='$tempprogram' And Plan='$plan';";
                              if($result_four= $con->query($query)){
                                  while($row_four=$result_four -> fetch_assoc() ){
                                      echo 'successfull4';
                                      $pid = $row_four['ID'];
                                    
      $query = "INSERT into member_program_junction (Mid,Pid,MainPId,Timeid) VALUES ('$id','$pid','$main_pid','$timeid');";
                                      echo $query;
  
                                  if( mysqli_query($con,$query))
                                  {echo 'successfull5'; } 
                                  else { echo "Error4".mysqli_error($con); }
                                  }
                              }else { echo mysqli_error($con); }
                          }
                      }
                          
                        }
                     }
                    }
            } else { echo mysqli_error($con); }

            }
        } else { echo mysqli_error($con); }

    
    }
}  else { echo 'error'; }


?>
