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

     echo "<script>console.log('decline'+$memid)</script>"; }
     
  
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

                <li><a href="trainer_member.php">Programs</a></li>
                            
                <li><a href="trainer_payments.php" aria-expanded="false">Payments</a></li>
                <li><a href="trainer_excersise.php" aria-expanded="false">Exercise Routine</a></li>
             
            </nav>
        </section>
        <section class="main_content-wrapper">
          
            <main id="front_page">
            <h3>REQUESTS FOR YOU</h3>
                
        <ul class="member_request-ul">
          
        </ul>
            

        

            <?php
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
                                $ulclass = "ul".$counter;
                                $memberinput = "input".$counter;  
                                $trainerinput = "inputtwo".$counter;  
                                $timeinput = "inputthree".$counter;  
                                $conflictbtn = "conflict".$counter;
                                $formid = "form".$counter;
                                 
                    
             $output = "<ul  class='trainer_member_request-ul'><li><span class='requestedby_span'>Requested by</span>  : $name</li>";

                            if($status != "Conflicting") {
                            $output = $output . "<li>$gender</li> <form method='post' id='$formid'>";
                            }
                           
                            $output = $output ."<input type='hidden' id='$memberinput' name='memberid' value='$memberid' />
                            <input type='hidden'  name='trainerid' id='$trainerinput' value='$id' />
                            <input type='hidden'  name='time' id='$timeinput' value='$time' />
                            <li>$time</li>";

                            if($status == "Conflicting") {
                                $output = $output . "<li id='$conflictbtn' class='conflicting'>* Conflcting Schedules 
                                     <button onclick='showConflicting($counter)'>View Here</button></li></ul>";
                            }
                            else {
                                $output = $output . "<li class='accept_decline-list'>
                                 <button type='submit' name='submitaccept' class='accept_btn'>Accept</button>
                                 <button type='submit' name='submitdecline' class='decline_btn'>Declines</button>
                                </li>
                                </form>
                                </ul>";
                            }

                            echo $output;
                            
                            } 
                   $counter = $counter + 1;
                    }else { echo mysqli_error($con);}
                } 
            } else { echo mysqli_error($con);}
            ?>
        </main>

        <article id="hidden_page">

        </article>
        </section>

    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>

  <script>

      const showConflicting = counter => {
        const memberinput = "#input"+counter;  
        const trainerinput = "#inputtwo"+counter;  
        const timeinput = "#inputthree"+counter; 
        const conflictbtn = "conflict"+counter;


        console.log($(timeinput).val().split(" - ")[0]);
        const xmlhttp = new XMLHttpRequest();
                    
        xmlhttp.onload = function() {  
            let firsttime_response = this.responseText; 
              $(conflictbtn).hide();
              $("#hidden_page").html("<p>"+firsttime_response + "</p><button id='hide_hidden-page'>x</button>");
            
              document.getElementById("hide_hidden-page").addEventListener("click", () => {  
                  $("#hidden_page").html(" ");
                  $(conflictbtn).show();
                })

        }

                        xmlhttp.open("GET", "conflicting.php?q=" +  $(timeinput).val().split(" - ")[0]);
                        xmlhttp.send();
                        
      }

    
  </script>

</body>
</html>