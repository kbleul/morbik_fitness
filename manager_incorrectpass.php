<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="home.css">
<script src="index.js"></script>

    <?php
    session_start();
 error_reporting(1);
 include('head.php');
   include('./constant/connect.php');

   
  if(isset($_POST['btn_login']))
  {
  $unm = $_POST['email'];
  //echo $_POST['passwd'];
  //$p="admin";
  //echo $unm;exit;
  $passw =  $_POST['password'];
  //$passw = hash('sha256',$p);
  //echo $passw;exit;

 
   $sql = "SELECT * FROM admin WHERE email='" .$unm . "' and password = '". $passw."'";
      $result = mysqli_query($con,$sql);
      $row  = mysqli_fetch_array($result);
      //print_r($row);
       $_SESSION["id"] = $row['id'];
       $_SESSION["username"] = $row['username'];
       $_SESSION["password"] = $row['password'];
       $_SESSION["email"] = $row['email'];
       //echo $_SESSION["email"];exit;
       $_SESSION["fname"] = $row['fname'];
       $_SESSION["lname"] = $row['lname'];
       $_SESSION["image"] = $row['image'];
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
       <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
       <?php echo "<script>setTimeout(\"location.href = './admin/dashboard.php';\",1500);</script>"; ?>
      </p>
    </div>
  </div>
     <!--   <script>
       window.location="index.php";
       </script> -->
       <?php
      
  }
  else {
    echo '<script>location.href = "manager_incorrectpass.php" </script>';
  ?>
        
          <?php
           }
  
   }

    ?>
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

  
     <div class="hero_img_container"><img src="pics/pexels-pixabay-256541.jpg" alt="library"></div>

        <h1 id="school_name">Morbik Fitness</h1>

 

     <section class="form_container">
       

         <form id="login_form" method="post" >

        
            <input type="text" name="email" id="uname" placeholder="Username" 
            minlength= "6" autocomplete="false" autofocus required><br>
            <input type="password" name="password" id="password" placeholder="Password" minlength="8"
                    autocomplete="false" required>
             <div class="info">
               <p id="incorrect" >Incorrect Username/Password</p>
               <p id="forget_password"><a href="director_reset_password_form.html">forget password ?</a></p>
            </div>

                <div class="flex">
                    
                                <button type="submit" name="btn_login" id="submit" >log in</button>
                                <p id="show_privilege">Manager</p>
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

