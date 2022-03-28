<?php 
//session_start();
//include('../constant/check.php');?>
<?php 
include('../constant/check.php');
 include('../constant/connect.php');
   
 
    ?>
    <!-- Main wrapper  -->
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

            <div id="sign_in">
                <button id="sign_in_btn">Sign In</button>
                <button id="login_btn">Log In</button>
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

        <!-- End header header -->
        