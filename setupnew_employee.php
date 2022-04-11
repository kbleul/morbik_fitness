
    <?php
   
   $id = $_POST['myid']; 

   include('database_connect.php');

    
   if(isset($_POST['submit']))
   {
   $password = $_POST['password'];
   $username = $_POST['uname'];
   $id = $_POST['id'];

        $query = "UPDATE important_employees SET Username = '$username' , Password = '$password' WHERE id = '$id'; ";

        if(mysqli_query($con,$query)) {
    echo "<script>alert('Username and Password updated successfully !')</script>";   
    echo "<script>setTimeout(\"location.href = 'employee_login.php';\",1000);</script>";  
    echo "<script>alert('$username , $password , $id')</script>";   

        } else { echo mysqli_error($con);}
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
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="index.html">Home</a></li>
                    <li><a  class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
                </ul>
            </nav>
           
     


        
        </header>
    </article>

  
     <div class="hero_img_container"><img src="imgs/workout2.jpg" alt="gym"></div>

        <h1 id="school_name">Morbik Fitness</h1>

 

     <section class="form_container">
       

         <form id="login_form" method="post" class="setup_new-form">

        
            <input type="text" name="uname" id="uname" placeholder="Enter a new username" 
            autocomplete="false" autofocus required><br>
            <input type="password" name="password" id="password" placeholder="Enter a new Password" minlength="8"
                    autocomplete="false" required>
                    <label for="password" id="set_up-notice">* Passwords don't match.'</label>
            <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" minlength="8"
            autocomplete="false" required>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="flex">
                    
                                <button type="submit" name="submit" id="submit" >log in</button>
                                <p id="show_privilege">Employee</p>
                                <button id="change_form">First time login</button>

                </div>

         </form>
 
     </section>

    </main>

    <footer>
        <p>All rights reserved</p>
        <p>Instagram <span class="media">Facebook</span><span class="media">Twitter</span></p>
    </footer>
   
</body>

    <script>
        document.getElementById("confirm").addEventListener("blur", () => { 
            if($("#password").val() !== $("#confirm").val())
            {   $("#confirm").val("").focus(); $("#set_up-notice").show(); }
        })
    </script>
</html>

