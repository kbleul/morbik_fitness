<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="home.css">
<link href="https://fonts.googleapis.com/css2?family=Qahiri&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

<script src="index.js"></script>
 <!-- google translate script 1-->
 <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
		</script>

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
       //echo $_SESSION["email"];exit;
       $_SESSION["name"] = $row['FName'].$row['LName'];

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
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="index.html">Home</a></li>
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

  
     <div class="hero_img_container"><img src="imgs/workout2.jpg" alt="gym"></div>

        <h1 id="school_name">Morbik Fitness</h1>

 

     <section class="form_container">
       

         <form id="login_form" method="post" >

        
            <input type="text" name="uname" id="uname" placeholder="Username" 
            minlength= "6" autocomplete="false" autofocus required><br>
            <input type="password" name="password" id="password" placeholder="Password" minlength="8"
                    autocomplete="false" required>
             <div class="info">
               <p id="incorrect" >Incorrect Username/Password</p>
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
   
</body>

</html>

