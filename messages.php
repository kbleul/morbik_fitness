
    <script src="jquery-3.6.0.js"></script>
   
   <?php session_start();  
   
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }
    

    include('database_connect.php');
   
   
   if(isset($_POST['submit_assign'])) {
       $mebid = $_POST['mid'];
       $tid = $_POST['eid'];
       $timestr = $_POST['time'];
   
       $query = "INSERT into trainer_request (Mid,Eid,Time,Status) VALUES ('$mebid','$tid','$timestr','Pending');";
   
       if( mysqli_query($con,$query))
       {
           $query = "UPDATE member_program_junction SET Request_pirivate_trainer = 0 WHERE Mid='$mebid';";
            mysqli_query($con,$query);
    
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
       <link rel="stylesheet" href="messages.css">
   
   
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
               
   
                               <li><a href="payments.php" aria-expanded="false">Payments</a></li>
   
                               <li class="submenu_conatiner">
                                   <div id="0" class="drop_down-container">
                                       <p>Employees</p>
                                       <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                                   </div>
                                       <ul aria-expanded="false" class="collapse">
                                           <li><a href="new_plan.php">New Employee</a></li>
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
                 <h3>PRIVATE TRAINER REQUESTS</h3>
   
                 <ul class="member_request-ul">
                     <li>Full Name</li>
                     <li>gender</li>
                     <li>program</li>
                     <li>plan</li>
                     <li>Requested Time</li>
                     <li> </li>
                     
                 </ul>
   
                    <?php
   
    include('database_connect.php');
   
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
   
                $query = "SELECT * from `private_trainer_info` where Type='$program_two[0]'";
   
                $counter = $counter + 1;
   
   
                echo "<ul class='$class'><li>$fullname</li>
                <li>$gender</li>
                <li>$program</li>
                <li>$plan</li>
                <li>Requested time <span class='$class_span'> $starttime - $endtime </span></li>
                <li class='trainers_list'>
                <span id='assign$counter'>Assign Trainer</span> 
                <button id='a$counter' class='show_select_btn' onclick='showSelect($counter)'>Assign</button>
                <form method='post'>
                <select id='s$counter' class='trainer' name='trainer_select'>$program_two";
   
   
                if($result_three = $con->query($query)){
                   while($row_three = $result_three -> fetch_assoc() ){
                       $trainerid = $row_three['ID'];
                       $tainername = $row_three['FName']." ".$row_three['LName'];
                      echo "<option class='traineroption' value=$tainername>$tainername</option>";
                   } 
                } else { echo mysqli_error($con);}
   
                $time = $start_time."-".$end_time;
   
               echo " </select>
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
   
       } else { echo mysqli_error($con);}
                    ?>
                 
               </main>
           </section>
       </article>
     <script type="text/javascript" src="togglesubmenu.js"></script>
   
     <script>
       let counter = 0;
       for(let element of document.getElementsByClassName("trainer")) { 
           

           if($(element).find(".traineroption").first().val() === undefined)
            {  
                $(element).find(".traineroption").first().val("No available trainers");
                $(element).val($(element).find(".traineroption").first().val()) ; 
                console.log($(element).val());
            }
            else {
                document.getElementsByClassName("trainer")[counter].value =   $(element).find(".traineroption").first().val();
           console.log("--"+ $(element).find(".traineroption").first().val())
            }
           
            counter++;
       }
   
       const showSelect = (index) => { 
           id = "#s"+index;
           idtwo = "#a"+index;
           idthree = "#b"+index;
           idfour = "#error"+index;
           idfive = "#assign"+index;

           $(idtwo).hide();
           $(idfive).hide();

          if($(id).val() !== null) {  
              $(id).show();  
              $(idthree).show();
          }
          else { $(idfour).show(); }
          console.log($(id).val());
   
       }
   
     </script>
   
   </body>
   </html>