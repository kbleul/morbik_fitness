
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

 <!-- google translate script 1-->
 <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
        </script>

    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="admin_dashboard.php"  id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                 <div id="google_translate_element" class="google_translate_element"></div>
                </ul>
            </nav>
        </header>
    </article>

    <article class="main_wrapper">
    <div id="burgermenu_sidnav_wrapper">
        <button id="burgermenu_btn_sidenav" onclick="toggleSideMenus()">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.75 12.25h10.5m-10.5-4h10.5m-10.5-4h10.5"/></svg>
        </button>
    </div>

        <section id="side_nav-wrapper" class="side_nav-wrapper">
            <nav>
                <li> <a href="admin_dashboard.php" aria-expanded="false">Dashboard</a></li> 
                <li> <a href="admin_addmanager.php" aria-expanded="false">Add Manager</a></li> 
                <li><a href="admin_backup.php" aria-expanded="false">Back Up</a></li>
                <li id="logout_li" onclick="showPrompt()">Log Out</li>
            </nav>
        </section>
        <section id="main_content-wrapper" class="main_content-wrapper">
           <p id="current_manager_p" class='non_p'>Current Manager : <?php
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

    const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

            if(do_logout) { location.href = "logout.php";  }
        }

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

    $("#notice").show()

      }

      const toggleSideMenus = () => {
        if($("#side_nav-wrapper").hasClass("sidemenu_on"))
        {
            $("#side_nav-wrapper").removeClass("sidemenu_on")
            $("#side_nav-wrapper").hide();
            $("#main_content-wrapper").slideDown(300);
        } else {
            $("#side_nav-wrapper").addClass("sidemenu_on")
            $("#side_nav-wrapper").slideDown(300);
            $("#main_content-wrapper").hide();
        }
    }
    </script>

  
    
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>