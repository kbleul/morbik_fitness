
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
    <script src="index.js"></script>

    <script>
      const addProgram =( key, index) => {
            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  

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

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
                        <li> <a href="member_dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                         <li><a href="payments.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
                        <li class="has-arrow"><a href="new_health_status.php"><i class="fa fa-heart"></i><span class="hide-menu">Trainers</span></a>
        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>

            <section id="packages">


            </section>
  <script type="module">
   import workoutpackage  from "./workout.js";

   let workouthtml = '';
   let counter = 0;


   for(let key in workoutpackage) {
       let forwho_capitalized = workoutpackage[key]["forwho"].charAt(0).toUpperCase() + workoutpackage[key]["forwho"].slice(1);
       let gender = <?php echo  json_encode($_SESSION['gender']) ?>;

     if(workoutpackage[key]["forwho"] === "both" || workoutpackage[key]["forwho"] === gender || forwho_capitalized === gender){
      let name = `<h2>${workoutpackage[key]["Name"]}</h2>`;
      let disc = `<p class="discription">${workoutpackage[key]["Discription"]}</p>`;
      let img = `<img class="workout_img" src="${workoutpackage[key]["img"]}" alt="${workoutpackage[key]["Name"]}" />`;
      let addbtn = `<button onClick="addProgram(${key}, ${counter})" class="addbtn">
      <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="5em" height="5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="currentColor" d="M17 15V8h-2v7H8v2h7v7h2v-7h7v-2z"/></svg>
      </button>`
      let exercises = `<div  class="exercise_div">`;


       workoutpackage[key]["Exrecises"].forEach(item => {
           exercises += `<p > ${item[0]}  ${item[1]}/per rep Reps  - ${item[2]} </p>`;
       })

        exercises += `${addbtn}</div>`;


        workouthtml += `<section id="${counter}" class="exersice_section">${name}${disc}${img}${exercises}
        <p class="notice">Added</p></section>`;

        counter++;
        
    }

   }
        document.getElementById("packages").innerHTML =workouthtml;

          let sec = document.getElementsByClassName("exersice_section");

          for(let i = 0; i < sec.length; i++) { 
            document.getElementById(i).addEventListener('mouseover', e => { 
                $(e.target).find(".workout_img").fadeOut(100);
                $(e.target).find(".exercise_div").fadeIn("slow");
                })
                document.getElementById(i).addEventListener('mouseleave', e => { 
                $(e.target).find(".exercise_div").fadeOut(100);
                $(e.target).find(".workout_img").fadeIn("slow");
                })
          }

    

</script>
            </main>
        </section>
    </article>


</body>
</html>