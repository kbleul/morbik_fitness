<?php
include 'database_connect.php'; 

if(isset($_POST['submit_member'])) {
    echo "<script>console.log('error1')</script>";
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
    $starttime = $_POST['time_start'];
    $endtime = $_POST['time_end'];
    $trainer = $_POST['trainer'];
 


    $schedule_temp = explode("(",$_POST['schedule'],2);
    $schedule = $schedule_temp[0];

    $package_temp = explode("(" , $_POST['package'], 2);
    $package = $package_temp[0];

    $plan = $_POST['plan'];
    echo $plan."1";
    if( $_POST['plan'] == "15 days a month") { $plan = "Fortnight"; } else { $plan = "Full Month"; }
    echo $plan."2";


    $query = "INSERT into member (FName,LName,Gender,DOB,Weight,Height,Email,Username,Password) VALUES 
    ('$fname','$lname','$gender','$dob','$weight','$height','$email','$uname','$password');";

    if( mysqli_query($con,$query))
    {  
    echo "<script>console.log('error2')</script>";

    $query = "SELECT * FROM member where Password='$password'";

        if($result= $con->query($query)){
        while($row=$result -> fetch_assoc() ){
            $id = $row['ID'];
            $query = "INSERT INTO member_contact(MemID,Phone_Number) VALUES ('$id','$phone');";

                if( mysqli_query($con,$query)) { 
                    $query = "SELECT * FROM main_program where Name='$program'";  

                    if($result_two=$con-> query($query)) {  
                      while($row_two=$result_two->fetch_assoc()) { 

                        $main_pid=$row_two['Id'];
                        
                          //pivate trainer
               if( $trainer == "yes")
               { 
    
                        echo "luntics";
                     $query = "SELECT * FROM program WHERE ProgramId='$main_pid' AND Name='$program' And Plan='$plan';";
                     if($result_four= $con->query($query)){
                        echo "luntics2";
                         while($row_four=$result_four -> fetch_assoc() ){
                             $pid = $row_four['ID'];
                           
                           $query = "SELECT * FROM discount WHERE Name='$package';";
                            if($result_five = $con->query($query)){ 
                        echo "luntics3";
                                while($row_five = $result_five -> fetch_assoc()) {

                                    $packagetemp = $row_five['Id'];

    $query = "INSERT into member_program_junction (Mid,Pid,Request_pirivate_trainer,Start_Time,End_Time,DiscountId) VALUES 
            ('$id','$pid',1,'$starttime','$endtime','$packagetemp');";
                           
                                if( mysqli_query($con,$query)) {echo '<script>alert("Sign in Successfull")</script>'; } 
                                else { echo "Error. Sign in Unscuccessfull".mysqli_error($con); }

                                }
                            }

                           

                         }
                     }else { echo mysqli_error($con); }
                 
             
                 
               }
                
               else if($trainer == "no" )
                { 
                      if($program == "Aerobics" || $program == "Yoga" )
                     {
                            $tempprogram = $program.'-Group';  
                            $programstr = '%'.$program.'%';

                     $query = "SELECT * FROM program_time WHERE Class='$schedule' And Timeid LIKE '$programstr' ";

                      if($result_three = $con->query($query)){
                          while($row_three = $result_three->fetch_assoc()){
                              $timeid = $row_three['Timeid'];

                              $query = "SELECT * FROM program WHERE ProgramId='$main_pid' AND Name='$tempprogram' And Plan='$plan';";
                              if($result_four= $con->query($query)){
                                  while($row_four=$result_four -> fetch_assoc() ){
                                      $pid = $row_four['ID'];
                                    
                                    $query = "SELECT * FROM discount WHERE Name='$package';";
                                     if($result_five = $con->query($query)){ 
                                         while($row_five = $result_five -> fetch_assoc()) {

                                             $packagetemp = $row_five['Id'];

             $query = "INSERT into member_program_junction (Mid,Pid,Request_pirivate_trainer,Timeid,DiscountId) VALUES ('$id','$pid',0,'$timeid','$packagetemp');";
                                    
                                         if( mysqli_query($con,$query)) {echo '<script>alert("Sign in Successfull")</script>'; } 
                                         else { echo "Error. Sign in Unscuccessfull".mysqli_error($con); }

                                         }
                                     }

                                    
      
                                  }
                              }else { echo mysqli_error($con); }
                          }
                      }
                    } else {
 
                        $programstr = '%'.$program.'%';

                 $query = "SELECT * FROM program_time WHERE Class='$schedule' And Timeid LIKE '$programstr' ";

                  if($result_three = $con->query($query)){
                      while($row_three = $result_three->fetch_assoc()){
                          $timeid = $row_three['Timeid'];

                          $query = "SELECT * FROM program WHERE ProgramId='$main_pid' AND Name='$program' And Plan='$plan';";
                          if($result_four= $con->query($query)){
                              while($row_four=$result_four -> fetch_assoc() ){
                                  $pid = $row_four['ID'];
                                
                                $query = "SELECT * FROM discount WHERE Name='$package';";
                                 if($result_five = $con->query($query)){ 
                                     while($row_five = $result_five -> fetch_assoc()) {

                                         $packagetemp = $row_five['Id'];

         $query = "INSERT into member_program_junction (Mid,Pid,Request_pirivate_trainer,Timeid,DiscountId) VALUES ('$id','$pid',0,'$timeid','$packagetemp');";
                                
                                     if( mysqli_query($con,$query)) {echo '<script>alert("Sign in Successfull")</script>'; } 
                                     else { echo "Error. Sign in Unscuccessfull".mysqli_error($con); }

                                     }
                                 }
                                 else { echo mysqli_error($con); }
                                
  
                              }
                          }else { echo mysqli_error($con); }
                      }
                  }
                    }
                        }
              


                     }
                    }
            } else { echo mysqli_error($con); }

            }
        } else { echo mysqli_error($con); }

    
    } else { 
    echo "<script>console.log('error_e1')</script>";

    }


}  else { echo "<script>console.log('error')</script>"; }



?>
