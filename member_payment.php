
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

  

function fetchPaymentForm() {
    include('database_connect.php');

    $memid = $_SESSION["id"];
    $formhtml = "";

    $query = "SELECT * FROM main_members_table WHERE ID = $memid";

    if($result= $con->query($query)) { 
        while($row = $result->fetch_assoc()) {
            $name = $row['FName']. " ".$row['LName'];
            $gender = $row['Gender'];
            $program = $row['Program_Name'];
            $plan = $row['Specific_Plan'];
            $fee = $row['Price'];
            $discount = $row['Discount'];
            $discount_val = 0;
            $total = 0;
            $merchantOrderId = $memid. " - " . $name;

            if($discount == "1")
            {
                 $discount = "Student - 10%";
                 $discount_val = 0.1;
                $total = $fee  -  ($fee* $discount_val);

            }
            else if($discount == "2") {
                $discount = "Annual - 15%";
                $discount_val = 0.15;
                $total = ($fee * 12) - ( ($fee * 12) * $discount_val);
            }
            else{ 
                $discount = "Normal";
                $total = $fee;
            }
  
    $formhtml = "<div id='mypayment_form' class='formcontainer'>
    <form method='POST' action='https://test.yenepay.com/'>
    <label for='forid'>My ID</label>
    <input name='forname' type ='text' value='${memid}' />
    <label for='forname'> Name</label>
    <input name='forid' type ='text' value='${name}' />
    <label for='program'>Program</label>
    <input name='program' type ='text' value='${program}' />
    <label for='plan'>Plan</label>
    <input name='plan' type ='text' value='${plan}' />
    <label for='fee'>Monthly Fee</label>
    <input name='fee' type ='number' value='${fee}' /> 
    <label for='discount'>Discount</label>
    <input name='discount' type ='text' value='${discount}' /> ;
    <input name='discount_type' type='hidden' value='${discount_val}' />
    <label for='total'>Total Fee</label>
          <input name='total' type ='text' value='${total}' /> 

          
    <input type='hidden' name='process' value='Express'>
    <input type='hidden' name='successUrl' value='http://localhost/morbik_gym/success.php'>
    <input type='hidden' name='ipnUrl' value='http://localhost/morbik_gym/ipn.php'>
    <input type='hidden' name='cancelUrl' value='http://localhost/morbik_gym/cancel.php'>
    <input type='hidden' name='merchantId' value='13893'>
    <input type='hidden' name='merchantOrderId' value='$merchantOrderId'>
    <input type='hidden' name='expiresAfter' value='24'>
    <input type='hidden' name='itemId' value='$memid'>
    <input type='hidden' name='itemName' value='Fee'>
    <input type='hidden' name='unitPrice' value='$total'>
    <input type='hidden' name='quantity' value='1'>
    <input type='hidden' name='discount' value='$discount_val'>
    <input type='hidden' name='handlingFee' value='0'>
    <input type='hidden' name='deliveryFee' value='0'>
    <input type='hidden' name='tax1' value='0'>
    <input type='hidden' name='tax2' value='0'>
    <button id='submit' onclick='payMyFee()' name='submit'>
    <p>Pay with<p>
    <img src='imgs/yenepay_icon.png' alt='yene pay'/></button>
    </form></div>";



    return $formhtml;
     
        }  
        
    } else {
        $error = mysqli_error($con);
        return $error;
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

    <article class="header_wrapper">
        <header class="flex">

            <a href="member_dashboard.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
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
            <li> <a href="member_dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                         <li> <a class="has-arrow" href="memberprogram.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Programs</span></a></li>
                         <li><a href="member_payment.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
                        <li class="has-arrow"><a href="member_messages.php"><i class="fa fa-heart"></i><span class="hide-menu">Messages</span></a>
                        <li class="has-arrow"><a href="diet.php"><i class="fa fa-heart"></i><span class="hide-menu">Diet Plan</span></a>
                        <li id="logout_li" onclick="showPrompt()">Log Out</li>
            </nav>
        </section>
        <section id="main_content-wrapper" class="main_content-wrapper">
            <main id="myworkout_main">

                <article id="mypackage"  >
                     

    <script>
        const printTrial = () => {
            let output =  <?php $tempout = fetchPaymentForm(); echo json_encode( $tempout ); ?> ;
        $("#mypackage").html(output );

        }
 
    </script>

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
                $output = $output . "</div><p class='non_p'>You can pay your next fee starting from ";


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


                if($arr[0] == $arr[1] || $arr[1] == $arr[2] || $arr[1] == $currentdate)  
                { $output = $output . "<p class='non_p'>You can pay now</p><button id='here_btn' onclick='printTrial()'>Here </button>"; }
            


            }

            if($output == "") 
            { $output = "<p class='non_p'>No payment history yet. Pay your first payment now .</p>"; 
            $output = $output . "<button id='here_btn' onclick='printTrial()'>Here </button>";
            }

              echo $output;
            } else {
                $error = mysqli_error($con);
                echo "<script>console.log($error)</script>";
            }
        ?>

                </article>
               

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

</body>
</html>