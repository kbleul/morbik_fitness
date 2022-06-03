
    <script src="jquery-3.6.0.js"></script>
   
   <?php session_start();  
   
   //if username and email are not set for this session then user has not logged in to the system
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }
    

    include('database_connect.php');
   
   //when assign button is clicked add
     /* first insert data into trainer request table inthe database using values member id,employee id
     time and status */
   if(isset($_POST['submit_assign'])) {
       $mebid = $_POST['mid'];
       $tid = $_POST['eid'];
       $timestr = $_POST['time'];
   
       $query = "INSERT into trainer_request (Mid,Eid,Time,Status) VALUES ('$mebid','$tid','$timestr','Pending');";
   
       if( mysqli_query($con,$query))
       {
           //second updata the member_program_junction to 0 because we have assigned the private trainer to user aleady
           $query = "UPDATE member_program_junction SET Request_pirivate_trainer = 0 WHERE Mid='$mebid';";
            mysqli_query($con,$query);
    
       } else { echo mysqli_error($con);}
   
   }

   if(isset($_POST['sendbtn'])) {  echo '<script>console.log("M1")</script>';
       $towho = $_POST['for'];
       $msg = $_POST['msg'];
       $id = $_SESSION['id'];
       $name = $_SESSION['name'];

       echo "<script>console.log($id.' '.$name)</script>";


       $query = "INSERT into all_notice (id,Name,Groups,Msg) VALUES ('$id','$name','$towho','$msg');";
       
       if( mysqli_query($con,$query))
       {     echo '<script>console.log("Message Sent")</script>'; } 
       else {
            $error = mysqli_error($con);
            echo "<script>console.log($error)</script>"; 
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
   
       <script src="jquery-3.6.0.js"></script>
       <script src="index.js"></script>
       <link rel="stylesheet" href="messages.css">
       <link rel="stylesheet" href="employee.css">

       
   
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

               <div id="topnav">
                    <button id="requests" class="active" onClick='changeMainContent("requests")'>Requests</button>
                    <button id="rejected" onClick='changeMainContent("rejected")'>Declined</button>
                    <button id="rejected" onClick='showNotice_form()'>Send Notice</button>

               </div>
                 <h3 id="title">PRIVATE TRAINER REQUESTS</h3>
   
            <section id="content_wrapper">
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
   
    //get all the member that requested a private trainer from main_members_table
       //if Resquest_Private = 1 then that means the member has requested a private trainer
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
               
   
       /*After getting all the basic info about each member search for their requested time  using their id from the
          member_program_junction table */
                      $query = "SELECT Start_Time, End_Time FROM member_program_junction where Mid = '$id'";
               if($result_two= $con->query($query)){
                   while($row_two= $result_two -> fetch_assoc() ){
                       $starttime = $row_two['Start_Time'];
                       $endtime = $row_two['End_Time'];
                       $class = "member_request-ul";
                       $class_span = 'span_break';
   
   
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
   
   
                //get all the available trainer so the manager can choose one for that specific program
                //program can be yoga, boxing ...
                $query = "SELECT * from `private_trainer_info` where Type='$program_two[0]'";

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

    </section>
                 
               </main>
           </section>
       </article>
     <script type="text/javascript" src="togglesubmenu.js"></script>
   
     <script>

         const changeMainContent = type => {

            if(type === 'rejected')
            {  $("#rejected").addClass('active');
                $("#requests").removeClass('active');
                const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                            $("#content_wrapper").html(firsttime_response);
                            $("#title").html("REJECTED PRIVATE TRAINER REQUESTS");
                    }
            
                                    xmlhttp.open("GET", "fetch_managercontents.php?r=" + "rejected");
                                    xmlhttp.send();
            }
            else {
                $("#rejected").removeClass('active');
                $("#requests").addClass('active');
                const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                         $("#content_wrapper").html(firsttime_response);
                            $("#title").html("PRIVATE TRAINER REQUESTS");
                    }
            
                                    xmlhttp.open("GET", "fetch_managercontents.php?r=" + "requests");
                                    xmlhttp.send();
            }
         }

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
   
       const sendNotice = memid => {
        const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                         if(firsttime_response === "Notice Sent")
                         location.reload();
                    }
            
                                    xmlhttp.open("GET", "fetch_managercontents.php?s=" + memid);
                                    xmlhttp.send();
        }


        
        const showNotice_form = () => {
            $("#title").text("Message Board");

            let html = `<div id='msg_wraapper'><form id='msg_form' method='POST'>
           <div class="formflex"> <label for='for'>To : </label>
            <select id='for' name='for'>
                <option value='Members'>Member</option>
                <option value='Employees' />Employees</option>
                <option value='Trainers' />Trainer</option>
                <option value='Reception' />Reception</option>
                <option value='All' />All</option>
            </select> </div>
            <div class="formflex">
            <textarea id="msg_textarea" type='text' name='msg' placeholder='Message...' required='required'></textarea>
            <button id='sendbtn' type='submit' name='sendbtn'>
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="currentColor" d="M27.71 4.29a1 1 0 0 0-1.05-.23l-22 8a1 1 0 0 0 0 1.87l8.59 3.43L19.59 11L21 12.41l-6.37 6.37l3.44 8.59A1 1 0 0 0 19 28a1 1 0 0 0 .92-.66l8-22a1 1 0 0 0-.21-1.05Z"/></svg>
            </button>
            </div>
            </form>
            </div>`

            $("#content_wrapper").html(html)

            document.getElementById("msg_textarea").addEventListener("input", function (e) {
                    this.style.height = "auto";
                    this.style.height = this.scrollHeight + "px";
                });


        }


     </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>

   
   </body>
   </html>