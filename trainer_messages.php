<?php
    session_start();
    if( isset($_SESSION["email"]) == false || isset($_SESSION["username"] ) == false)
    {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

    include('database_connect.php');
   if(isset($_POST['submitaccept'])) {

       $memid = $_POST['memberid'];
       $trainerid = $_POST['trainerid'];
       $time = $_POST['time'];

       $issame_time = false;


       $query = "SELECT * FROM member_program_junction WHERE Private_Trainer_Id = '$trainerid' ";

       if($result_check = $con->query($query)){
        while($row_check = $result_check -> fetch_assoc() ){
            $timetwo = $row_check['Start_Time']." - " .$row_check['End_Time'];

            echo "<script>console.log('---'+$time)</script>";
            echo "<script>console.log('---'+$timetwo)</script>";
            echo "<script>console.log($timetwo === $time)</script>";
            

            if($time == $row_check['Start_Time']." - ".$row_check['End_Time'])
                    {  $issame_time = true; break; }
        }
      }

      
    if($issame_time == true)
    {  
        $query = "UPDATE trainer_request SET Status = 'Conflicting' WHERE Mid = '$memid' AND Eid = '$trainerid'";
        if(mysqli_query($con,$query))
        { 
            echo "<script>console.log('done'+$memid)</script>";
        } else  {  echo mysqli_error($con); }
    }
     else {

       $query = "UPDATE trainer_request SET Status = 'Accepted' WHERE Mid = '$memid' AND Eid = '$trainerid' ";


       if(mysqli_query($con,$query))
       {
           $query = "UPDATE member_program_junction SET Private_Trainer_Id = '$trainerid' WHERE Mid = '$memid'";
           if(mysqli_query($con,$query))
           {  
            echo "<script>console.log('done'+$memid)</script>";
        }
            else { echo mysqli_error($con);  }

       } else  {  echo mysqli_error($con); }
    
        echo "<script>console.log('accept'+$memid)</script>"; 
    }

    
   }


   if(isset($_POST['submitdecline']))
   { 
    $memid = $_POST['memberid'];
    $trainerid = $_POST['trainerid'];

    $query = "UPDATE trainer_request SET Status = 'Rejected' WHERE Mid = '$memid' AND Eid = '$trainerid' ";

    if(!mysqli_query($con,$query))
    { echo mysqli_error($con);  }

     echo "<script>console.log('decline'+$memid)</script>"; 
    }
     


    function fetchRequests () {
        include('database_connect.php');

        $id = $_SESSION['id'];
        $counter = 0;
        $query = "SELECT * from trainer_request WHERE Eid = '$id' AND Status = 'Pending' OR Status = 'Conflicting'";

        if($result= $con->query($query)){
            while($row= $result -> fetch_assoc() ){
                    $mid = $row['Mid'];
                    $time = $row['Time'];
                    $status = $row['Status'];
        $query = "SELECT * FROM member WHERE ID ='$mid'";

                if($result_two= $con->query($query)){
                    while($row_two= $result_two -> fetch_assoc() ){
                        $name = $row_two['FName']. " ".$row_two['LName'];
                        $gender = $row_two['Gender'];
                        $memberid = $row_two['ID'];
                        $ulid = "ul".$counter;
                        $memberinput = "input".$counter;  
                        $trainerinput = "inputtwo".$counter;  
                        $timeinput = "inputthree".$counter;  
                        $conflictbview_btn = "conflict".$counter;
                        $conflictbdecline_btn = "conflictbtn".$counter;
                        $formid = "form".$counter;
                         
            
     $output = "<ul id='$ulid' class='trainer_member_request-ul'><li><span class='requestedby_span'>Requested by</span>  : $name</li>";

                    if($status != "Conflicting") {
                    $output = $output . "<li>$gender</li> <form method='post' id='$formid'>";
                    }
                   
                    $output = $output ."<input type='hidden' id='$memberinput' name='memberid' value='$memberid' />
                    <input type='hidden'  name='trainerid' id='$trainerinput' value='$id' />
                    <input type='hidden'  name='time' id='$timeinput' value='$time' />
                    <li>$time</li>";

                    if($status == "Conflicting") {
                        $output = $output . "<li id='$conflictbview_btn' class='conflicting'>* Conflcting Schedules Detected:
                             <button onclick='showConflicting($counter)'>View Here</button></li>
                             <button id='$conflictbdecline_btn' class='conflicting_decline-btn' onclick='rejectConflicting($counter)'>Decline</button>
                             </ul>
                             <article id='hidden_page'></article>";
                    }
                    else {
                        $output = $output . "<li class='accept_decline-list'>
                         <button type='submit' name='submitaccept' class='accept_btn'>Accept</button>
                         <button type='submit' name='submitdecline' class='decline_btn'>Declines</button>
                        </li>
                        </form>
                        </ul>";
                    }

                    return $output;
                    
                    } 
           $counter = $counter + 1;
            }else { return mysqli_error($con);}
        } 
    } else { return mysqli_error($con);}
    }
  
    function fetchMessages () {
    include('database_connect.php');

        $query = "SELECT * FROM all_notice WHERE Groups = 'All' OR Groups = 'Employees' ORDER BY Time ASC";
        $output = "";
        $counter = 0;
        $managername = "";

        if($result = $con->query($query)) {
             $rowcount=mysqli_num_rows($result);

             if($rowcount == 0) { $output = "<div id='msgbox'><p>No messages yet.</p></div>"; }
            else if($rowcount > 0 ) {  $output = $output . "<div id='msgbox'><div id='sidenav'>
                <button onclick='fetchMessages()'>My Inbox</button><button onclick='toggleToWho()'>My Members</button>
                <div class='hidden' id='forwho'></div>
                </div>";  }

            $query = "SELECT * FROM employee WHERE ID = 2";

    if($resulttwo = $con->query($query)) {
        while($rowtwo = $resulttwo->fetch_assoc()) {
            $managername = $rowtwo['FName']." ".$rowtwo['LName'];
        //    $memid = $_SESSION['id'];
          }
        }  else { $output = mysqli_error($con); }

             while($row = $result->fetch_assoc()) {
                $name = $row['Name'];
                $group = $row['Groups'];
                $msg = $row['Msg'];
                $time = $row['Time'];

                if($counter == 0)
                {
                 $output = $output . "<ul class='msgul' id='msgul'><li class='msg_from'>From : $name </li><div class='msg_subwrapper'><li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
                }
                else {
                    $output = $output . "<li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
                    }
                   
                    $counter++;
             }
             if($output != "") { $output = $output . "</div></ul>"; }
        }  
        else { $output = mysqli_error($con); }
  return $output;
    }

    function fetchToWho () {
    include('database_connect.php');

    $id = $_SESSION['id'];
    $isprivate = true;
    $query = "";
    $output = "";


    $query = "SELECT * FROM group_trainer WHERE Eid = $id";
        if($isprivate_result = $con -> query($query)) {
             $rowcount = mysqli_num_rows($result);
             if($rowcount > 0) { $isprivate = false; }
        }

        if($isprivate == true) 
    {  
        $query = "SELECT * from main_members_table where Private_Trainer_Id = $id";  
    $counter = 0;

        if($result = $con -> query($query)) {
            $output = $output . "<ul class='forwho_ul' id='forwho_ul' >";
            while($row = $result -> fetch_assoc()){
                $memid = $row['ID'];
                $name = $row['FName']. " ".$row['LName'];
                    $output = $output . "<li class='forwho_li' onclick='renderSendMsg_form($memid)'>$name</li>";
           
           $counter++;
                }
            $output = $output . "</ul>";
        } else { $output = mysqli_error($con);}
    } 

    else  if($isprivate == true) 
    {  
        $query = "SELECT * from main_members_table where Private_Trainer_Id = $id";  
    $counter = 0;



        if($result = $con -> query($query)) {
            $output = $output . "<ul class='forwho_ul' id='forwho_ul' >";
            while($row = $result -> fetch_assoc()){
                $memid = $row['ID'];
                $name = $row['FName']. " ".$row['LName'];
                    $output = $output . "<li class='forwho_li' onclick='renderSendMsg_form($memid)'>$name</li>";
           
           $counter++;
                }
            $output = $output . "</ul>";
        } else { $output = mysqli_error($con);}
    }
        return $output;
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
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="programs.css">
    <link rel="stylesheet" href="trainer.css">



    <!-- google translate script 1-->
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
        </script>


    <script src="jquery-3.6.0.js"></script>

    <title>Morbik Fitness</title>

    <script>
        const fetchRequests = () => {
            let result = <?php $fetchresult = fetchRequests(); echo json_encode($fetchresult); ?>;
                 $("#member_request-ul").html(result);
                 $("#title").show();
        }

        const fetchMessages = () => {
            let result = <?php $fetchresult = fetchMessages(); echo json_encode($fetchresult); ?>;
                 $("#member_request-ul").html(result);
                 $("#title").hide();
        }

        const toggleToWho = () => {
            let result = <?php $fetchresult = fetchToWho(); echo json_encode($fetchresult); ?>; console.log("aaa : " + result); 
                 $("#forwho").html(result).toggle();
        }

        const renderSendMsg_form = index => { console.log(" renderSendMsg_form " + index)
            const xmlhttp = new XMLHttpRequest();

            xmlhttp.onload = function () {
                const result = this.responseText;

               if(document.getElementById("msgul") ) 
                   {   $("#msgul").html(result);   }
               else if(document.getElementById("msgul_two") ) 
                   {   $("#msgul_two").html(result);   }

               if(document.getElementById("sidenav") ) 
                 { document.getElementById("sidenav").id = "sidenav_two"; }
               if(document.getElementById("msgul")) 
                 { document.getElementById("msgul").id = "msgul_two"; }

            }
            xmlhttp.open('GET', "renderSendMsg_form.php?i=" + index);
            xmlhttp.send();
            console.log(document.getElementById("sidenav"))
            
        }

    </script>
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
                    <!-- HTML element 3 -->
                    <li><div id="google_translate_element"></div></li>
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
            
                <li> <a href="trainer.php" aria-expanded="false">Dashboard</a></li> 

                <li><a href="trainer_member.php">Programs</a></li>
                            
                <li><a href="trainer_payments.php" aria-expanded="false">Payments</a></li>
                <li><a href="trainer_excersise.php" aria-expanded="false">Exercise Routine</a></li>
             
            </nav>
        </section>
        <section class="main_content-wrapper">
          
        <div class='topnav'>
            <button onclick="fetchRequests()">Requests</button>
            <button onclick="fetchMessages()">Messages</button>
        </div>
            <main id="front_page">
            <h3 id="title">REQUESTS FOR YOU</h3>
                
        <ul class="member_request-ul" id="member_request-ul">
               <script>fetchRequests();</script>   
        </ul>
      
        </main>

      
        </section>

    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>

  <script>

      const rejectConflicting = counter => {
        const memberinput = "#input"+counter;   
        const ulid = "#ul"+counter;

        const xmlhttp = new XMLHttpRequest();
                    
        xmlhttp.onload = function() {  
            let firsttime_response = this.responseText;  
             console.log(firsttime_response);
                $(ulid).remove();
                $("#hidden_page").remove();
        }

                        xmlhttp.open("GET", "conflicting.php?r=" +  $(memberinput).val());
                        xmlhttp.send();
      }

      const showConflicting = counter => {
        const memberinput = "#input"+counter;  
        const trainerinput = "#inputtwo"+counter;  
        const timeinput = "#inputthree"+counter; 
        const conflictbtn = "#conflict"+counter;
        const conflictbtn2 = "#conflictbtn"+counter;


        $(conflictbtn).hide();
        $(conflictbtn2).show();

        const xmlhttp = new XMLHttpRequest();
                    
        xmlhttp.onload = function() {  
            let firsttime_response = this.responseText; 
              $("#hidden_page").html("<p>"+firsttime_response + "</p><button id='hide_hidden-page'>x</button>");
            
              document.getElementById("hide_hidden-page").addEventListener("click", () => {  
                  $("#hidden_page").html(" ");
                  $(conflictbtn).show();
                  $(conflictbtn2).hide();
                })

        }

                        xmlhttp.open("GET", "conflicting.php?q=" +  $(timeinput).val().split(" - ")[0]);
                        xmlhttp.send();
                        
      }

    
  </script>

</body>
</html>