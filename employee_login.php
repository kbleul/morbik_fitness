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

    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="popup_style.css">

 <!-- google translate script 1-->
 <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
 <!-- Call back function 2 -->
 <script type="text/javascript">
 function googleTranslateElementInit() {
   new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
 }
 </script>
    <title>Morbik Fitness</title>
</head>
<body>

    <?php
    session_start();
 error_reporting(1);
   include('database_connect.php');

   
  if(isset($_POST['btn_login']))
  {
  $uname = $_POST['uname'];
  $passw =  $_POST['password'];
 
   $sql = "SELECT * FROM important_employee_main WHERE Username='$uname' and Password ='$passw' ";
      $result = mysqli_query($con,$sql);
      $row  = mysqli_fetch_array($result);
      //print_r($row);
       $_SESSION["id"] = $row['ID'];
       $_SESSION["username"] = $row['Username'];
       $_SESSION["email"] = $row['Email'];
       //echo $_SESSION["email"];exit;
       $_SESSION["name"] = $row['FName']." ".$row['LName'];
       $_SESSION["Job"] = $row['Job_title'];
       $_SESSION["password"] = $row['Password'];

       $count=mysqli_num_rows($result);
  
       if(($count)==1 && isset($_SESSION["email"]) && isset($_SESSION["username"]) ) {
        
          ?>
           <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
      </h1>
      <p>Login Successfully</p>
      <p>
       <?php
       if($_SESSION["Job"] == "trainer" || $_SESSION["Job"] == "Trainer")
       { echo "<script>setTimeout(\"location.href = 'trainer.php';\",1000);</script>"; }

        else if($_SESSION["Job"] == "Cashier" || $_SESSION["Job"] == "cashier" )
       { echo "<script>setTimeout(\"location.href = 'cashier_addrecipt.php';\",1000);</script>"; }

       ?>
      </p>
    </div>
  </div>
     
       <?php
      
  }
  else {  echo '<script>location.href = "employee_incorrectpass.php" </script>'; }
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
    <link rel="stylesheet" href="employee.css">

    <script src="index.js"></script>

    <script src="jquery-3.6.0.js"></script>

    <title>Morbik Fitness</title>
</head>
        
<article class="header_wrapper">

<header class="flex submenu_hidded" id="header">

    <a href="index.html" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
    <nav id="header_nav" class="header_nav">
        <ul id="nav_list" class="nav_list flex">
            <li><a  class="nav_link" href="">Home</a></li>
            <li><a  class="nav_link" href="">about</a></li>
            <li><a class="nav_link" href="">contact</a></li>
        <li onclick="toggleMenus()" id="drop_down-main">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="white" fill-rule="evenodd" d="m12 8l7 8H5z"/></svg>
        </li>
        </ul>
    </nav>

   

    <div id="sign_in">
        <a id="sign_in_btn" href="createnewmember.php" >Sign In</a>
        <button id="login_btn">Log In</button>
    </div>

    <div id="burgermenu_top">
        <button id="burgermenu_btn" onclick="toggleMenus()">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.75 12.25h10.5m-10.5-4h10.5m-10.5-4h10.5"/></svg>
        </button>
    </div>
    <script>
    $("#login_btn").click(function(){
        $("#login_btn").click(function(){
$(".setting_menu").toggle();
});
      console.log("clicked")

      window.location.href = "previlage.html";
    });
    </script>

</header>

</article>

<div id="google_translate_element"></div>
  
     <div class="hero_img_container"><img src="imgs/workout2.jpg" alt="gym"></div>

        <h1 id="school_name">Morbik Fitness</h1>

 

     <section class="form_container">
       

         <form id="login_form" method="post" >

        
            <input type="text" name="uname" id="uname" placeholder="Username" 
            minlength= "6" autocomplete="false" autofocus required><br>
            <input type="password" name="password" id="password" placeholder="Password" minlength="8"
                    autocomplete="false" required>
             <div class="info">
               <p id="forget_password"><a href="employee_reset_password_form.php">forget password ?</a></p>
            </div>

                <div class="flex">
                    
                                <button type="submit" name="btn_login" id="submit" >log in</button>
                                <p id="show_privilege">Employee</p>
                                <button id="change_privilege"><a href="previlage.html" >change privlage</a></button>
                                <button id="change_form">First time login</button>

                </div>

         </form>
 
         <section id="firsttime_checker">
    
                <input type="email" name="email_setup" placeholder="Enter your email address" id="email_setup">
                <p id="set_up-notice">Enter your username please</p>
                <p id="set_up-notice--notfound">Username not found.</p>
    
                <button type="btn" name="btn_setup" id="btn_setup" >Find Acount</button>
    
          </section>
     </section>

     <form action="setupnew_employee.php" method="POST" id="hiddenform">
        <input type="hidden" name="myid" id="myid" value="">
</form>
     

    
    </main>

    <footer>
        <p>All rights reserved</p>
        <p>Instagram <span class="media">Facebook</span><span class="media">Twitter</span></p>
    </footer>
    <script src="toggleMenus.js"></script>


</body>

    <script>

        document.getElementById("change_form").addEventListener("click", () => { 
            $("#login_form").hide();
            $("#firsttime_checker").show();
        })

        document.getElementById("btn_setup").addEventListener("click",() => { 
           if ( $("#email_setup").val() === '' ) 
           {   $("#set_up-notice").show(); }

           else {
         const xmlhttp = new XMLHttpRequest();
                    
            xmlhttp.onload = function() {  
                let firsttime_response = this.responseText; 
                console.log(firsttime_response === "")
                    if(firsttime_response === "Not Found" || firsttime_response === "")
                    {
                        $("#set_up-notice--notfound").show();
                        $("#set_up-notice").hide();
                    }
                    else {  
                       // $("#set_up-notice--notfound").hide(); $("#set_up-notice").hide();
                        $("#myid").val(firsttime_response);
                        $("#hiddenform").submit();
                    }
            
            }

                xmlhttp.open("GET", "checkfirsttime.php?q=" + $("#email_setup").val());
                xmlhttp.send();
  }
           
        })
    </script>
</html>

