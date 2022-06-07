
   <?php 
    session_start();
    include('database_connect.php');
   //if username and email are not set for this session then user has not logged in to the system
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }



   if(isset($_POST["submit"])) { echo "<script>console.log('1')</script>";
    $actiontype = $_POST['action'];
    $title = $_POST["Name"];
    $discription = $_POST["Discription"];
    $forwho = $_POST["forwho"];
    $weeks = $_POST["weeks"];
    $rest = $_POST["rest"];
    $counter = $_POST["counter"];
    $trainerid = $_SESSION['id'];
    $date = date("Y-m-d");
    $id;

    if($actiontype == "addnew") {

    $query = "";
    if($_POST['Discription'] == "" || $_POST['Discription'] == " ") {
        $query = "INSERT INTO added_workout_plan (tid,Name,Forwho,Weeks,Rest,registration_date) VALUES ('$trainerid', '$title','$forwho','$weeks','$rest','$date')";

     } else {
    $query = "INSERT INTO added_workout_plan (tid,Name,Discription,Forwho,Weeks,Rest,registration_date) VALUES ('$trainerid','$title','$discription','$forwho','$weeks','$rest','$date')";
     }

     
    if(mysqli_query($con,$query)) { echo "<script>console.log('2')</script>";
        $query = "SELECT * FROM added_workout_plan WHERE Name = '$title'";
        if($result= $con->query($query)){
            while($row= $result -> fetch_assoc() ){
                $id = $row['id'];
            }

        //     $count = number_format($counter);
        //   echo "<script>console.log('aa')</script>";
        //   echo "<script>console.log($counter === 0)</script>";

        //   echo "<script>console.log($count === 0 )</script>";

                for($i = 0 ; $i <= number_format($counter) ; $i++) {
                        $exercises = $_POST["exercise".$i];
                        $amount = $_POST["amount".$i];
                        $reps = $_POST["reps".$i];
                        $error;

               //         echo "<script>console.log($id + ' ' + $exercises + ' ' + $amount + ' ' + $reps)</script>";

                    $query = "INSERT INTO exercise (Wid,Name,Sets,Rep) VALUES ($id,'$exercises',$amount,$reps)";

                    if(mysqli_query($con,$query)) {  echo "<script>console.log('yess')</script>";}
                    else {  
                        $error = mysqli_error($con);
                        echo "<script>console.log($error)</script>";    }
                }
              

              } else {  $error = mysqli_error($con);
                echo "<script>console.log($error)</script>";  }

        } else {  $error = mysqli_error($con);
                        echo "<script>console.log($error)</script>";  }

       }

       else  if($actiontype == "update") {

        $query = "SELECT * FROM added_workout_plan WHERE tid= $trainerid AND Name = '$title'";
        echo "<script>console.log('$trainerid - $title');</script>";

        if($result= $con->query($query)){
            while($row= $result -> fetch_assoc() ){
                echo "<script>console.log('updated3')</script>";

                $wid = $row['id'];
                $query = "UPDATE added_workout_plan
                SET Name = '$title', Discription = '$discription', Forwho = '$forwho' , Weeks = '$weeks' , Rest = '$rest' 
                WHERE id = $wid";

                if($con->query($query)) {
            $query = "DELETE FROM exercise WHERE Wid = $wid";

            if($con ->query($query)) {
                for($i = 0 ; $i <= number_format($counter) ; $i++) {
                    $exercises = $_POST["exercise".$i];
                    $amount = $_POST["amount".$i];
                    $reps = $_POST["reps".$i];

           //         echo "<script>console.log($id + ' ' + $exercises + ' ' + $amount + ' ' + $reps)</script>";

                $query = "INSERT INTO exercise (Wid,Name,Sets,Rep) VALUES ($wid,'$exercises',$amount,$reps)";

                if(mysqli_query($con,$query)) {  echo "<script>console.log('yess')</script>";}
                else {  
                    $error = mysqli_error($con);
                    echo "<script>console.log($error)</script>";    }
            }
            }
            else {  $error = mysqli_error($con);  echo "<script>console.log($error)</script>"; }

            echo "<script>console.log('updated')</script>"; }
                else {  $error = mysqli_error($con);  echo "<script>console.log($error)</script>"; }
            }
        } else { $error = mysqli_error($con);  echo "<script>console.log($error)</script>"; }

       }

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
    <link rel="stylesheet" href="programs.css">
    <link rel="stylesheet" href="trainer.css">

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

          const showPrompt = () => {
            let do_logout = confirm("Are you sure you want to log out ?");

             if(do_logout) { location.href = "logout.php";  }
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
                         <!-- HTML element 3 -->
                    <li><div id="google_translate_element"></div></li>

                </ul>
            </nav>
           


        
        </header>
        </section>
    </article>

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
            <li> <a href="manager_dashboard.php" aria-expanded="false">Dashboard</a></li> 
                        <li><a href="manage_member.php">Members</a></li>
                        <li><a href="manage_inventory.php">Inventory</a></li>

                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
                        <li><a href="managerworkout.php" aria-expanded="false">Workout Plans</a></li>
                        <li class="submenu_conatiner">
                                <div id="0" class="drop_down-container">
                                    <p>Employees</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                                </div>
                                    <ul aria-expanded="false" class="collapse">
                                    <li><a href="new_employee.php">New Employee</a></li>
                                        <li><a href="view_employee.php">Edit Employee Details</a></li>
                                    </ul>
                            </li>      
                <li id="logout_li" onclick="showPrompt()">Log Out</li>

            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>
            <div id='topnav' class="topnav">
                <button id="bygym_btn" onclick="renderAllWorkouts()">By Gym</button>
                <button id="byothers" onclick="renderByOthers()">By Others</button>
                <button id="byme" onclick="renderByMe()">By Me</button>
                <button id="addnew" onclick="show_addWorkout_form()">Add New Workout</button>


            </div>
            <section id="packages"> </section>
            <section id="mypackage"> </section>

  <script type="module">
   import workoutpackage  from "./workout.js";

   window.renderAllWorkouts = () => {
    let workouthtml = '';
   let counter = 0;

            $("#bygym_btn").addClass("active");
            $("#byothers").removeClass("active");
            $("#byme").removeClass("active");
            $("#addnew").removeClass("active");

   
      $("#mypackage").html("");
      $("#packages").show("");


   for(let key in workoutpackage) {
        if(key !== "size") {
       let forwho_capitalized = workoutpackage[key]["forwho"].charAt(0).toUpperCase() + workoutpackage[key]["forwho"].slice(1);
       let gender = <?php echo  json_encode($_SESSION['gender']) ?>;

     if(workoutpackage[key]["forwho"] === "both" || workoutpackage[key]["forwho"] === gender || forwho_capitalized === gender){
      let name = `<h2>${workoutpackage[key]["Name"]}</h2>`;
      let disc = `<p class="discription">${workoutpackage[key]["Discription"]}</p>`;
      let img = `<img class="workout_img on" src="${workoutpackage[key]["img"]}" alt="${workoutpackage[key]["Name"]}" />`;
      let exercises = `<div  class="exercise_div">`;


       workoutpackage[key]["Exrecises"].forEach(item => {
           exercises += `<ul class='exer_ul'> <li>${item[0]}</li> <li>${item[1]}/sets </li><li>Reps  - ${item[2]} </li></ul>`;
       })

        exercises += `</div>`;


        workouthtml += `<section id="${counter}" class="exersice_section"><div class='front_div'>${name}${disc}${img}</div>${exercises}
       </section>`;

        counter++;
        
    }

   }
}
        document.getElementById("packages").innerHTML =workouthtml;
        $("#packages").show("");

          let sec = document.getElementsByClassName("exersice_section");

          for(let i = 0; i < sec.length; i++) { 
            document.getElementById(i).addEventListener('click', e => { 
                // console.log($(e.target).html())
                console.log(e.target)

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

        

        }
        
        renderAllWorkouts();


        window.show_addWorkout_form = () => {
            $("#bygym_btn").removeClass("active");
            $("#byothers").removeClass("active");
            $("#byme").removeClass("active");
            $("#addnew").addClass("active");

            let addworkout_html = `<div id="frontform"><label for="Name">Title</label><input type="text" class="input" id="title" name="Name" require="required" /> `
             addworkout_html += ` <li><input id="action" type="hidden" value='addnew' name='action' /></li>

             <label for="Discription">Discription</label>
                    <textarea id="Discription" name="Discription"  rows="8" cols="33"></textarea>`
             addworkout_html += `<label for="forwho">For(Gender)</label>
                                    <select name="forwho" id="forwho">
                        <option value="both">Both</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select> `
             addworkout_html += `<label for="weeks">Days per week</label><input class="input" type="text" id="weeks" name="weeks" require="required" />
             <input type="hidden" id="counter" name="counter" value="0"> `
             addworkout_html += `<label for="rest">Rest</label><input class="input" type="text" id="rest" name="rest" require="required"/> `
             addworkout_html += `<buttom id="addExercises" onclick="checkEmptyInput()">Add Exercises</button></div>`
           
             addworkout_html += `<ul id="exercise_ul" class="exercise_ul">
                        <li class="exercise_ul-li"><label for="exercise">Exercise</label><input class="exercise_ul-input " type="text"  name="exercise0" require="required"/></li>
                        <li class="exercise_ul-li"><label for="amount">Sets</label><input class="exercise_ul-input " type="text"  name="amount0" require="required"/></li>
                        <li class="exercise_ul-li"><label for="reps">Reptation</label><input class="exercise_ul-input " type="text"  name="reps0" require="required" /></li>
                       <div class="btns_wrapper">
                        <li><button id="addbtn" onClick="addExercises()">+</button></li>
                        <li><button onClick="addNew_MealPlan()" name="submit" id="submit">Submit</button></li>
                        </div>
                        </ul>`;

                        $("#packages").html("").hide();
                        $("#mypackage").html(`<div id="formcontainer" class='formcontainer'><form method="post" id="addexer_form" >${addworkout_html}</form></div>`);


    }

    
  window.checkEmptyInput = () => {
    for(let input of document.getElementsByClassName("input")) {  
          if($(input).val() === "" || $(input).val() === " ") { input.focus();  return }
      }

      $("#frontform").hide();
      $("#exercise_ul").show()

      for(let el of document.getElementsByClassName("addedul")) {  $(el).show("addedul") }

  }

  let counter = 0;
  window.addExercises = () => {
      $(".btns_wrapper").remove();
      const name = $("#title").val();  console.log(name);

      const Discription = $("#Discription").val();
      const weeks = $("#weeks").val();
      const rest = $("#rest").val();
      const gender = $("#forwho").val();
      const action = $("#action").val();

      const exer_list_arr = [];

      for(let i = 0 ; i < document.getElementsByClassName("exercise_ul").length ; i++ ) {
          let temparr = []
          let root = document.getElementsByClassName("exercise_ul")[i];

        temparr.push($(root.querySelectorAll(".exercise_ul-li")[0]).find("input").val())
        temparr.push($(root.querySelectorAll(".exercise_ul-li")[1]).find("input").val())
        temparr.push($(root.querySelectorAll(".exercise_ul-li")[2]).find("input").val())

        exer_list_arr.push(temparr);
      }

      let html = `<ul class="exercise_ul">
                        <li class="exercise_ul-li"><label for="exercise">Exercise</label><input class="exercise_ul-input " type="text"  name="exercise${++counter}" require="required"/></li>
                        <li class="exercise_ul-li"><label for="amount">Sets</label><input class="exercise_ul-input" type="text"  name="amount${counter}" require="required"/></li>
                        <li class="exercise_ul-li"><label for="reps">Reptation</label><input class="exercise_ul-input" type="text"  name="reps${counter}" require="required" /></li>
                       <div class="btns_wrapper">
                        <li><button id="addbtn" onclick="addExercises()">+</button></li>
                        <li><button type="submit" name="submit" onClick="addNew_MealPlan()"  id="submit">Submit</button></li>
                        </div>
                        </ul>`
                        $("#addexer_form").html( $("#formcontainer").html() + html)
                        $("#title").val(name)
                        $("#Discription").val(Discription)
                        $("#forwho").val(gender)
                        $("#weeks").val(weeks)
                        $("#rest").val(rest)

                        for(let i = 0 ; i < exer_list_arr.length ; i++ ) {
          let root = document.getElementsByClassName("exercise_ul")[i];

        $(root.querySelectorAll(".exercise_ul-li")[0]).find("input").val(exer_list_arr[i][0])
        $(root.querySelectorAll(".exercise_ul-li")[1]).find("input").val(exer_list_arr[i][1])
        $(root.querySelectorAll(".exercise_ul-li")[2]).find("input").val(exer_list_arr[i][2])

      }

      $("#counter").val(counter)

  }

  window.attachToggleFunction = () => {

for(let i = 0 ; i < document.getElementsByClassName("front").length; i++) { 
                        document.getElementsByClassName("front")[i].addEventListener("click", () => {
                            console.log("ola")
                            $(document.getElementsByClassName("hidden")[i]).show().addClass("exercises_list").css("display","flex");
                            $(document.getElementsByClassName("front")[i]).hide();

                            $(document.getElementsByClassName("hidden")[i]).find(".backbtn").click(() => {
                            $(document.getElementsByClassName("hidden")[i]).hide().removeClass("exercises_list");
                                $(document.getElementsByClassName("front")[i]).show();
                            });
                         
                        })
                    }
}

window.renderByMe = () => {

            $("#bygym_btn").removeClass("active");
            $("#byothers").removeClass("active");
            $("#byme").addClass("active");
            $("#addnew").removeClass("active");

    const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                        $("#packages").html("").hide();
                        $("#mypackage").html(firsttime_response);
                        attachToggleFunction();
                    }

                    xmlhttp.open("GET", "fetch_workout.php?s=bytrainer");
                                    xmlhttp.send();
  }
</script>

<script>
    const renderByOthers = () => { console.log("sajkdhasj")
        $("#bygym_btn").removeClass("active");
            $("#byothers").addClass("active");
            $("#byme").removeClass("active");
            $("#addnew").removeClass("active");

        const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText; 
                        $("#packages").html("").hide();
                        $("#mypackage").html(firsttime_response);
                    }

                    xmlhttp.open("GET", "fetch_workout.php?o=byothers_all");
                                    xmlhttp.send();
    }

    window.showSubmenu = counter => {
    $(document.getElementsByClassName("btn_wrapper")[counter]).find(".backbtn").hide(300)
    $(document.getElementsByClassName("btn_wrapper")[counter]).find(".hamburger_btn").hide(350)
      $(document.getElementsByClassName("btn_wrapper")[counter]).find(".submenu_wrapper").fadeIn(500).css("display","flex")

  }

  window.deleteWorkout = wid => { console.log(wid)

    const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  
                        console.log(typeof(firsttime_response) == "success")
                        if(firsttime_response === "success") { console.log(firsttime_response)

                            renderByMe();

                            $("#msgbox").text('Workout Deleted !!').show();
                            setTimeout(() => { $("#msgbox").fadeOut(); }, 3000)

                        }
                        else {
                            $("#msgbox").text('Delete Workout failed. Try again later.' + firsttime_response).show();
                            setTimeout(() => { $("#msgbox").fadeOut(); }, 1200)
                        }
                    }

                    xmlhttp.open("GET", "edit_delete_workout.php?o=" + wid);
                                    xmlhttp.send();
  }

  window.editMyWorkout = index => {

    const root = document.getElementsByClassName("front")[parseInt(index)];
    const root_hidden = document.getElementsByClassName("hidden")[parseInt(index)];

      const title = $(root).find(".title").text();
      const disc = $(root).find(".disc").text().split(" : ")[1];
      const forwho = $(root).find(".forwho").text().split(" : ")[1];
      const addedon = $(root).find(".addedon").text();
      const weeks = $(root).find(".hidden_week").text();
      let rest;

      if($(root_hidden).find(".rest").text() !== '' && $(root_hidden).find(".rest").text() !== " ") {
       let str = $(root_hidden).find(".rest").find("b").text().split(" ")

           rest = str[0]
      } else {   rest = $(root_hidden).find(".rest").text();   }
console.log("rest: " + rest)
      const exer_list_arr = [];

    if(root_hidden.querySelectorAll(".exe_list").length > 1) {
      for(let i = 1 ; i < root_hidden.querySelectorAll(".exe_list").length; i++) {
          const subroot = root_hidden.querySelectorAll(".exe_list")[i];
          let temparr = [];
          for(let j = 0 ; j < subroot.querySelectorAll("li").length ; j++) {
            temparr.push(subroot.querySelectorAll("li")[j].innerHTML);
          }
          exer_list_arr.push(temparr);
      }
    }

    show_addWorkout_form();

    $("#title").val(title)
    $("#Discription").val(disc)
    $("#forwho").val(forwho)
    $("#weeks").val(weeks)
    $("#rest").val(rest)


    if(exer_list_arr.length === 1) {
       const subroot =  document.getElementsByClassName("exercise_ul")[0]
       $(subroot.querySelectorAll(".exercise_ul-li")[0]).find("input").val(exer_list_arr[0][0])
       $(subroot.querySelectorAll(".exercise_ul-li")[1]).find("input").val(exer_list_arr[0][1])
       $(subroot.querySelectorAll(".exercise_ul-li")[2]).find("input").val(exer_list_arr[0][2])
    }
    else if(exer_list_arr.length > 1) {
        for(let i = 1; i < exer_list_arr.length; i++) {  addExercises(); }

    for(let i = 0; i < document.getElementsByClassName("exercise_ul").length; i++)  { 
        const subroot =  document.getElementsByClassName("exercise_ul")[i]
       $(subroot.querySelectorAll(".exercise_ul-li")[0]).find("input").val(exer_list_arr[i][0])
       $(subroot.querySelectorAll(".exercise_ul-li")[1]).find("input").val(exer_list_arr[i][1])
       $(subroot.querySelectorAll(".exercise_ul-li")[2]).find("input").val(exer_list_arr[i][2])

       if(i > 0) { $(subroot).addClass("addedul")  }
    }      
    }

    $("#action").val("update")
}
</script>
            </main>
        </section>
    </article>
    <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>