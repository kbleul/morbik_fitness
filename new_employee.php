
    <?php session_start(); 
   //if username and email are not set for this session then user has not logged in to the system

   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

   //connect to database
   include('database_connect.php');

   //if submit button is clicked
   if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $jobtitle = $_POST['job'];
    $salary = $_POST['salary'];
    $phone = $_POST['phone'];
    $program = $_POST['program'];
    $fee = $_POST['fee'];
    $isprivate = $_POST['isprivate'];

    $date = date("Y-m-d");


    $query = "";
        //if employee is a private trainer then dont add salary because they dont have a salary
    if($isprivate == "private"){

    $query = "INSERT INTO employee (FNAME,LName,Gender,DOB,Email,Job_title,registration_data) 
               VALUES ('$fname','$lname','$gender','$dob','$email','$jobtitle','$date')";
    }
   //else if employee is a normal employee or a group trainer add salary to the table 
    else { 
        $query = "INSERT INTO employee (FNAME,LName,Gender,DOB,Email,Job_title,Salary,registration_data) 
               VALUES ('$fname','$lname','$gender','$dob','$email','$jobtitle','$salary','$date')";
    }
    if( mysqli_query($con,$query)) {
        //select from the employee table using the name and email address so we can get the his/her id given by the database automatically
   $query = "SELECT * FROM employee WHERE Email='$email' AND FName='$fname' AND LName='$lname' ";

   if($result = $con->query($query)){

    while($row = $result -> fetch_assoc() ){

        //get id
        $empid = $row['ID'];
    
        //using the id insert data into the employee contact table
        $query = "INSERT INTO employee_contact (EmpID,Phone_Number) VALUES ('$empid','$phone')";

        //if we inserted the above data correctly continue else print error
    if( mysqli_query($con,$query)) {

        //check if program input is filled 
        //if the program form is filled then we know that the employee is a trainer  
        if(isset($program) && trim($program) != '')
        {
  
           if($isprivate == "private"){ //if he/she is a private trainer then add data to private trainer table
          $query = "INSERT INTO private_trainer (Eid,Type,Fee_per_hour) VALUES ('$empid','$program','$fee')";
           } else { //if he/she is a group trainer then add data to group trainer table
          $query = "INSERT INTO group_trainer (Eid,Type) VALUES ('$empid','$program')";  
           }

           mysqli_query($con,$query);

           /* if username filled is filled then that means they have the privlege to access 
               the website so add then to important employees table  */
        if(isset($username) And trim($username) != '' )
        { $query = "INSERT INTO important_employees (id,Username) VALUES ('$empid','$username')"; }

        //run the query int the connection $con
        //con is the connection to the database
                  mysqli_query($con,$query);
                


        }
    } else { echo mysqli_error($con);}

            }
        } else { echo mysqli_error($con); }
    }else { echo mysqli_error($con);}
    


   }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Qahiri&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="employee.css">


    <script src="jquery-3.6.0.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="">Home</a></li>
                    <li><a  class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
                </ul>
            </nav>
           


        
        </header>
        <section class="setting_menu">
            <ul>
                <li><a href="account_info.php#schol_name" >Account Setting</a></li>
                <li><a href="logout.php" >Log Out</a></li>
            </ul>
        </section>
    </article>

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
            
            <li> <a href="manager_dashboard.php" aria-expanded="false">Dashboard</a></li> 
                        <li><a href="manage_member.php">Members</a></li>
                        <li><a href="manage_inventory.php">Inventory</a></li>

                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
                                   
                        <li><a href="manager_payments.php" aria-expanded="false">Payments</a></li>
                        <li><a href="managerworkout.php" aria-expanded="false">Workout Plans</a></li>
                        <li class="submenu_conatiner">
                                <div id="0" class="drop_down-container">
                                    <p>Employees</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                                </div>
                                    <ul aria-expanded="false" class="collapse">
                                    <li><a href="new_employee.php">New Employee</a></li>
                                        <li><a href="view_employee.php">Edit Employee Details</a></li>
                                    </ul>
                            </li>
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>

            <h2 class="main_title" >Register New Employee</h2>
               
            <form class="register_employee-form" method="post" name="employee_registration_form">
                <div>

                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" required="required" autocomplete="off"
                        placeholder="xyz@mail.com">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username">
                    <label for="fname">First Name *</label>
                    <input type="text" name="fname" id="fname" required="required">
                    <label for="lname">Last Name *</label>
                    <input type="text" name="lname" id="lname" required="required">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" name="phone" id="phone" required="required">
                    <label for="age">Date Of Birth *</label>
                    <input type="date" name="dob" id="dob" required="required">
                </div>

                <div>

                    <label for="gender" class="" flex>Gender *</label>
                    <section class="new_emp-gender--container">
                        <section class="gender_subcontainer">
                            <p>Male</p><input type="radio" value="male" name="gender" id="male">
                        </section>
                        <section class="gender_subcontainer">
                            <p>Female</p><input type="radio" value="female" name="gender" id="female">
                        </section>
                    </section>
                    <label for="job" class="job">Job Title *</label>
                    <input type="text"  name="job" id="job" class="job" required="required">
                    <label for="typebool" id="isprivate_label">Type Of Trainer</label>
                    <section class="new_emp-gender--container"  id="isprivate">
                        <section class="gender_subcontainer">
                            <p>Pivate</p><input type="radio" value="private" name="isprivate" id="private" required="required">
                        </section>
                        <section class="gender_subcontainer">
                            <p>Group</p><input type="radio" value="group" name="isprivate" id="group">
                        </section>
                    </section>

                    <label for="salary" class="salary" id="salary_label" >Salary *</label>
                    <input type="number"  name="salary" class="salary" id="salary" >
                    <section id="for_trainer">
                        <label for="program">Program</label>
                        <select name="program" id="program" >
                            <?php
                                include('database_connect.php');

                                $query = "SELECT * FROM main_program";
                                if($result = $con->query($query)){
                                    while($row = $result -> fetch_assoc() ){
                                        $jobtitle = $row['Name'];
                                        echo "<option class='jobtitles_option' value=$jobtitle>$jobtitle</option>";
                                    }
                                }else { echo mysqli_error($con); }
                                                    ?>
                        </select>
                        <label for="fee" class="fee" >Fee per hour</label>
                        <input type="number" name="fee"  class="fee"  id="fee" >
                            </section>
                    <input type="submit" name="submit" value="Submit">

                </div>
            </form>

            </main>
        </section>
    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>

  <script>
        $("#program").val($(".jobtitles_option").first().val());
        $("#private").prop("checked", true);

        document.getElementById("job").addEventListener("blur", () => { 
            //if job title is trainer then show type of trainer input so they can choose private or group level
           if($("#job").val() === "Trainer" || $("#job").val() === "TRAINER" ||  $("#job").val() === "trainer") 
           {  
               $("#for_trainer").show(); 
               $("#isprivate").show(); $("#isprivate_label").show();
               $("#isprivate_label").css("display","block");  
               $("#isprivate").css("display", "flex");
           } 
           else { 
               $("#for_trainer").hide(); 
               $(".isprivate").hide(); $("#isprivate_label").hide();
            }
        })

        //if private is picked show program and fee per hour input
        document.getElementById("private").addEventListener("click", () => { 
            $(".salary").hide();
            $("#salary_label").hide();
            $(".fee").show();

        })
        //if group  is picked show program and salary input

        document.getElementById("group").addEventListener("click", () => { 
            $(".fee").hide();
            $(".salary").show();
            $("#salary_label").show();
        })
  </script>

<script type="text/javascript" src="togglesubmenu.js"></script>

</body>
</html>