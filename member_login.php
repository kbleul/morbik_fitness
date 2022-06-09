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
    <link rel="stylesheet" href="popup_style.css">


    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>
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
 
   $sql = "SELECT * FROM member WHERE Username='$uname' and Password ='$passw' ";
      $result = mysqli_query($con,$sql);
      $row  = mysqli_fetch_array($result);
      //print_r($row);
       $_SESSION["id"] = $row['ID'];
       $_SESSION["username"] = $row['Username'];
       $_SESSION["password"] = $row['Password'];
       $_SESSION["email"] = $row['Email'];
       $_SESSION["gender"] = $row['Gender'];
       //echo $_SESSION["email"];exit;
       $_SESSION["name"] = $row['FName']." ".$row['LName'];

       $count=mysqli_num_rows($result);
  
       if(($count)==1 && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
      
          ?>
           <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
      </h1>
      <p>Login Successfully</p>
      <p>
       <?php echo "<script>setTimeout(\"location.href = 'member_dashboard.php';\",1000);</script>"; ?>
      </p>
    </div>
  </div>
     
       <?php
      
  }
  else {  echo '<script>location.href = "member_incorrectpass.php" </script>'; }
 }
  ?>
        
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
            <input type="password" name="password" id="password" placeholder="Password" 
                    autocomplete="false" required>
             <div class="info">
               <p id="forget_password"><a href="director_reset_password_form.html">forget password ?</a></p>
            </div>

                <div class="flex">
                    
                                <button type="submit" name="btn_login" id="submit" >log in</button>
                                <p id="show_privilege">Member</p>
                                <button id="change_privilege"><a href="previlage.html" >change privlage</a></button>
                </div>

             
 
         </form>
         <script>
  const toggleIncorrect = () => { document.querySelector("#incorrect").style.display = "block"; console.log("hii") }

         </script>
     </section>


    
    </main>

    <footer>
        <p>All rights reserved</p>
        <p>Instagram <span class="media">Facebook</span><span class="media">Twitter</span></p>
    </footer>
    <script>
    const toggleMenus = () => {
        if($("#header").hasClass("submenu_hidded")) {
    $("#burgermenu_top").hide();
    $("#logo_link").hide();
    $("#header_nav").show().css("width", "100%");
    $("#sign_in").show();
    $("#header").css("flex-direction","column")
    $("#sign_in").css({
        "width": "100%",
        "text-align": "center"
    })
    $("#nav_list").css({
        "height":"4rem",
        "justify-content": "space-evenly"
    })
    $("#nav_list").find("li").css("margin-right","0")

    $("#drop_down-main").show();
    $("#header").removeClass("submenu_hidded")
    $("#google_translate_element").hide()

    }

 else {
    $("#sign_in").hide();
    $("#burgermenu_top").show();
   $("#logo_link").show();
   $("#header").css("flex-direction","row")
   
   $("#drop_down-main").hide();
    $("#header").addClass("submenu_hidded")
    $("#google_translate_element").show()

   
}
   
}
</script>

</body>

</html>

