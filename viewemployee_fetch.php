<?php
 include('database_connect.php');

 // get the q parameter from URL
   $type = $_REQUEST["q"];
   $str_result = "";

   if($type == "trainer") {
   
    $query = "SELECT * FROM employee where Job_title = 'trainer'";

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
                 

              $str_result = $str_result . "<ul class='manage_employee-ul' onclick='viewEmployee($id)'>
             <li>$fullname</li>
             <li>$gender</li>
             <li>$dob</li>
             <li>$registration_data</li>
             <li>$job</li>
             <li>$email</li>
             <li>$phone</li>
             <li>$type_program</li>
             <li>$type</li>
             <li>$salary</li></ul>";
                } 

            } else { echo mysqli_error($con);}
        }

        echo $str_result;
    } else { echo mysqli_error($con);  }

   } 
   else if($type == "important") {
    $query = "SELECT * FROM important_employees";
   
    if($result= $con->query($query)){

        while($row= $result -> fetch_assoc() ){
            $id = $row['id'];

          $query = "SELECT * from employee WHERE ID = $id";
           
          if($result_two = $con->query($query)){
            while($row_two = $result_two -> fetch_assoc() ){
              $fullname = $row_two['FName']." ".$row_two['LName'];
              $gender = $row_two['Gender'];
              $dob = $row_two['DOB'];
              $email = $row_two['Email'];
              $job = $row_two['Job_title'];
              $salary = $row_two['Salary'];
              $registration_data = $row_two['registration_data'];
              $type = "";
              $type_program = "";
            

           
          
    $query = "SELECT * FROM employee_contact WHERE EmpID = '$id' ";


            if($result_three = $con->query($query)){
                while($row_three = $result_three -> fetch_assoc() ){
                    $phone = $row_three['Phone_Number'];

                    if($job == "trainer" || $job == "Trainer")
                    { 
                        $query = "SELECT Type FROM group_trainer WHERE Eid='$id'";

                        if($result_four= $con->query($query)){
                         $result_four= mysqli_fetch_row($result_four);
                    
                         if($result_four)
                         {  
                             $type = $result_four[0];
                             $type_program = "Group";
                         }
                         else {  
                             $query = "SELECT Type FROM private_trainer WHERE Eid='$id'";

                        if($result_five= $con->query($query)){
                         $row_five= mysqli_fetch_row( $result_five);

                         $type = $row_five[0];
                         $type_program = "Private";

                         }

                   
                         }
                    }
                 }

             echo "<ul class='manage_employee-ul' onclick='viewEmployee($id)'>
             <li>$fullname</li>
             <li>$gender</li>
             <li>$dob</li>
             <li>$registration_data</li>
             <li>$job</li>
             <li>$email</li>
             <li>$phone</li>
             <li>$type_program</li>
             <li>$type</li>
             <li>$salary</li></ul>";
                } 

            } else { echo mysqli_error($con);}
          }
        }
        }

    } else { echo mysqli_error($con);}
   }
   else { 
    $query = "SELECT * FROM employee";
   
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

             echo "<ul class='manage_employee-ul' onclick='viewEmployee($id)'>
             <li>$fullname</li>
             <li>$gender</li>
             <li>$dob</li>
             <li>$registration_data</li>
             <li>$job</li>
             <li>$email</li>
             <li>$phone</li>
             <li>$type_program</li>
             <li>$type</li>
             <li>$salary</li></ul>";
                } 

            } else { echo mysqli_error($con);}
        }

    } else { echo mysqli_error($con);}
   }

  







?>