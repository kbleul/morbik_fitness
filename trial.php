<?php  include('../constant/connect.php');  ?>
<?php include('head.php');?>


  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Qahiri&family=Roboto:ital,wght@0,400;1,700&display=swap"
        rel="stylesheet">
    <script src="jquery-3.6.0.js"></script>


    <title>Morbik Fitness</title>
</head>

<body>
    <article class="header_wrapper">
        <header class="flex">
            <a href="index.html" id="logo_link"><img id="logo_img" src="pics/logo.svg" alt="logo"></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a class="nav_link" href="">Home</a></li>
                    <li><a class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
                </ul>
            </nav>

        </header>

    </article>
    <div class="hero_img_container"><img src="imgs/workout2.jpg" alt="library"></div>

    <h1 id="school_name"> Morbik Fitness </h1>
    <hr>

    <section class=" form_container--signin">
        <form action="#" method="post">
            <section id="firstform" class="flex">

                <div>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required="required" autocomplete="off"
                        placeholder="xyz@mail.com">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" required="required">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" required="required">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" required="required">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" required="required">
                </div>
                <div class="right-form">

                    <label for="age">Date Of Birth</label>
                    <input type="date" name="dob" id="dob" required="required">
                    <label for="gender" class="" flex>Gender</label>
                    <section class="gender_container">
                        <section class="gender_subcontainer">
                            <p>Male</p><input type="radio" value="male" name="male" id="male">
                        </section>
                        <section class="gender_subcontainer">
                            <p>Female</p><input type="radio" value="female" name="female" id="female">
                        </section>
                    </section>
                    <label for="weight">Weight</label>
                    <input type="number" max="150" min="40" name="weight" id="weight" placeholder="Weight in kg">
                    <label for="height">Height</label>
                    <input type="number" max="250" min="130" name="height" id="height" placeholder="Height in meter">

                </div>
            </section>
            <section id="secondform" class="secondform">
                <div>

                    <label for="program">Program</label>
                    <section class="program_wrapper">
                        <input id="programs_inputbtn" name="program" type="button" value="Normal Workout">
                        <ul id="program_ul">

                            <?php
                            $query="select * from main_program";
                            $result=mysqli_query($con,$query);
                            if(mysqli_affected_rows($con)!=0){
                                while($row=mysqli_fetch_row($result)){
                                    echo "<li class="program_li">".$row[1]."</li> ";
                                }
                            }
    
                        ?>
                        </ul>
                    </section>
                    <label for="plan">Plan</label>
                    <section class="plan_wrapper">
                        <input id="plans_inputbtn" name="plan" type="button" value="15 days a month">
                        <ul id="plan_ul">
                            <li class="plan_li">Full Month</li>
                        </ul>
                    </section>
                    <label for="trainer">Request a private trainer</label>
                    <section class="trainer_bool-container">
                        <section class="trainer_bool-subcontainer flex">
                            <p>Yes</p><input type="radio" name="trainer_yes" value="trainer_yes" id="trainer_yes">
                        </section>
                        <section class="trainer_bool-subcontainer flex">
                            <p>No</p><input type="radio" name="trainer_no" value="trainer_no" id="trainer_no">
                        </section>
                    </section>
                    <section id="time_wrapper">
                        <label for="time">Working out time starts at (in local time) </label>
                        <input type="time" name="time" id="time_input" required="required">
                        <label for="time_end">Working out time ends at  </label>
                        <input type="time" name="time_end" id="time_input-end" required="required">
                    </section>
                    <section class="schedule_wrapper">
                        <label for="schedule">Schedule</label>
                        <input id="schedule_inputbtn" name="schedule" type="button"
                            value="Morning (12:30am - 2:00am local time)" required="required">
                        <ul id="schedule_ul">
                            <li class="schedule_li">Afternoon (11pm - 12:30pm local time)</li>
                            <li class="schedule_li">Night (2am - 3:30pm local time)</li>
                        </ul>
                    </section>
                </div>

                <div class="right-form">
                    <section class="package_wrapper">
                        <label for="package">Discount Package</label>
                        <input id="package_inputbtn" name="package" type="button" value="Normal (No Discount)"
                            required="required">
                        <ul id="package_ul">
                            <li class="package_li">Student (10% Discount) <span>You will need to show school id!</span>
                            </li>
                            <li class="package_li">Pay annual payment (15% Discount)</li>
                        </ul>
                    </section>
                    <label for="password">New Password</label>
                    <input type="password" name="password" placeholder="atleast 8 characters" required="required"
                        autocomplete="off">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" name="password_confirm" autocomplete="off">
                    <input id="submit_btn" type="submit" value="Create New Account" required="required">

                </div>

            </section>

        </form>
        <button id="nextbtn">Next >></button>

    </section>

    <script>
        const showNext = () => {

            if (($("#email").val() !== "" && $("#email").val().includes("@")) && $("#username").val() !== ""
                && $("fname").val() !== "" && $("#lname").val() !== "" && ($("#phone").val() !== ""
                    && $("#phone").val().length === 10) && $("#dob").val() !== "" && ($("#male").prop("checked") || ($("#female").prop("checked"))) &&
                $("#weight").val() !== "" && $("#height").val() !== "") {
                $("#firstform").hide();
                $("#secondform").removeClass("secondform");
                $("#secondform").addClass("flex");
                $("#nextbtn").hide();
                $("#submit_btn").show();
            }

            else if ($("#email").val() === "" || $("#email").val().includes("@") === false) { $("#email").focus().css("border-color", "aqua"); }
            else if ($("#username").val() === "") { $("#username").focus().css("border-color", "aqua"); }
            else if ($("#fname").val() === "") { $("#fname").focus().css("border-color", "aqua"); }
            else if ($("#lname").val() === "") { $("#lname").focus().css("border-color", "aqua"); }
            else if (($("#phone").val() === "" || $("#phone").val().length !== 10)) { $("#phone").focus().css("border-color", "aqua"); }
            else if ($("#dob").val() === "") { $("#dob").focus().css("border-color", "aqua"); }
            else if ($("#weight").val() === "") { $("#weight").focus().css("border-color", "aqua"); }
            else if ($("#height").val() === "") { $("#height").focus().css("border-color", "aqua"); }
        }

        const showItems = (type) => {
            if (type === "program") { $("#program_ul").toggle() }
            else if (type === "plan") { $("#plan_ul").toggle() }
            else if (type === "schedule") { $("#schedule_ul").toggle() }
            else if (type === "package") { $("#package_ul").toggle() }
        }

        const pickProgram = e => {
            let temptxt = $("#programs_inputbtn").val();
            $("#programs_inputbtn").val(e.target.innerHTML)
            e.target.innerHTML = temptxt;
            $("#program_ul").toggle();
        }

        const pickPlan = e => {
            let temptxt = $("#plans_inputbtn").val();
            $("#plans_inputbtn").val(e.target.innerHTML)
            e.target.innerHTML = temptxt;
            $("#plan_ul").toggle();
        }

        const pickSchedule = e => {
            let temptxt = $("#schedule_inputbtn").val();
            $("#schedule_inputbtn").val(e.target.innerHTML);
            e.target.innerHTML = temptxt;
            $("#schedule_ul").toggle();
        }

        const pickPackage = e => {
            let temptxt = $("#package_inputbtn").val();
            $("#package_inputbtn").val(e.target.innerHTML);
            e.target.innerHTML = temptxt;
            $("#package_ul").toggle();
        }

        //checkbox control
        const uncheckInput_gender = type => { type === "male" ? $("#female").prop("checked", false) : $("#male").prop("checked", false) }
        const uncheckInput_trainer = type => {
            if (type === "yes") { $("#trainer_no").prop("checked", false); $("#time_wrapper").show(); $(".schedule_wrapper").hide(); }
            else {
                $("#trainer_yes").prop("checked", false);
                $("#time_wrapper").hide();

                if ($("#programs_inputbtn").val() === "Aerobics" || $("#programs_inputbtn").val() === "Yoga") { $(".schedule_wrapper").show(); }
            }
        }


        document.getElementById("nextbtn").addEventListener("click", () => showNext());

        //show hidden items
        document.getElementById("programs_inputbtn").addEventListener("click", () => showItems("program"));
        document.getElementById("plans_inputbtn").addEventListener("click", () => showItems("plan"));
        document.getElementById("schedule_inputbtn").addEventListener("click", () => showItems("schedule"));
        document.getElementById("package_inputbtn").addEventListener("click", () => showItems("package"));




        document.getElementById("male").addEventListener("click", () => uncheckInput_gender("male"));
        document.getElementById("female").addEventListener("click", () => uncheckInput_gender("female"));
        document.getElementById("trainer_no").addEventListener("click", () => uncheckInput_trainer("no"));
        document.getElementById("trainer_yes").addEventListener("click", () => uncheckInput_trainer("yes"));



        const program_liarr = document.getElementsByClassName("program_li");
        const plan_liarr = document.getElementsByClassName("plan_li");
        const schedule_liarr = document.getElementsByClassName("schedule_li");
        const package_liarr = document.getElementsByClassName("package_li");




        for (let i = 0; i < program_liarr.length; i++) { program_liarr[i].addEventListener("click", e => pickProgram(e)) }
        for (let i = 0; i < plan_liarr.length; i++) { plan_liarr[i].addEventListener("click", e => pickPlan(e)) }
        for (let i = 0; i < schedule_liarr.length; i++) { schedule_liarr[i].addEventListener("click", e => pickSchedule(e)) }
        for (let i = 0; i < package_liarr.length; i++) { package_liarr[i].addEventListener("click", e => pickPackage(e)) }




    </script>
</body>

</html>