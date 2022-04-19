<?php
 include 'database_connect.php';

   $eid = $_REQUEST['r'];

   
   $query = "SELECT * FROM employee where ID = '$eid'";
   
   if($result= $con->query($query)){

       while($row= $result -> fetch_assoc() ){
           $id = $row['ID'];
           $fullname = $row['FName']." ".$row['LName'];
           $gender = $row['Gender'];
           $dob = $row['DOB'];
           $email = $row['Email'];
           $job = $row['Job_title'];
           $salary = $row['Salary'];
           $registration_data = $row['registration_data'];
           $type = "";
           $type_program = "";
         
   $query = "SELECT * FROM employee_contact WHERE EmpID = '$id' ";


           if($result_two= $con->query($query)){
               while($row_two= $result_two -> fetch_assoc() ){
                   $phone = $row_two['Phone_Number'];

                   if($job == "trainer" || $job == "Trainer")
                   { 
                       $query = "SELECT Type FROM group_trainer WHERE Eid='$id'";

                       if($result_three= $con->query($query)){
                        $row_three= mysqli_fetch_row($result_three);
                   
                        if($row_three)
                        {  
                            $type = $row_three[0];
                            $type_program = "Group";
                        }
                        else {  
                            $query = "SELECT Type FROM private_trainer WHERE Eid='$id'";

                       if($result_four= $con->query($query)){
                        $row_four= mysqli_fetch_row( $result_four);

                        $type = $row_four[0];
                        $type_program = "Private";

                        }

                  
                        }
                   }
                }

               
                
            echo "<form method='POST'  id='singleemployee_form' >
            <input value='$fullname' type='text' >
            <input value='$gender' type='text' >
            <input value='$dob' type='date' >
            <input value='$registration_data' type='date' >
            <input value='$job' type='text' >
            <input value='$email' type='emai' >
            <input value='$phone' type='tel' >
            <input value='$type_program' type='text' >
            <input value='$type' type='text' >
            <input value='$salary' type='number' >
            </form>";
               } 

           } else { echo mysqli_error($con);}
       }

   } else { echo mysqli_error($con);}

?>