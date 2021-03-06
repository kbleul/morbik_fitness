
    <?php session_start(); 

       //if username and email are not set for this session then user has not logged in to the system
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
    <link rel="stylesheet" href="programs.css">
    <link rel="stylesheet" href="messages.css">
    <link rel="stylesheet" href="members.css">



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

            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><div id="google_translate_element"></div></li>
                </ul>
            </nav>
           


        
        </header>
    </article>

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
              <li> <a href="member_dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                <li> <a class="has-arrow" href="memberprogram.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Programs</span></a></li>
                <li><a href="member_payment.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
            <li class="has-arrow"><a href="member_messages.php"><i class="fa fa-heart"></i><span class="hide-menu">Messages</span></a>
            <li class="has-arrow"><a href="diet.php"><i class="fa fa-heart"></i><span class="hide-menu">Diet Plan</span></a>
            <li id="logout_li" onclick="showPrompt()">Log Out</li>
        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
           
            <main id="mypackages">
            </main>
        </section>
    </article>

  <script>

  const fetchGroupMsgs = type => {
                const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                         $("#mypackages").html(`<div id="sidenav" class="topnav">
                <button onclick="fetchGroupMsgs('Manager')">Group Messages</button>
                <ul id="sidenav_submenu">
                 <li onclick="fetchGroupMsgs('Manager')">Manager</li>
                 <li onclick="fetchGroupMsgs('Trainer')">My Trainer</li>
                </ul>
                <button onclick="fetchPrivateMsgs()">Private Messages</button>
            </div>` + firsttime_response);
                    }
            
                   if(type === 'Manager') { xmlhttp.open("GET", "fetch_messages.php?r=group");  }
                   else { xmlhttp.open("GET", "fetch_messages.php?r=trainer"); }
                                    xmlhttp.send();
  }

  fetchGroupMsgs('Manager');

  const fetchPrivateMsgs = () => {
    const xmlhttp = new XMLHttpRequest();

      xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                         console.log(firsttime_response);
                         $("#mypackages").html(`<div id="sidenav" class="topnav">
                <button onclick="fetchGroupMsgs('Manager')">Group Messages</button>
                <button onclick="fetchGroupMsgs('Trainer')">Private Messages</button>
            </div>` + firsttime_response);
                    }
            
                                    xmlhttp.open("GET", "fetch_messages.php?r=" + "private");
                                    xmlhttp.send();
  }


        const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
          }

  </script>

</body>
</html>