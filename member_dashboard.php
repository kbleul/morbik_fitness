
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

            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="">Home</a></li>
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

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
                        <li> <a href="member_dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                        
                    
                         <li> <a class="has-arrow" href="memberprogram.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Programs</span></a></li>
                         <li><a href="payments.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
                        <li class="has-arrow"><a href="new_health_status.php"><i class="fa fa-heart"></i><span class="hide-menu">Trainers</span></a>
                        <li class="has-arrow"><a href="member_messages.php"><i class="fa fa-heart"></i><span class="hide-menu">Messages</span></a>
                        <li class="has-arrow"><a href="diet.php"><i class="fa fa-heart"></i><span class="hide-menu">Diet Plan</span></a>
        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main id="myworkout_main">

            <article id="topnav">
                <button id="myworkout_btn" class="active" onClick="getMyWorkout()">MyWorkout</button>
                <button id="mymeal_btn" onClick="getMyMealplan()">MyMealPlan</button>

            </article>
                <article id="packages" ></article>
                <div id="slide_btns">     
                    <button onclick="slideWorkout('prev')">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                </button>
                    <button onclick="slideWorkout('next')">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                    </button>
                </div>

            </main>
        </section>
    </article>

    <script type="module">
      import workoutpackage  from "./workout.js";
      import meals  from "./meal.js";


      window.getMyWorkout = () => {
          $("#slide_btns").show()

      let workouthtml = '';

           const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                        if(firsttime_response !== "error") 
                           {
                                let temparr =  firsttime_response.split(" ")
       


                              for(let i = 0; i < temparr.length - 1; i++) 
                              {  
       let forwho_capitalized = workoutpackage[parseInt(temparr[i])]["forwho"].charAt(0).toUpperCase() + workoutpackage[parseInt(temparr[i])]["forwho"].slice(1);
       let gender = <?php echo  json_encode($_SESSION['gender']) ?>;

     if(workoutpackage[parseInt(temparr[i])]["forwho"] === "both" || workoutpackage[parseInt(temparr[i])]["forwho"] === gender || forwho_capitalized === gender){
      let name = `<h2>${workoutpackage[parseInt(temparr[i])]["Name"]}</h2>`;
      let disc = `<p class="discription">${workoutpackage[parseInt(temparr[i])]["Discription"]}</p>`;
      let img = `<img class="workout_img" src="${workoutpackage[parseInt(temparr[i])]["img"]}" alt="${workoutpackage[parseInt(temparr[i])]["Name"]}" />`;
      let exercises = `<div >`;


       workoutpackage[parseInt(temparr[i])]["Exrecises"].forEach(item => {
           exercises += `<p > ${item[0]}  ${item[1]}/per rep Reps  - ${item[2]} </p>`;
       })

        exercises += `</div>`;

        workouthtml += `<section  class="exersice_section">${name}${disc}<div class="exercise">${img}${exercises}</div></section>`;

        
    }

        } 

                        $("#packages").html(workouthtml);
                        $("#mymeal_btn").removeClass("active")
                        $("#myworkout_btn").addClass("active")
                        }
                    }
            
                                    xmlhttp.open("GET", "addMember_program.php?p=fetch" );
                                    xmlhttp.send();

                }

                getMyWorkout()

        window.getMyMealplan = () => {
                $("#slide_btns").hide()
            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText; 
                        console.log(firsttime_response);

                        if(firsttime_response === "Empty")
                              { console.log("empty") }
                        else {
                            let mealarr = firsttime_response.split("-")
                            mealarr.pop();
                            mealarr = mealarr.reverse();
                        
                    let mymeal_sec = "<section class='mymeal_sec'>";

                            for(let key of mealarr) {
                                key = parseInt(key);
                    const div = `<div class="mealslist_div" onClick="showMealplan(${key})"><h2>${meals[key]["Name"]}</h2>`;
                    const p = `<p>${meals[key]["Discription"]}</p></div>`;
                              
                       mymeal_sec += `${div}${p}`;
                            }

                            mymeal_sec += `</section>`;


                        $("#packages").html(mymeal_sec);
                        $("#myworkout_btn").removeClass("active")
                        $("#mymeal_btn").addClass("active")
                            

                        }
                    } 

                        xmlhttp.open("GET", "processMyMeal.php?f=fetch" );
                                    xmlhttp.send();
                     

        }


        window.showMealplan = key => {
            let maintitle = `<button id="backbtn_yelllow" onClick="getMyMealplan()">
    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="yellow" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m8 5l-5 5l5 5"/><path d="M3 10h8c5.523 0 10 4.477 10 10v1"/></g></svg>
    </button><h2 id="view_title">${meals[key]["Name"]}</h2>`;
    let subtitle = `<h3 class="type_title">Breakfast</h3>`
    let mealitems_ul_breakfast = ``;
    let tempingr
      
    for(let item in meals[key]["Breakfast"]) {
        mealitems_ul_breakfast += `<ul class="viewmeal_ul"><li>${item}</li>`
        mealitems_ul_breakfast += `<li class="name">${meals[key]["Breakfast"][item]["Name"]}</li>`;

        tempingr = "<li class='ingredient'>Ingredients : "
        meals[key]["Breakfast"][item]["Ingredients"].forEach(ingr => {
              tempingr += `${ingr}`
        })

        tempingr += `</li><li class="nutrition">Nutritional Value : ${meals[key]["Breakfast"][item]["Nutrition_Details"]}</li></ul>`;
        mealitems_ul_breakfast += tempingr;

    }

    tempingr = ""
    let subtitle_two = `<h3 class="type_title">Lunch</h3>`
    let mealitems_ul_lunch = ``;


    for(let item in meals[key]["Lunch"]) {
        mealitems_ul_lunch += `<ul class="viewmeal_ul"><li>${item}</li>`
        mealitems_ul_lunch += `<li class="name">${meals[key]["Lunch"][item]["Name"]}</li>`;       

        let tempingr = "<li class='ingredient'>Ingredients : "
        meals[key]["Lunch"][item]["Ingredients"].forEach(ingr => {
              tempingr += `${ingr}\n`
        })

        tempingr += `</li><li class="nutrition">Nutritional Value : ${meals[key]["Lunch"][item]["Nutrition_Details"]}</li></ul>`;
        mealitems_ul_lunch += tempingr;
    }

    tempingr = ""
    let subtitle_three = `<h3 class="type_title">Dinner</h3>`
    let mealitems_ul_dinner = ""


    for(let item in meals[key]["Dinner"]) {
        mealitems_ul_dinner += `<ul class="viewmeal_ul"><li>${item}</li>`
        mealitems_ul_dinner += `<li class="name">${meals[key]["Dinner"][item]["Name"]}</li>`;     

        let tempingr = "<li  class='ingredient'>Ingredients : "
        meals[key]["Dinner"][item]["Ingredients"].forEach(ingr => {
              tempingr += `${ingr}\n`
        })

        tempingr += `</li><li class="nutrition">Nutritional Value : ${meals[key]["Dinner"][item]["Nutrition_Details"]}</li></ul>`;
        mealitems_ul_dinner += tempingr;

    }
    $("#packages").html(`${maintitle}${subtitle}<div class="meal_div">${mealitems_ul_breakfast}</div>${subtitle_two}<div class="meal_div">${mealitems_ul_lunch}</div>${subtitle_three}<div class="meal_div">${mealitems_ul_dinner}</div>`)

        }
    


    </script>

    <script>
        let current = 0;

           const slideWorkout = (type) => { console.log("before" +current)
              if(type === "next"){
            if(current > document.getElementsByClassName("exersice_section").length - 1) { current = 0 }
                console.log(document.getElementsByClassName("exersice_section").length + "length")
            $(document.getElementsByClassName("exersice_section")[current]).fadeOut(500);
           current === document.getElementsByClassName("exersice_section").length - 1 ? $(document.getElementsByClassName("exersice_section")[0]).fadeIn(400)
           : $(document.getElementsByClassName("exersice_section")[current+1]).fadeIn(400) ;
            current++;
        }

          else if(type === "prev") {
            $(document.getElementsByClassName("exersice_section")[current]).fadeOut(500);

           current === 0 ? $(document.getElementsByClassName("exersice_section")[document.getElementsByClassName("exersice_section").length-1]).fadeIn(1000) 
           : $(document.getElementsByClassName("exersice_section")[current-1]).fadeIn(2000);
            current === 0 ? current = document.getElementsByClassName("exersice_section").length - 1 : current--;

          }
          console.log("after" +current)

    }
    </script>

</body>
</html>