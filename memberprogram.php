
   <?php session_start();  
   
   //if username and email are not set for this session then user has not logged in to the system
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
    <link rel="stylesheet" href="programs.css">
    <script src="jquery-3.6.0.js"></script>


<!-- google translate script 1-->
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
            $(".header_wrapper").css({"top" : "2rem"})
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
		</script>
    <script src="index.js"></script>

    <script>
      const addProgram =( key, index) => {
            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
console.log(firsttime_response)
                        if(firsttime_response === "added") 
                           {  
                               $("#"+index).find(".addbtn").hide()
                               $("#"+index).find(".notice").show();  
                           }
                        else { 
                            $("#"+index).find(".addbtn").hide()
                            $("#"+index).find(".notice").html("Aleady Added").show();  
                        }
                        setTimeout(function() {  $("#"+index).find(".notice").fadeOut() }, 2500)

                    }
            
                                    xmlhttp.open("GET", "addMember_program.php?r=" + key);
                                    xmlhttp.send();
          }
    </script>
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
            <main>

            <section id="packages">


            </section>
  <script type="module">
   import workoutpackage  from "./workout.js";

   let workouthtml = '';
   let counter = 0;


   for(let key in workoutpackage) {
        if(key !== "size") {
       let forwho_capitalized = workoutpackage[key]["forwho"].charAt(0).toUpperCase() + workoutpackage[key]["forwho"].slice(1);
       let gender = <?php echo  json_encode($_SESSION['gender']) ?>;

     if(workoutpackage[key]["forwho"] === "both" || workoutpackage[key]["forwho"] === gender || forwho_capitalized === gender){
      let name = `<h2>${workoutpackage[key]["Name"]}</h2>`;
      let disc = `<p class="discription">${workoutpackage[key]["Discription"]}</p>`;
      let img = `<img class="workout_img on" src="${workoutpackage[key]["img"]}" alt="${workoutpackage[key]["Name"]}" />`;
      let addbtn = `<button onclick="addProgram(${key}, ${counter})" class="addbtn">
      <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="currentColor" d="M17 15V8h-2v7H8v2h7v7h2v-7h7v-2z"/></svg>
      </button>`
      let exercises = `<div  class="exercise_div">`;


       workoutpackage[key]["Exrecises"].forEach(item => {
           exercises += `<ul class='exer_ul'> <li>${item[0]}</li> <li>${item[1]}/sets </li><li>Reps  - ${item[2]} </li></ul>`;
       })

        exercises += `${addbtn}</div>`;


        workouthtml += `<section id="${counter}" class="exersice_section"><div class='front_div'>${name}${disc}${img}</div>${exercises}
        <p class="notice">Added</p></section>`;

        counter++;
        
    }

   }
}
        document.getElementById("packages").innerHTML =workouthtml;

          let sec = document.getElementsByClassName("exersice_section");

          for(let i = 0; i < sec.length; i++) { 
            document.getElementById(i).addEventListener('click', e => { 
                // console.log($(e.target).html())
                // console.log(e.target)

                if($(document.getElementById(i)).hasClass('on')) {
                    $("#"+i).find(".front_div").fadeIn();
                    $("#"+i).find(".exercise_div").hide("slow");
                    $(document.getElementById(i)).removeClass('on');
                } else {
                    $("#"+i).find(".front_div").hide("slow");
                    $("#"+i).find(".exercise_div").fadeIn();
                    $(document.getElementById(i)).addClass('on');
                }


                })
          }

        

</script>
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