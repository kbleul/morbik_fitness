
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
    <script type="module">
   import meals  from "./meal.js";

   window.showMealPlan = (key) => {
    
    let maintitle = `<button id="backbtn_yelllow" onClick="renderMealplan_List()">
    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="yellow" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m8 5l-5 5l5 5"/><path d="M3 10h8c5.523 0 10 4.477 10 10v1"/></g></svg>
    </button><h2 id="view_title">${meals[key]["Name"]}</h2>

   <div id="savebtn_div" class="savebtn_div"><button onClick="saveMeal(${key})">
    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="4em" height="4em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="red" d="M16 4c6.6 0 12 5.4 12 12s-5.4 12-12 12S4 22.6 4 16S9.4 4 16 4m0-2C8.3 2 2 8.3 2 16s6.3 14 14 14s14-6.3 14-14S23.7 2 16 2z"/><path fill="red" d="M24 15h-7V8h-2v7H8v2h7v7h2v-7h7z"/></svg>
    </button><p>Save Meal</p></div>`;
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
    
    $("#meal_packages").html(`${maintitle}${subtitle}<div class="meal_div">${mealitems_ul_breakfast}</div>${subtitle_two}<div class="meal_div">${mealitems_ul_lunch}</div>${subtitle_three}<div class="meal_div">${mealitems_ul_dinner}</div>`)

}
    </script>

  
    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">

        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><div id="google_translate_element"></div></li>

                </ul>
            </nav>
           
        </header>
        </section>
    </article>

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
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
        <section class="main_content-wrapper">
            <main id="diet_main">

            <section id="meal_packages">


            </section>
 
            </main>

            <script type="module">
   import meals  from "./meal.js";

  window.renderMealplan_List = () => {

   const ul = "<ul class='mealplan_ul'>";
   let li = "";

   for(let key in meals) {
//console.log(li);\
const objarr = [key,meals];
       li += `<li><button onClick="showMealPlan(${key})">${meals[key]["Name"]}</button></li>`
   }

   const el = ul + li + "</ul>";
   console.log(el)
   document.getElementById("meal_packages").innerHTML = el ;  
  }

        renderMealplan_List()
  
            </script>
        </section>
    </article>

    <script>
        const saveMeal = key => {
            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                        console.log(firsttime_response);

      if(firsttime_response === "Saved" || firsttime_response === "Already saved") 
      { $("#savebtn_div").html(`<p>${firsttime_response}</p>`).hide(1500);  }

      else { console.log(firsttime_response);  }
                    }

                    xmlhttp.open("GET", "processMyMeal.php?p=" + key );
                                    xmlhttp.send();
        }

    
        const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
          }

    </script>

</body>
</html>