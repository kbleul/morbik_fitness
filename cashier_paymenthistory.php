
    <?php
    include('database_connect.php');
    
    session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }


   function fetchAllMembers() {
    include('database_connect.php');

    $query = "SELECT * FROM member";
    $output = "";

      if($result= $con->query($query)) {
          while($row = $result->fetch_assoc()) {
              $id = $row['ID'];
              $name = $row['FName']. " ".$row["LName"];

            $output = $output . "<li onclick='fetchReceipt($id)'>".$name."</li>";
          }

          if($output != "") {   return $output;   }
          else { return "No members found"; }
      } else { return "<sript>console.log('".mysqli_error($con)."')</script>";  }
   }

   function fetchRecentReceipt() {
       include("database_connect.php");
       $month = date('m');
       $output = "";

       $query = "SELECT * FROM payment_main WHERE month(Date) = 4";

        if($result = $con -> query($query)) {
            if(mysqli_num_rows($result) == 0) { return "<P class='no_payment_p'>No recent payments made yet.</P>"; }
            
            while($row = $result->fetch_assoc()) {
                $name = $row['FName']. " ".$row["LName"];
                $by = $row['ProcessedBy'];
                $fee = $row['Fee'];
                $date = $row['Date'];

                $output = $output ."<ul class='view_ul_ul'><li>$name</li><li>$by</li><li>$fee</li><li>$date</li></ul>";
            }
            return $output;

        } else { return "<script>console.log('".mysqli_error($con)."');</script>"; }

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
    <link rel="stylesheet" href="trainer.css">

    <link rel="stylesheet" href="programs.css">
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="cashier.css">

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
  const fetchAllMembers = () => {
      const result = <?php $fetchresult = fetchAllMembers(); echo json_encode($fetchresult); ?>;
      $("#members_list_ul").html(`<li onclick='showRecent()'>This Month</li>${result}`);
      console.log(result);
  }


  const showRecent = () => {
      const result = <?php $fetchresult = fetchRecentReceipt(); echo json_encode($fetchresult); ?>;
      $("#view_ul").html(result);
      console.log(result);
  }

  const fetchMemberSuggestions =e => {
                console.log("asd")


    const inputstr = e.target.value;

    if(inputstr === "" || inputstr === " ") {
          fetchAllMembers();
          return 0;
        }
console.log("asd")
       const xmlhttp = new XMLHttpRequest();

          xmlhttp.onload = function() {
              const result = this.responseText;

               $("#members_list_ul").html(result);
      console.log(result);

          }
      
          xmlhttp.open("GET", "fetchrecipt.php?search="+ inputstr)
          xmlhttp.send();

  
  }

  const fetchReceipt = id => { console.log("55s")
      const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function() {
            const result = this.responseText;
            $("#view_ul").html(result);
      console.log(result);

        }

        xmlhttp.open("GET", "fetchrecipt.php?s=" + id)
        xmlhttp.send();

  }
      

</script>
    <article class="header_wrapper">
        <header class="flex">
            <a href="cashier_addrecipt.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
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
           <div class="search_box">
                <input id="search_member_input" type="search" placeholder="Search . . ." />
                <button id="search_btn">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m16.325 14.899l5.38 5.38a1.008 1.008 0 0 1-1.427 1.426l-5.38-5.38a8 8 0 1 1 1.426-1.426ZM10 16a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z"/></svg>
                </button>
            </div>

            <script>
             document.getElementById("search_member_input").addEventListener("input", fetchMemberSuggestions)
            </script>

           <div id="box_contener" class="box_contener">
            
           <ul id="members_list_ul" class="members_list_ul">
             <script> fetchAllMembers(); </script>
            </ul>

            <ul class="view_ul" id="view_ul">
            <script> showRecent(); </script>
            </ul>
           </div>
            
     
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
         const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
    }
    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>