
    <?php
    include('database_connect.php');
    
    session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

   if( isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $jobtitle = $_POST['job'];
    $phone = $_POST['phone'];
    $date = date("Y-m-d");


    $output = "";
    $query = "SELECT * FROM employee WHERE Job_title = 'Manager' ";

    if($result= $con->query($query)){
        while($row= $result -> fetch_assoc() ){
            $output = $row['FName'] . " ".$row['LName'];
        }
    } else {
        $error = mysqli_error($con);
        echo "<script>console.log($error)</script>";
       }

       if($output == "") 
       {
        $query = "INSERT INTO employee (FNAME,LName,Gender,DOB,Email,Job_title,Salary,registration_data) 
        VALUES ('$fname','$lname','$gender','$dob','$email','$jobtitle','$salary','$date')";

if( mysqli_query($con,$query)) {
    //select from the employee table using the name and email address so we can get the his/her id given by the database automatically
$query = "SELECT * FROM employee WHERE Email='$email' AND FName='$fname' AND LName='$lname' ";

if($resulttwo = $con->query($query))  {

while($rowtwo = $resulttwo -> fetch_assoc() ){

    //get id
    $empid = $rowtwo['ID'];

    //using the id insert data into the employee contact table
    $query = "INSERT INTO employee_contact (EmpID,Phone_Number) VALUES ('$empid','$phone')";

    if(mysqli_query($con,$query)) {
        $query = "INSERT INTO important_employees (id,Username,Password) VALUES ('$empid','$username','$username')";
        if(mysqli_query($con,$query)) { echo "success final"; }
        else {
            $error = mysqli_error($con);
            echo "<script>console.log($error)</script>";
           }

    } else {
        $error = mysqli_error($con);
        echo "<script>console.log($error)</script>";
       }
    
       }
    }
  }   else {
    $error = mysqli_error($con);
    echo "<script>console.log($error)</script>";
   }
}    //else if manager already exists update new manager



        else { 


        $query = "UPDATE employee SET FName = '$fname', LName = '$lname', Gender = '$gender', DOB = '$dob',Email='$email'
         , Salary = '$salary', registration_data = '$date' WHERE Job_title = 'Manager';";

         if( mysqli_query($con,$query)) {
            $query = "SELECT * FROM employee WHERE Job_title = 'Manager' ";
            $empid = "";

            if($resulttwo = $con->query($query))  {
            
            while($rowtwo = $resulttwo -> fetch_assoc() ){
                //get id
                $empid = $rowtwo['ID'];
            }
        }

    $query = "UPDATE employee_contact SET Phone_Number = '$phone' WHERE EmpID = '$empid' ";
    if(mysqli_query($con,$query)) {
        $query = "UPDATE important_employees SET Username = '$username' , Password = '$username' WHERE id = '$empid';";
        if(mysqli_query($con,$query)) { echo "success final"; }
        else {
            $error = mysqli_error($con) ;
            echo "<script>console.log($error)</script>";
           }

    } else {
        $error = mysqli_error($con) ;
        echo "<script>console.log($error)</script>";
       }
            
         }   else {
            $error = mysqli_error($con) ;
            echo "<script>console.log($error)</script>";
           }

        }



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
    <link rel="stylesheet" href="messages.css">
    <link rel="stylesheet" href="programs.css">
    <link rel="stylesheet" href="employee.css">



    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>

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
                        <li><a href="admin_backup.php" aria-expanded="false">Back Up</a></li>
                        <li><a href="admin_add_manager.php">Add Manager</a></li>
                        <li><a href="manage_inventory.php">Inventory</a></li>

                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
                                   
                        <li><a href="payments.php" aria-expanded="false">Payments</a></li>
                        <li><a href="managerworkout.php" aria-expanded="false">Workout Plans</a></li>
                        <li><a href="managerworkout.php" aria-expanded="false">Employees</a></li>
    
                        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
           <p>Current Manager : <?php
            $query = "SELECT * FROM employee WHERE Job_title = 'Manager'";

            $name = "";
            if($result= $con->query($query)){
                while($row= $result -> fetch_assoc() ){
                    $name = $row['FName'] . " ".$row['LName'];
                }
            } else { $name = "No manager found. "; }

            echo $name;
           ?>
           </p>
           <button id="addManager_btn" onclick="addNewManager()">Add New Manager</button>

        <section id="mypackage"></section>

        </section>

    </article>

    <script>
      const addNewManager = () => {
            const formhtml = `  <main>

<h2 class="main_title" >Register New Employee</h2>
<p class="notice" id="notice">Warning :  This action will remove the current manager.</p>
   
<form class="register_employee-form" method="post" name="employee_registration_form">
    <div>

        <label for="email">Email *</label>
        <input type="email" name="email" id="email" required="required" autocomplete="off"
            placeholder="xyz@mail.com">
        <label for="username">User Name</label>
        <input type="text" name="username" id="username" required="required">
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
        <input type="text"  name="job" id="job" class="job" value='Manager'readonly>
        <input type="submit" name="submit" value="Submit">

    </div>
</form>

</main>`;
$("#mypackage").html(formhtml);
$("#addManager_btn").hide()

      }

    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>