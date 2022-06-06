
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

          if($output != "") { 
              $output = $output . "</ul>"; 
                return $output;
            }
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

//    function fetchReceipt() {
//        include("database_connect.php");

//        $query = "SELECT * FROM payment_main WHERE payment_";
//    }
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
                <li><a href="cashier_addrecipt.php">Make Payments</a></li>
                <li><a href="cashier_paymenthistory.php">Payments History</a></li>               
                <li><a href="cashier_messages.php">Messages/Requests</a></li>            
            </nav>
        </section>
        <section class="main_content-wrapper" id="cashier_main_wrapper">
           <p id="notice" class='notice'></p>
        <section id="mypackage">
           <div class="box_contener">
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

  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>