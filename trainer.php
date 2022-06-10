<?php
    session_start();
    if( isset($_SESSION["email"]) == false || isset($_SESSION["username"] ) == false)
    {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }
  
    $id = $_SESSION['id'];
    $type = "";


    include('database_connect.php');
    $query = "SELECT * FROM group_trainer WHERE Eid = $id ";

        if($result = $con->query($query)){
            $count = mysqli_num_rows($result);
            if($count == 0) { $type = 'private'; }
            else { $type = 'group'; }
        } else { echo "<script>console.log(".mysqli_error($con).')</scriipt>'; }

        echo "<script>console.log('$type');</script>";
        echo "<script>console.log('$id');</script>";

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
    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="trainer.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                <li><div id="google_translate_element" class="google_translate_element"></div></li>                    
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
            
                <li> <a href="trainer.php" aria-expanded="false">Dashboard</a></li> 
                <li><a href="trainer_messages.php" aria-expanded="false">Messages/Requests</a></li>
                <li><a href="trainer_workout.php" aria-expanded="false">Workout Plan</a></li>
                <li id="logout_li" onclick="showPrompt()">Log Out</li>

            </nav>
        </section>
        <section id="main_content-wrapper" class="main_content-wrapper">
            <main>
                <section class="boxes_container">
                    <div class="boxes">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.11 0-2 .89-2 2v11c0 1.11.89 2 2 2h4v5l4-2l4 2v-5h4c1.11 0 2-.89 2-2V4c0-1.11-.89-2-2-2zm0 13H4v-2h16v2zm0-5H4V5c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v5z"/></svg>
                        <div class="boxes_discription">
                            <p class="count"><?php

        $query = "";
        $total = 0;
        $program = "";

                if($type == "private")
          {  $query = "SELECT * FROM main_members_table  WHERE Private_Trainer_Id = $id"; }
           
          else {  $query = "SELECT * FROM main_members_table  WHERE TrainerId = $id";    }

        if($result = $con -> query($query)){
                $count = mysqli_num_rows($result);
                     echo $count;
                     $total = $count;

        } else { echo "<script>console.log(".mysqli_error($con).')</scriipt>'; }
                            
                            ?></p>
                            <p>Total Members</p>
                        </div>
                    </div>
                    <div class="boxes">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path fill="currentColor" d="m34.59 23l-4.08-5l4-4.9a1.82 1.82 0 0 0 .23-1.94a1.93 1.93 0 0 0-1.8-1.16h-31A1.91 1.91 0 0 0 0 11.88v12.25A1.91 1.91 0 0 0 1.94 26h31.11a1.93 1.93 0 0 0 1.77-1.09a1.82 1.82 0 0 0-.23-1.91ZM2 24V12h30.78l-4.84 5.93L32.85 24Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M9.39 19.35L6.13 15H5v6.18h1.13v-4.34l3.26 4.34h1.12V15H9.39v4.35z" class="clr-i-outline clr-i-outline-path-2"/><path fill="currentColor" d="M12.18 21.18h4.66v-1.02h-3.53v-1.61h3.19v-1.03h-3.19v-1.49h3.53V15h-4.66v6.18z" class="clr-i-outline clr-i-outline-path-3"/><path fill="currentColor" d="M24.52 19.43L23.06 15h-1.22l-1.47 4.43L19.05 15h-1.23l1.96 6.18h1.11l1.56-4.59L24 21.18h1.13L27.08 15h-1.23l-1.33 4.43z" class="clr-i-outline clr-i-outline-path-4"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        <div class="boxes_discription">
                            <p class="count"><?php
                $month = date('m');
                $query = "";

                if($type == "private")
        {   
            $query = "SELECT * FROM main_members_table  WHERE month(registration_date) = $month AND  Private_Trainer_Id = $id"; 
            if($result = $con->query($query)){
                $count=mysqli_num_rows($result);
                echo $count;
            }
            
            $query = "SELECT * FROM main_members_table  WHERE  Private_Trainer_Id = $id"; 

            $tablehtml = '<h3>My Members</h4>
            <ul class="trainer_mem_subul_private"><li>Name</li><li>Program</li><li>Schedule</li></ul>';
            if($result = $con->query($query)){

                while($row = $result -> fetch_assoc()) {
                    $name = $row['FName']. " ".$row['LName'];
                    $schedule = $row['schedule_start']." - ".$row['Schedule_end'];
                    $program = $row['Name'];

          $tablehtml = $tablehtml . "<ul class='trainer_mem_subul_private_nonheader'><li class='name'>".$name."</li><li>".$program."</li><li>".$schedule."</li></ul>";
                    

                }
            } else { echo "<script>console.log(".mysqli_error($con).')</scriipt>'; }
        }
        else  {   $query = "SELECT * FROM main_members_table  WHERE month(registration_date) = $month AND TrainerId = $id ";   
        
            $tablehtml = '<h3>My Members</h4>
            <ul class="trainer_mem_subul"><li>Name</li><li>Gender</li><li>Reg Date</li><li>Program</li></ul>';
                    if($result = $con->query($query)){
                        $count=mysqli_num_rows($result);
                        echo $count;

                        while($row = $result -> fetch_assoc()) {
                            $name = $row['FName']. " ".$row['LName'];
                            $gender = $row['Gender'];
                            $regdate = $row['registration_date'];
                            $program = $row['Name'];

           $tablehtml = $tablehtml . "<ul><li>".$name."</li><li>".$gender."</li><li>".$regdate."</li><li>".$program."</li></ul>";
                            

                        }
                    } else { echo "<script>console.log(".mysqli_error($con).')</scriipt>'; }
                } 
                
                            ?></p>
                            <p>Joined This Month</p>
                        </div>
                    </div>
                    
                </section>  
                
                <ul class='trainer_mem_ul'>
                    <?php
                      if($total > 0) { echo $tablehtml; }
                    ?>
                </ul>

                
                <section class="lastsection">
                    
                    <ul class='scheduale_ul'> <?php

        $tablehtml = "";
                        if($total > 0) {

                            if($type == 'group') {
    $query = "SELECT * FROM program_time where Timeid LIKE '%$program%' ";

                    if($result = $con ->query($query)){
                        while($row = $result -> fetch_assoc()){
                            $class = $row['Class'];
                            $time = $row['StartTime']." - ".$row["EndTime"];
                $tablehtml = $tablehtml . "<ul class='class'><li class='class_li'>$class</li><li>$time</li></ul>";
                        }
                        echo $tablehtml;
                    } else { echo "<script>console.log(".mysqli_error($con).')</scriipt>'; }
                }
               }

                        ?>
                    </ul>
                </section>

            </main>
        </section>
    </article>
    <script>
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
      const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
          }
  </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>