
    <?php session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

   include('database_connect.php');

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

    $query = "INSERT INTO employee (FNAME,LName,Gender,DOB,Email,Job_title,Salary) 
               VALUES ('$fname','$lname','$gender','$dob','$email','$jobtitle','$salary')";
 echo "<script>console.log('1')</script>";
    if( mysqli_query($con,$query)) {
   $query = "SELECT * FROM employee WHERE Email='$email' AND FName='$fname' AND LName='$lname' ";
   echo "<script>console.log('2')</script>";

   if($result = $con->query($query)){
 echo "<script>console.log('3')</script>";

    while($row = $result -> fetch_assoc() ){
        $empid = $row['ID'];
    
        $query = "INSERT INTO employee_contact (EmpID,Phone_Number) VALUES ('$empid','$phone')";

    if( mysqli_query($con,$query)) {
 echo "<script>console.log('4')</script>";

        if(isset($program) && isset($fee) && trim($program) != '' && trim($fee) != '')
        {
 echo "<script>console.log('5')</script>";

          $query = "INSERT INTO private_trainer (Eid,Type,Fee_per_hour) VALUES ('$empid','$program','$fee')";
                  mysqli_query($con,$query);
        if(isset($username) And trim($username) != '' )
        { $query = "INSERT INTO important_employees (id,Username) VALUES ('$empid','$username')"; }
                  mysqli_query($con,$query);
                
 echo "<script>console.log('6')</script>";


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
            
                        <li> <a href="dashboard.php" aria-expanded="false">Dashboard</a></li> 
        
                        <li><a href="manage_member.php">Members</a></li>
                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
                                   
                        <li><a href="payments.php" aria-expanded="false">Payments</a></li>

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

                        <li class="submenu_conatiner">
                            <div id="1" class="drop_down-container">
                            <p>Plan</p>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>    
                            </div> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_plan.php">New Plan</a></li>
                               <li><a href="view_plan.php">Edit Subsciption Details</a></li>
                            </ul>
                        </li>
                        <li  class="submenu_conatiner">
                            <div id="2" class="drop_down-container">
                                 <p>Overview</p>
                                 <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                            </div>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="over_members_month.php">Members per Month</a></li>
                                <li> <a href="over_members_year.php">Members per Year</a></li>
                                <li> <a href="revenue_month.php">Income per Month</a> </li>
                            </ul>
                        </li>

                         <li class="submenu_conatiner">
                          <div id="3" class="drop_down-container">
                             <p>Exercise Routine</p>
                             <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                          </div>
                            <ul  aria-expanded="false" class="collapse">
                               <li><a href="addroutine.php">Add Routine</a> </li>
                               <li> <a href="editroutine.php">Edit Routine</a> </li>
                               <li> <a href="viewroutine.php">View Routine</a></li>
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
                    <label for="salary">Salary *</label>
                    <input type="number"  name="salary" id="salary" required="required" >
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
                        <label for="fee" >Fee per hour</label>
                        <input type="number" name="fee" id="fee" >
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

        document.getElementById("job").addEventListener("blur", () => { 
            console.log($("#job").val())
           if($("#job").val() === "Trainer" || $("#job").val() === "TRAINER" ||  $("#job").val() === "trainer") 
           {  $("#for_trainer").show() } else { $("#for_trainer").hide() ; }
        })
  </script>


</body>
</html>