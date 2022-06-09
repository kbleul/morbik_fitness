
    <?php
    include('database_connect.php');
    
    session_start(); 
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
            <a href="cashier_addrecipt.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                <div id="google_translate_element"  class="google_translate_element"></div>

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

        <?php 
        $output =  "";
        $counter = 0;

     $query = "SELECT * FROM main_members_table";
            if($result = $con->query($query)){
                $output = "<div id='members_wrapper'><ul>
                <li>Name</li><li>Gender</li><li>Program</li><li>Plan</li><li>Fee</li><li>Discount</li></ul>";
                while($row = $result->fetch_assoc()) {
                    $id = $row['ID'];
                    $name = $row['FName']. " ".$row['LName'];
                    $gender = $row['Gender'];
                    $program = $row['Program_Name'];
                    $plan = $row['Specific_Plan'];
                    $fee = $row['Price'];
                    $discount = $row['Discount'];


           $output = $output . "<ul class='gym_mem_ul' id='ul$counter' onclick='showMemberRecipt_form($counter)'>
           <div class='hidden'><li class='mid'>$id</li></div>
           <li class='name'>$name</li><li>$gender</li><li>$program</li><li>$plan</li><li class='fee'>$fee</li>
           <li class='discount'>$discount</li></ul>";
           
             $counter++;
                }

                $output = $output . "</div>";
                echo $output;
            } else { echo "<script>console.log('". mysqli_error($con). "')</script>"; }
        ?>

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
          
      const showMemberRecipt_form = counter => {
          console.log(counter);
          let root = document.querySelector("#ul"+counter)
          console.log(root);
          console.log( root.querySelectorAll(".mid"));


          const id = $(root).find(".mid").text()
          const name = $(root).find(".name").text()
          const fee = $(root).find(".fee").text()
          let discount = $(root).find(".discount").text()
          let total;

          if(discount === "1") discount = "Student - 10%"
          else if(discount === "2") discount = "Annual - 15%"
          else discount = "Normal"


          let html = `
          <label for='forid'>Memeber ID</label>
          <input name='forname' type ='text' value='${id}' />
          <label for='forname'>Memeber Name</label>
          <input name='forid' type ='text' value='${name}' />
          <label for='fee'>Monthly Fee</label>
          <input name='fee' type ='number' value='${fee}' /> 
          <label for='discount'>Discount</label>
          <input name='discount' type ='text' value='${discount}' /> `;



          if(discount === "Annual - 15%") {
            total =( parseInt(fee) * 12) * 0.15;
            total = (fee * 12) - total;

            html += `<label for='total'>Total Fee</label>
          <input name='total' type ='text' value='${total}' /> `;
          } else if(discount === "Student - 10%") {
            total =( parseInt(fee)) * 0.1;
            total = fee - total;

            html += `<label for='total'>Total Fee</label>
          <input name='total' type ='text' value='${total}' /> `;
          } else {
            html += `<label for='total'>Total Fee</label>
          <input name='total' type ='text' value='${fee}' /> `;
          }
 
          html += ` <button id="submit" onclick="postRecipt(${id})" name='submit'>Post Reciept</button>
          `;
         $("#mypackage").html("<div class='formcontainer'>" + html + "</div>");

      }

      const postRecipt = id => {
          const xmlhttp = new XMLHttpRequest();

            xmlhttp.onload = function() {
                const result = this.responseText;
                $("#notice").text(result);
                setTimeout( () => { $("#notice").hide() } , 3000)
                console.log(result);
            }

          xmlhttp.open('GET',"postrecipt.php?a=" + id)
          xmlhttp.send();
      }
    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>