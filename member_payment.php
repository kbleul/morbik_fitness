
    <?php session_start(); 
       //if username and email are not set for this session then user has not logged in to the system
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

// PHP program to sort array of dates 
  
// user-defined comparison function 
// based on timestamp
function compareByTimeStamp($time1, $time2)
{
    if (strtotime($time1) < strtotime($time2))
        return 1;
    else if (strtotime($time1) > strtotime($time2)) 
        return -1;
    else
        return 0;
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
    <link rel="stylesheet" href="programs.css">

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
                    <li><a  class="nav_link" href="">Home</a></li>
                    <li><a  class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
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
                        <li> <a href="member_dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                        
                    
                         <li> <a class="has-arrow" href="memberprogram.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Programs</span></a></li>
                         <li><a href="member_payment.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
                        <li class="has-arrow"><a href="member_messages.php"><i class="fa fa-heart"></i><span class="hide-menu">Messages</span></a>
                        <li class="has-arrow"><a href="diet.php"><i class="fa fa-heart"></i><span class="hide-menu">Diet Plan</span></a>
        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main id="myworkout_main">

            <article id="topnav">
                <button id="myworkout_btn" class="active" onClick="getMyWorkout()">MyWorkout</button>
                <button id="mymeal_btn" onClick="getMyMealplan()">MyMealPlan</button>

            </article>
                <article id="mypackage" >
        <?php
            include('database_connect.php');

            session_start();

            $mid = $_SESSION['id'];

            $query= "SELECT * FROM payment_history WHERE Mid = '$mid'";
            $output = "";

            if($result = $con->query($query)) {
                $rowcount=mysqli_num_rows($result);

                if($rowcount > 0)
                { 
            $output = "<div class='payment_history-wrapper'><ul class='payment_ul payment_ul_header'><li>Recipt Id</li><li>Processed By</li><li>Fee</li><li>Date</li></ul>";  
                while($row =  $result->fetch_assoc()) {
                    $rid = $row['Rid'];
                    $processedby = $row['ProcessedBy'];
                    $fee = $row['Fee'];
                    $date = $row['Date'];

                    $output = $output . "<ul class='payment_ul'><li>$rid</li><li>$processedby</li><li>$fee</li><li>$date</li></ul>";
                }
                $output = $output . "</div><p>You can pay your next fee starting from ";


                    //get Date string
                $datetwo = explode(" ",$date);
               
                $nextdate = new DateTime($datetwo[0]);
                        $interval = new DateInterval('P1M');
                        $nextdate->add($interval);
                        $nextdate = $nextdate->format('Y-m-d') . "\n";

                $untildate = date_create($nextdate);
                        date_add($untildate, date_interval_create_from_date_string('10 days'));
                        $untildate = date_format($untildate, 'Y-m-d');

               $output = $output . "$nextdate to $untildate </p></div>";


                            // Input Array (currentdate, nextdate, untildate)
                            $currentdate = date('Y-m-d');
                $arr = array( $currentdate, $nextdate, $untildate);
                
                // sort array with given user-defined function
                usort($arr, "compareByTimeStamp");


                if($arr[0] == $currentdate || $currentdate == $arr[2] || $arr[1] == $currentdate)  
                { $output = $output . "<p>You can pay now</p>"; }
            


            }

            if($output == "") { $output = "<p>No payment history yet. Pay your first payment now .</p>"; }

              echo $output;
              echo $arr[0]. " ".$arr[1]. " ".$arr[2]. " ";
            } else {
                $error = mysqli_error($con);
                echo "<script>console.log('\$error)</script>";
            }
        ?>

                </article>
               

            </main>
        </section>
    </article>

 
    </script>

</body>
</html>