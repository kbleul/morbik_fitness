<?php
    session_start();
    if( isset($_SESSION["email"]) == false || isset($_SESSION["username"] ) == false)
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
    <link rel="stylesheet" href="trainer.css">

    <script src="jquery-3.6.0.js"></script>
    
    <!-- google translate script 1-->
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
            $(".header_wrapper").css("top" , "2rem")

		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
        </script>

    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="">Home</a></li>
                    <li><a  class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
                          <!-- HTML element 3 -->
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

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
            
                <li> <a href="trainer.php" aria-expanded="false">Dashboard</a></li> 

                <li><a href="trainer_workout.php">Programs</a></li>
                <li><a href="trainer_messages.php" aria-expanded="false">Messages/Requests</a></li>
                            
                <li><a href="trainer_payments.php" aria-expanded="false">Payments</a></li>
             
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main id="trainer_packages">
              

            </main>

            <script type="module">
   import workoutpackage  from "./workout.js";
   const wite = () => console.log(workoutpackage[workoutpackage["size"] - 1])

    window.renderWorkouts = () => {
wite()
   let workouthtml = '<div id="packages"> <button onclick="show_addWorkout_form()">Add New Plan</button>';
   let counter = 0;

   for(let key in workoutpackage) { 
        if(workoutpackage[key].hasOwnProperty("forwho")) {
       let forwho_capitalized = workoutpackage[key]["forwho"].charAt(0).toUpperCase() + workoutpackage[key]["forwho"].slice(1);

      let name = ` 
                    <h2>${workoutpackage[key]["Name"]}</h2>`;
      let disc = `<p class="discription">${workoutpackage[key]["Discription"]}</p>`;
      let img = `<img class="workout_img" src="${workoutpackage[key]["img"]}" alt="${workoutpackage[key]["Name"]}" />`;
     
      let exercises = `<div  class="exercise_div">`;


       workoutpackage[key]["Exrecises"].forEach(item => {
           exercises += `<p > ${item[0]}  ${item[1]}/per rep Reps  - ${item[2]} </p>`;
       })

        exercises += `</div>`;


        workouthtml += `<section id="${counter}" class="exersice_section">${name}${disc}${img}${exercises}</section>`;

        counter++;
     }

   }
        document.getElementById("trainer_packages").innerHTML =workouthtml + "</div>";

          let sec = document.getElementsByClassName("exersice_section");

          for(let i = 0; i < sec.length; i++) { 
            document.getElementById(i).addEventListener('mouseover', e => { 
                $(e.target).find(".workout_img").hide();
                $(e.target).find(".exercise_div").fadeIn("slow");
                })
                document.getElementById(i).addEventListener('mouseleave', e => { 
                $(e.target).find(".exercise_div").hide();
                $(e.target).find(".workout_img").fadeIn("slow");
                })
          } 

    } 

    renderWorkouts();

    window.show_addWorkout_form = () => {
            let addworkout_html = `<div id="frontform"><label for="Name">Title/Name</label><input type="text" class="input" id="Name" name="Name" require="required" /> `
             addworkout_html += `<label for="Discription">Discription</label>
                    <textarea id="Discription" name="Discription"  rows="8" cols="33"></textarea>`
             addworkout_html += `<label for="forwho">For(Gender)</label>
                                    <select name="forwho" id="forwho">
                        <option value="both">Both</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select> `
             addworkout_html += `<label for="weeks">Days per week</label><input class="input" type="text" id="weeks" name="weeks" require="required" /> `
             addworkout_html += `<label for="rest">Rest</label><input class="input" type="text" id="rest" name="rest" require="required"/> `
             addworkout_html += `<buttom id="addExercises" onclick="checkEmptyInput()">Add Exercises</button></div>`
           
             addworkout_html += `<ul id="exercise_ul" class="exercise_ul">
                        <li class="exercise_ul-li"><label for="exercise">Exercise</label><input class="exercise_ul-input " type="text"  name="exercise" require="required"/></li>
                        <li class="exercise_ul-li"><label for="amount">Amount</label><input class="exercise_ul-input " type="text"  name="amount" require="required"/></li>
                        <li class="exercise_ul-li"><label for="reps">Reptation</label><input class="exercise_ul-input " type="text"  name="reps" require="required" /></li>
                       <div class="btns_wrapper">
                        <li><button id="addbtn" onClick="addExercises()">+</button></li>
                        <li><button onClick="addNew_MealPlan()" id="submit">Submit</button></li>
                        </div>
                        </ul>`;

                        $("#trainer_packages").html(`<div id="formcontainer" class='formcontainer'>${addworkout_html}</div>`);


    }

    
  window.checkEmptyInput = () => {
    for(let input of document.getElementsByClassName("input")) {  
          if($(input).val() === "" || $(input).val() === " ") { input.focus(); console.log("hii"); return }
      }

      $("#frontform").hide();
      $("#exercise_ul").show()

  }

  window.addExercises = () => {
      $(".btns_wrapper").hide();
      let html = `<ul class="exercise_ul">
                        <li class="exercise_ul-li"><label for="exercise">Exercise</label><input class="exercise_ul-input " type="text"  name="exercise" require="required"/></li>
                        <li class="exercise_ul-li"><label for="amount">Amount</label><input class="exercise_ul-input" type="text"  name="amount" require="required"/></li>
                        <li class="exercise_ul-li"><label for="reps">Reptation</label><input class="exercise_ul-input" type="text"  name="reps" require="required" /></li>
                       <div class="btns_wrapper">
                        <li><button id="addbtn" onclick="addExercises()">+</button></li>
                        <li><button onClick="addNew_MealPlan()" id="submit">Submit</button></li>
                        </div>
                        </ul>`
                        $("#formcontainer").html( $("#formcontainer").html() + html)
  }
  window.addNew_MealPlan = () => { 
 
    let exercisearr =[];
    for(let ul of document.getElementsByClassName("exercise_ul")) {
        let exercisearr_temp = []
        for(let input of $(ul).find(".exercise_ul-input")) {
           exercisearr_temp.push($(input).val())
        }
       exercisearr.push(exercisearr_temp)
    }

  
    console.log(exercisearr)
      let key = workoutpackage["size"];
      let newplan = {key : {
          "Name" : $("#Name").val(),
          "Discription" : $("#Discription").val(),
          "forwho" : $("#forwho").val(),
          "weeks" : $("#forwho").val() + " times a week" ,
          "rest" : $("#rest").val(),
          "img" : "",
          "Exrecises" : exercisearr,
          "by" :{"id" :  <?php echo $_SESSION["id"] ?> }
      }}

      //console.log(newplan[key]["by"])

      workoutpackage[key] = newplan;
      workoutpackage["size"] = ++workoutpackage["size"]
      console.log(workoutpackage["size"])

      wite()

  }

</script>
        </section>
    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>