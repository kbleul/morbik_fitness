
    <?php session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }
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
                                    <li><a href="view_plan.php">Edit Employee Details</a></li>
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
               
            <form>
                <div>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required="required" autocomplete="off"
                        placeholder="xyz@mail.com">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" required="required">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" required="required">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" required="required">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" required="required">
                </div>

                <div class="right-form">

                    <label for="age">Date Of Birth</label>
                    <input type="date" name="dob" id="dob" required="required">
                    <label for="gender" class="" flex>Gender</label>
                    <section class="gender_container">
                        <section class="gender_subcontainer">
                            <p>Male</p><input type="radio" value="male" name="gender" id="male">
                        </section>
                        <section class="gender_subcontainer">
                            <p>Female</p><input type="radio" value="female" name="gender" id="female">
                        </section>
                    </section>
                    <label for="weight">Weight</label>
                    <input type="number" max="150" min="40" name="weight" id="weight" placeholder="Weight in kg">
                    <label for="height">Height</label>
                    <input type="number" max="250" min="130" name="height" id="height" placeholder="Height in meter">

                </div>
            </form>

            </main>
        </section>
    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>