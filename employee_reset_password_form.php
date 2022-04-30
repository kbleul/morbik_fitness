
<link rel="stylesheet" href="popup_style.css">

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
   $_SESSION["name"] = $row['FName'].$row['LName'];
   $_SESSION["Job"] = $row['Job_title'];

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
   
    else if($_SESSION["Job"] == "reception")
   { echo "<script>setTimeout(\"location.href = 'reception.php';\",1000);</script>"; }

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
<link rel="stylesheet" href="recovery.css">


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



 <section class="form_container resetform_container">
   <h3>Reset Password</h3>

     <div id="recovery_subcontainer" >

    
        <input type="email" name="email" id="email" placeholder="Enter your email address" 
         autocomplete="false" autofocus required><br>
         <p id="email_notfound"></p>
         <img id="loading" src="imgs/loading.gif" alt="loading" />
         <button type="btn"  id="submit" onclick="findEmployeeMail()" >submit</button>


     </div>


 </section>

 <form action="setupnew_employee.php" method="POST" id="hiddenform">
    <input type="hidden" name="myid" id="myid" value="">
</form>
 


</main>

<footer>
    <p>All rights reserved</p>
    <p>Instagram <span class="media">Facebook</span><span class="media">Twitter</span></p>
</footer>

</body>

<script>

const verifyCode = (email) => {

    const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                        console.log(firsttime_response);
                        $("#loading_two").hide();

                         if(firsttime_response.includes( "Match"))
                         { 
                    const eid = firsttime_response.split("-")[1] 
    let newhtml = "<form method='POST' action='passwordreset.php' ><input type='password' name='new_password' id='new_password' required='required' placeholder='Enter new password' >";
     newhtml += `<p id="passnotmatch">*Passwords don't match.</p>`; 
     newhtml +=  "<input type='password' name='conform_new_password' id='conform_new_password' placeholder='Confirm Password' required='required' >";
     newhtml +=  `<input type='hidden' name='eid' id='eid' value=${eid} >`;
     newhtml += "<input type='submit' name='submit_newpassword' id='submit_newpassword' value='Submit' ></form>";

                                $("#recovery_subcontainer").html(newhtml);
                                $("#passnotmatch").hide();

            document.getElementById("conform_new_password").addEventListener("blur", () => { 
                if($("#conform_new_password").val() !== $("#new_password").val())
                             {  
                                 $("#conform_new_password").val(''); 
                                 $("#passnotmatch").show();
                            }
            })
                         }
                         else if(firsttime_response === "Not matched")
                         { 
                            $("#recoverycode").val("");
                            $("#recoverycode").show();
                            $("#tryagain").html("Incorrect Code. Try again");
                         }
                        
                    }
            
                                    xmlhttp.open("GET", "mailto.php?s=" + email + " " + $("#recoverycode").val());

   if  ( $("#recoverycode").val().length == 6) 
   { 
    $("#loading_two").show(); 
    $("#recoverycode").hide();
       xmlhttp.send(); 
   
  }
}

 const findEmployeeMail = () => {

    const xmlhttp = new XMLHttpRequest();
                    const mem_mail = $("#email").val()
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  

                          $("#loading").hide();

                         if(firsttime_response.includes("Message Sent"))
                         {
                        $("#myid").val(firsttime_response.split("-")[1])
 let tempstr = "<p>A recovery code was sent to your email address.</p>";
  tempstr += `<input type='text' id='recoverycode' name='recoverycode' required='required'  >`;
  tempstr += "<p id='tryagain'></p> "
  tempstr += "<img id='loading_two' src='imgs/loading.gif' alt='loading' />";    
                            $("#recovery_subcontainer").html(tempstr) 
            document.getElementById("recoverycode").addEventListener("keydown", () => verifyCode(mem_mail))
                        }
                         else if(firsttime_response.includes("Email address not found.") || firsttime_response === ''){
                             $('#email_notfound').html("<p>Email address not found. Please try again</p>")
                             $("#loading").hide();
                         }
                         else {  
                            $('#email_notfound').html("Unexpected error. Message could not be sent.\nPlease try again.")
                            $("#loading").hide();
                         }

                    }
            
                                    xmlhttp.open("GET", "findemployeemail.php?r=" + $("#email").val());

                            if($("#email").val().includes("@") && $("#email").val().includes(".com"))
                                  {  
                                      xmlhttp.send();  
                                      $('#email_notfound').html("");
                                      $("#loading").show();                          
                                  }
                            else { $('#email_notfound').html("<p>Please enter a valid email address</p>");  }
 }


</script>
</html>

