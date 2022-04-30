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

               
                
            $output = "<form method='POST'  id='singleemployee_form' >
            <input type='hidden' name='id' value='$id'>
            <label for='name'>Full Name</label>
            <input name='name' value='$fullname' type='text' readonly>
            <label for='gender'>Gender</label>
            <input name='gender' value='$gender' type='text' readonly>
            <label for='DOB'>Date Of Birth</label>
            <input name='DOB' value='$dob' type='date' readonly>
            <label for='regdate'>Registration Date</label>
            <input name='regdate' value='$registration_data' type='date' readonly>
            <label for='job'>Job Title</label>
            <input name='job' value='$job' type='text' readonly>
            <label for='email'>Email</label>
            <input name='email' value='$email' type='emai' readonly>
            <label for='phone'>Phone</label>
            <input name='phone' value='+251 $phone' type='tel' readonly>";

            if($type_program != "" || $type_program != " " || $type_program != Null)
            { $output = $output ."<label for='program'>Program Type</label>
                <input name='program' value='$type_program' type='text' readonly>";  }
            
            if($type != "" || $type != " " || $type != null)
            { $output = $output ."<label for='type'>Type</label>
            <input name='type' value='$type' type='text' readonly>"; }

            if($salary != "" || $salary != " " || $salary != null)
             {
            $output = $output ."<label for='salary'>Salary</label>
            <input id='editsalary' name='salary' value='$salary' type='number' >";
             }

            $output = $output . "<input type='submit' name='submit' value='submit' id='submit'></form>";

            echo $output;
               } 

           } else { echo mysqli_error($con);}
       }

   } else { echo mysqli_error($con);}

?>