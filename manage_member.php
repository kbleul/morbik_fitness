
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
            <a href="manager_dashboard.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
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
        <section class="side_nav-wrapper" id="side_nav-wrapper">
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
                </nav>
        </section>
        <section id="main_content-wrapper" class="main_content-wrapper">
            <main>
                <table>
                 <thead>
                    <tr>
                        <th colspan="4">Members</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
    <th>Name</th>
    <th>Gender</th>
    <th>Program</th>
    <th>Plan</th>

  </tr>
                 <?php

 include('database_connect.php');

    $query = "SELECT * FROM main_members_table";

    if($result= $con->query($query)){
        while($row= $result -> fetch_assoc() ){
            $fullname = $row['FName']." ".$row['LName'];
            $gender = $row['Gender'];
            $program = $row['Program_Name'];
            $plan = $row['Specific_Plan'];

        echo "<tr class='mem_tr'>
                <td>$fullname</td>
                <td>$gender</td>
                <td>$program</td>
                <td>$plan</td>               
              </tr>";

        }
    } else { echo mysqli_error($con);}
                 ?>
                 </tbody>
                </table>
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
    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>

</body>
</html>