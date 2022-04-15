<?php
session_start();
include 'database_connect.php';

  $type = $_REQUEST['r'];
   

    if($type == 'rejected') { 

             $counter = 0;
            $output = "<ul class='member_request-ul'><li>Message</li>
            <li>Program</li>
            <li>Requested Time</li>
            </ul>";
             $query = "SELECT * FROM trainer_request WHERE Status = 'Rejected'";
             
             if($result= $con->query($query))
             { while($row = $result -> fetch_assoc() ){
                 $memid = $row['Mid'];
                 $trainerid = $row['Eid'];
                 $time = $row['Time'];

                 $query = "SELECT * FROM main_members_table WHERE ID = '$memid'";

                 if($result_two= $con->query($query))
                 { while($row_two = $result_two -> fetch_assoc() ){
                    $name = $row_two['FName']." ".$row_two['LName'];
                    $program = $row_two['Name'];

                    $query = "SELECT * FROM employee WHERE ID ='$trainerid'";
                    if($result_three= $con->query($query))
                 { while($row_three = $result_three -> fetch_assoc() ){
                    $trainername = $row_three['FName']." ".$row_three['LName'];
                    $ulid = "ul".$counter;

            $output = $output. "<ul id='$ulid' class='member_request-ul'><li>$trainername rejected $name</li><li>$program</li><li>$time</li>
            ";
          
            $query = "SELECT * from `private_trainer_info` where Type='$program' And ID <>'$trainerid'";

            if($result_four= $con->query($query))
            {  $sendnotice = "notice".$counter;
                if(mysqli_num_rows($result_four) == 0) 
                {  $output = $output . "<p id='error$counter' class=''>* No available trainers.</p>
                    <button id='sendnotice' onClick='sendNotice($memid)'>Send Notice</button>"; }
                
               else {
                   $output = $output . "<select id='s$counter' name='trainer_select'>";
                while($row_four = $result_four -> fetch_assoc() ){
                $tempname = $row_four['FName']." ".$row_four['LName'];
               $output = $output . "<option class='traineroption' value=$tempname>$tempname</option>";
            } }
        } else { echo mysqli_error($con);}

         $output = $output . "</select></ul>";

                 }
                } else { echo mysqli_error($con);}
                 }
                } else { echo mysqli_error($con);}
            $counter = $counter + 1;
            } 

            echo $output;

         } else { echo mysqli_error($con);}

        }  else if($type == 'requests'){ 

            $output = ' <ul class="member_request-ul">
            <li>Full Name</li>
            <li>gender</li>
            <li>program</li>
            <li>plan</li>
            <li>Requested Time</li>
            <li> </li>
        </ul>';

            $counter = 0;
            $query = "SELECT * FROM main_members_table where Resquest_Private = 1";
        
            if($result= $con->query($query)){
        
                while($row= $result -> fetch_assoc() ){
                    $id = $row['ID'];
                    $fullname = $row['FName']." ".$row['LName'];
                    $gender = $row['Gender'];
                    $program = $row['Program_Name'];
                    $plan = $row['Specific_Plan'];
                    //PROGRAM with out -extension
            $program_two = explode("-",$program,2);
                    
        
       
                           $query = "SELECT Start_Time, End_Time FROM member_program_junction where Mid = '$id'";
                    if($result_two= $con->query($query)){
                        while($row_two= $result_two -> fetch_assoc() ){
                            $starttime = $row_two['Start_Time'];
                            $endtime = $row_two['End_Time'];
                            $class = "member_request-ul";
                            $class_span = 'span_break';
        
        
                     $counter = $counter + 1;
        
        
                     $output = $output ."<ul class='$class'><li>$fullname</li>
                     <li>$gender</li>
                     <li>$program</li>
                     <li>$plan</li>
                     <li>Requested time <span class='$class_span'> $starttime - $endtime </span></li>
                     <li class='trainers_list'>
                     <span id='assign$counter'>Assign Trainer</span> 
                     <button id='a$counter' class='show_select_btn' onclick='showSelect($counter)'>Assign</button>
                     <form method='post'>
                     <select id='s$counter' class='trainer' name='trainer_select'>$program_two";
        
        
                     //get all the available trainer so the manager can choose one for that specific program
                     //program can be yoga, boxing ...
                     $query = "SELECT * from `private_trainer_info` where Type='$program_two[0]'";
     
                     if($result_three = $con->query($query)){
                        while($row_three = $result_three -> fetch_assoc() ){
                            $trainerid = $row_three['ID'];
                            $tainername = $row_three['FName']." ".$row_three['LName'];
                           $output = $output . "<option class='traineroption' value=$tainername>$tainername</option>";
                        } 
                     } else { echo mysqli_error($con);}
        
                     $time = $start_time."-".$end_time;
        
                     $output = $output . " </select>
                    <input class='hiddenextar_info' type='text' name='time' value='$starttime - $endtime'>     
                    <input class='hiddenextar_info' type='text' name='mid' value='$id'>    
                    <input class='hiddenextar_info' type='text' name='eid' value='$trainerid'>      
     
                     <p id='error$counter' class='error_p'>* No available trainers.</p>
                    <button id='b$counter' class='submit_assign_btn' type='submit' name='submit_assign'>OK</button>
                    </form>
                     </li>
                     
                     </ul>";
                      
                        } 
        
                    } else { echo mysqli_error($con);}
                }
        echo $output;
            } else { echo mysqli_error($con);}
     
                         
        }

      

    else {
        $memid = $_REQUEST["s"];

        $query = "INSERT INTO member_notice (Mid,Message) VALUES ('$memid','Sorry, 
        We dont have a private trainer available currently. We will notify you as soon as we hire new employees.')";

       if( mysqli_query($con,$query))
       { 
         $query = "DELETE FROM trainer_request WHERE Mid = '$memid'";   
       if( mysqli_query($con,$query))
               echo "Notice Sent";
       }
       else { echo mysqli_error($con); }
    }

    

?>