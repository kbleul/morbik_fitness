
   <?php session_start();  
   
   //if username and email are not set for this session then user has not logged in to the system
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

 include('database_connect.php');


   if(isset($_POST["submit"])) {
       $eid = $_POST["id"];
       $salary = $_POST["salary"];

       $query = "UPDATE employee set Salary = $salary WHERE ID = '$eid'";

       if(mysqli_query($con,$query)){
           echo "<script>console.log('Salary Updated Successfully');</script>";
       } else { echo mysqli_error($con);}
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
   
       <script src="jquery-3.6.0.js"></script>
       <script src="index.js"></script>
       <script src="jquery-3.6.0.js"></script>

<!-- google translate script 1-->
    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    <!-- Call back function 2 -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    }
    </script>
       <link rel="stylesheet" href="employee.css">

       <link rel="stylesheet" href="messages.css">
       <link rel="stylesheet" href="viewemployee.css">

   
   
       <title>Morbik Fitness</title>
   </head>
   <body id="dashboard_body">
   
       <article class="header_wrapper">
           <header class="flex">
               <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
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
                   <li> <a href="manager_dashboard.php" aria-expanded="false">Dashboard</a></li> 
                        <li><a href="manage_member.php">Members</a></li>
                        <li><a href="manage_inventory.php">Inventory</a></li>

                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
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
                <li id="logout_li" onclick="showPrompt()">Log Out</li>

                   </nav>
           </section>
           <section class="main_content-wrapper" id="main_content-wrapper-sec">
               <main id="main_content-wrapper">
                 <h2 class="main_title">Employees List</h2>
   
                 <div class="employee_type-container">
                     <button class="employee_type_btn active" id="all">All</button>
                     <button class="employee_type_btn" id="important">important <span class="discription"
                     >(once who can access website)</span></button>
                     <button class="employee_type_btn" id="trainer">trainers</button>

                 </div>
                 <ul class="title_ul manage_employee-ul">
                     <li>Full Name</li>
                     <li>gender</li>
                     <li>dob</li>
                     <li>registration date</li>
                     <li>Job title</li>
                     <li>email</li>
                     <li>phone</li>
                     <li>type</li>
                     <li>workout type</li>
                     <li>salary</li>
                                       
                 </ul>
     <section id="list">
                    <?php
   
    include('database_connect.php');
   
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

                   
                    
                echo "<ul class='manage_employee-ul' id='$id' onclick='viewEmployee($id)'>
                <li>$fullname</li>
                <li>$gender</li>
                <li>$dob</li>
                <li>$registration_data</li>
                <li>$job</li>
                <li>$email</li>
                <li>$phone</li>
                <li>$type_program</li>
                <li>$type</li>
                <li>$salary</li>
                <form action='edit_employee.php' method='post'>
                <input type='hidden' name='edit_item[]' value=$fullname >
                <input type='hidden' name='edit_item[]' value=$gender >
                <input type='hidden' name='edit_item[]' value=$registration_data >
                <input type='hidden' name='edit_item[]' value=$job >
                <input type='hidden' name='edit_item[]' value=$dob >
                </form>         
                </ul>";
                   } 
   
               } else { echo mysqli_error($con);}
           }
   
       } else { echo mysqli_error($con);}
                    ?>
     </section>            
               </main>
           </section>
       </article>
     <script type="text/javascript" src="togglesubmenu.js"></script>
   
     <script>

const toggleSideMenus = () => {
        if($("#side_nav-wrapper").hasClass("sidemenu_on"))
        {
            $("#side_nav-wrapper").removeClass("sidemenu_on")
            $("#side_nav-wrapper").hide();
            $("#main_content-wrapper-sec").slideDown(300);
        } else {
            $("#side_nav-wrapper").addClass("sidemenu_on")
            $("#side_nav-wrapper").slideDown(300);
            $("#main_content-wrapper-sec").hide();
        }
    }


  const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
    }

    document.getElementById("all").addEventListener("click", () => fetchData("all"));
    document.getElementById("important").addEventListener("click", () => fetchData("important"));
    document.getElementById("trainer").addEventListener("click", () => fetchData("trainer"));

    const fetchData = type => {
        const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let fetched_response = this.responseText; 
                        
                            if(fetched_response === "Not Found" || fetched_response === "")
                            {
                               
                                $("#list").html(`<p class='fetch_error-p'>Error. Fetch ${type} employee data failed. </p>`);
                            }
                            
                            else {  
                                $("#list").html(fetched_response);

                                    if(type == "trainer")
                                    { 
                                        document.getElementById("all").classList.remove("active");
                                        document.getElementById("important").classList.remove("active");
                                        document.getElementById("trainer").classList.add("active");
                                    }
                                    else if(type == "all")
                                    { 
                                        document.getElementById("all").classList.add("active");
                                        document.getElementById("important").classList.remove("active");
                                        document.getElementById("trainer").classList.remove("active");
                                    }
                                    else if(type == "important")
                                    { 
                                        document.getElementById("all").classList.remove("active");
                                        document.getElementById("important").classList.add("active");
                                        document.getElementById("trainer").classList.remove("active");
                                    }
                        }
                    }
        
                        xmlhttp.open("GET", "viewemployee_fetch.php?q=" + type);
                        xmlhttp.send();
    }

    const editInfo = (arr) => { 
        console.log(arr)
    }

    const viewEmployee = (id) => {

        const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                         $("#main_content-wrapper").html(' <h2 class="main_title">Single Employee</h2>'+firsttime_response);
                            $("#title").html("PRIVATE TRAINER REQUESTS");
                    }
            
                                    xmlhttp.open("GET", "fetch_singleemployee.php?r=" + id);
                                    xmlhttp.send();
    }

   
     </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>
   
   </body>
   </html>