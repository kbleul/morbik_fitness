
    <?php
    include('database_connect.php');
    
    session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

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
                <button class='sidenav_btn' onclick='fetchMessages()'>
                  <p class='sidenav_btn_txt'>My Inbox</p>
                  <p><svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='1.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><path fill='currentColor' d='M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h9v-2H4V8l8 5l8-5v5h2V6c0-1.1-.9-2-2-2zm-8 7L4 6h16l-8 5zm7 4l4 4l-4 4v-3h-4v-2h4v-3z'/></svg>
                 </p></button>
                 <button class='sidenav_btn' onclick='fetchGroupMessages()'>
                <p class='sidenav_btn_txt'>All Members<p>
                <p><svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='1.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><path fill='currentColor' d='m18 7l-1.41-1.41l-6.34 6.34l1.41 1.41L18 7zm4.24-1.41L11.66 16.17L7.48 12l-1.41 1.41L11.66 19l12-12l-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12L.41 13.41z'/></svg>
                </p></button>
                <button class='sidenav_btn' onclick='toggleToWho()'>
                <p class='sidenav_btn_txt'>Members<p>
                <p><svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='1.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 1200 1200'><path fill='currentColor' d='M596.847 188.488c-103.344 0-187.12 97.81-187.12 218.465c0 83.678 40.296 156.352 99.468 193.047l-68.617 31.801l-182.599 84.688c-17.64 8.821-26.444 23.778-26.444 44.947v201.102c1.451 25.143 16.537 48.577 40.996 48.974h649.62c27.924-2.428 42.05-24.92 42.325-48.974V761.436c0-21.169-8.804-36.126-26.443-44.947l-175.988-84.688l-73.138-34.65c56.744-37.521 95.061-108.624 95.061-190.197c-.001-120.656-83.778-218.466-187.121-218.466zm-301.824 76.824c-44.473 1.689-79.719 20.933-106.497 51.596c-29.62 36.918-44.06 80.75-44.339 124.354c1.819 64.478 30.669 125.518 82.029 157.446L21.163 693.997C7.05 699.289 0 711.636 0 731.041v161.398c1.102 21.405 12.216 39.395 33.055 39.703h136.284V761.436c2.255-45.639 23.687-82.529 62.196-100.531l136.247-64.817c10.584-6.175 20.731-14.568 30.433-25.152c-56.176-86.676-63.977-190.491-27.773-281.801c-23.547-14.411-50.01-23.672-75.419-23.823zm608.586 0c-29.083.609-55.96 11.319-78.039 26.444c35.217 92.137 25.503 196.016-26.482 276.52c11.467 13.23 23.404 23.377 35.753 30.434l130.965 62.195c39.897 21.881 60.47 59.098 60.866 100.532v170.707h140.235c23.063-1.991 32.893-20.387 33.093-39.704V731.042c0-17.641-7.05-29.987-21.163-37.045l-202.431-96.618c52.498-38.708 78.859-96.72 79.369-156.117c-1.396-47.012-15.757-90.664-44.339-124.354c-29.866-32.399-66.91-51.253-107.827-51.596z'/></svg>
                </p></button>
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
                 $output = $output . "<ul class='msgul' id='msgul'><li class='msg_from'><button class='msgside_nav-btn' onClick='showMsgNav()'>
                 <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='2em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 32 32'><circle cx='16' cy='8' r='2' fill='currentColor'/><circle cx='16' cy='16' r='2' fill='currentColor'/><circle cx='16' cy='24' r='2' fill='currentColor'/></svg>
                 </button>
                 <p class='from_p'>From : $name <p></li><div class='msg_subwrapper'><li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
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

    function fetchToWho () 
    {
      include('database_connect.php');

        $id = $_SESSION['id'];
        $output = "";

        $query = "SELECT * from member";  

        if($result = $con -> query($query)) {
            $output = $output . "<ul class='forwho_ul' id='forwho_ul' >";
            while($row = $result -> fetch_assoc()){
                $memid = $row['ID'];
                $name = $row['FName']. " ".$row['LName'];
                    $output = $output . "<li class='forwho_li' onclick='renderSendMsg_form($memid)'>$name</li>";

                }
            $output = $output . "</ul>";
        } else { $output = mysqli_error($con);}

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

    <!-- <link rel="stylesheet" href="cashier.css"> -->
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
    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">
    <script>
      const fetchMessages = () => {
            let result = <?php $fetchresult = fetchMessages(); echo json_encode($fetchresult); ?>;
                 $("#member_request-ul").html(result);
                 $("#title").hide();
               //  $("#msgul").slideDown(800)
        }
        const fetchGroupMessages = () => {
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
                // $("#sidenav_two").hide()
                //  $("#msgul_two").slideDown(800)
            }
            xmlhttp.open('GET', "renderSendMsg_form.php?g=group" );
            xmlhttp.send();
    }

    const sendMessage = index => {
           // console.log(index == "Group")

            if($("#msg_textarea").val() == "" || $("#msg_textarea").val() == " ") { $("#msg_textarea").focus(); }
            else {

                $msg = $("#msg_textarea").val();
            const xmlhttp = new XMLHttpRequest();


            xmlhttp.onload = function() {
                const result = this.responseText;
                console.log(result)
            index == "Group" ? fetchGroupMessages() :  renderSendMsg_form(index);
            }

            if(index == "Group") { 
                xmlhttp.open('GET', "renderSendMsg_form.php?grp=" + $msg)
            }
            else {
                xmlhttp.open('GET', "renderSendMsg_form.php?s=" + index + "&msg=" + $msg)
            }
                 xmlhttp.send()
          }
        }

        const toggleToWho = () => {
            let result = <?php $fetchresult = fetchToWho(); echo json_encode($fetchresult); ?>; console.log("aaa : " + result); 
                 $("#forwho").html(result).toggle();
        }

        const renderSendMsg_form = index => { 
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

                 $("#msgul_two").slideDown(800)

            }
            xmlhttp.open('GET', "renderSendMsg_form.php?i=" + index);
            xmlhttp.send();
            
        }
    </script>

    <article class="header_wrapper">
        <header class="flex">
            <a  href="cashier_addrecipt.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
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
                <li><a href="cashier_addrecipt.php">Make Payments</a></li>
                <li><a href="cashier_paymenthistory.php">Payments History</a></li>               
                <li><a href="cashier_messages.php">Messages/Requests</a></li>            
                <li id="logout_li" onclick="showPrompt()">Log Out</li>
            </nav>
        </section>

        <section class="main_content-wrapper" id="cashier_main_wrapper">
           <p id="notice" class='notice'></p>
        <section id="mypackage">

        <ul class="member_request-ul" id="member_request-ul">
               <script>fetchMessages();</script>   
        </ul>

        </section>
        </section>

    </article>

  <script>
       const toggleSideMenus = () => {
        if($("#side_nav-wrapper").hasClass("sidemenu_on"))
        {
            $("#side_nav-wrapper").removeClass("sidemenu_on")
            $("#side_nav-wrapper").hide();
            $("#cashier_main_wrapper").slideDown(300);
        } else {
            $("#side_nav-wrapper").addClass("sidemenu_on")
            $("#side_nav-wrapper").slideDown(300);
            $("#cashier_main_wrapper").hide();
        }
    }

    const showMsgNav = arg => {
        console.log("rrrrrrrrrrs");
        if($("#sidenav")) {
            $("#msgul").hide() 
            $("#sidenav").slideDown(800)
        } 
        
        if($("#sidenav_two")) {
            $("#msgul_two").hide()
            $("#sidenav_two").slideDown(800)
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