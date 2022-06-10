
    <?php session_start(); 
    include('database_connect.php');

   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

   $status = "";

      if(isset($_POST["submit"])) {
          $name = $_POST["name"];
          $disc = $_POST["disc"];
          $quantity = $_POST["quantity"];
          $type = $_POST["type"];
          $price = $_POST["price"];
          $last_added = date("Y-m-d");
          
          $query = "";
           if($price == "" || $price == " ") 
           { $query = "INSERT INTO inventory (Name,Discription,Quantity,Type,Last_Added) VALUES ('$name','$disc','$quantity','$type','$last_added')"; echo "<script>console.log('success3')</script>";}
          else 
 {  $query = "INSERT INTO inventory (Name,Discription,Quantity,Type,Price,Last_Added) VALUES ('$name','$disc','$quantity','$type','$price','$last_added')";  echo "<script>console.log('success4')</script>"; }

           if(mysqli_query($con,$query)) {
            $status = "New Equipment added successfully" ; 
            echo "<script>console.log('$status')</script>"; 
           }
           else { 
               $error = mysqli_error($con);
                echo "<script>console.log($error)</script>";
            }
        }

        
      if(isset($_POST["update"])) {
        $id = $_POST["eq_id"];
        $name = $_POST["name"];
        $disc = $_POST["disc"];
        $quantity = $_POST["quantity"];
        $type = $_POST["type"];
        $price = $_POST["price"];
        $last_added = date("Y-m-d");
        
        $query = "";
         if($price == "" || $price == " ") 
         { 
    $query = "UPDATE inventory SET Name = '$name', Discription = '$disc', Quantity = '$quantity', Type = '$type', Last_Added = '$last_added'
            WHERE id = $id;"; echo "<script>console.log('success3')</script>";
            }
        else 
{  $query = "UPDATE inventory SET Name = '$name', Discription = '$disc', Quantity = '$quantity', Type = '$type', Price = '$price' , Last_Added = '$last_added'
    WHERE id = $id;" ;  echo "<script>console.log('success4')</script>"; }
    

         if(mysqli_query($con,$query)) {
          $status = "Existing Equipment updated successfully" ; 
          echo "<script>console.log('$status')</script>"; 
         }
         else { 
             $error = mysqli_error($con);
              echo "<script>console.log($error)</script>";
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
            <a href="manager_dashboard.php" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                <div id="google_translate_element" class="google_translate_element" ></div>

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
        <section id="main_content-wrapper" class="main_content-wrapper">
            <main>
               <div id='topnav'>
                   <button id="viewinventory_btn" class="active" onclick="viewInventory('all')">Equipments</button>
                   <button id="addto_inventory_btn" onclick="addItem_Form()">Add New</button>
               </div>

               <div id="msgbox_wrapper">
                <p id='msgbox'><?php if($status != "") { echo $status; } ?></p>
            </div>

            <script> 
                 setTimeout(() => { $("#msgbox").fadeOut(); }, 3000)
            </script>

                <div id="submenu" class='topnav'>
                    <label for='sortby'>Sort by : </label>
                   <select name="sortby" id="sortby" onchange="viewInventory(this.value)">
                        <option value="all">All</option>
                        <option value="name">Name</option>
                        <option value="type">Type</option>
                        <option value="date">Date</option>
                   </select>
                   <label for="types" >Catagories : </label>
                   <select name="types" id="types" onchange="viewInventory(this.value)">
                        <option value="all_types">All</option>
                        <option value="weights">Weights</option>
                        <option value="machines">Machines</option>
                        <option value="others">Others</option>
                   </select>
               </div>
               <div id="content_area" >

                </div>
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
    
        const addItem_Form = () => {
            let html = "<form method='POST' id='equ_form'> <label for='name'>Name</label><input id='name' type='text' name='name' required='required' />";
            html += `<label for="type">Type</label><select name='type' id='type' required='required'>
            <option value="Weights">Weights</option>
                        <option value="Machine">Machines</option>
                        <option value="Others">Others</option>
            </select>`;
            html += `<label for="disc">Discription</label><input type="text" name="disc" id="disc" required='required' />`;
            html += `<label for="quantity">Quantity</label><input type="number" name="quantity" id="quantity"  value='1' />`;
            html += `<label for="price">Price</label><input type="text" name="price" id="price" />`
            html += `<input id="submit" type="submit" name="submit" value="Submit"/>`


            $("#content_area").html(`<div class='formcontainer'>${html}</div>`);
            $("#submenu").hide();
            $("#viewinventory_btn").removeClass("active")
            $("#addto_inventory_btn").addClass("active");

        }

        const viewInventory  = type => {
            $("#submenu").show();
            $("#addto_inventory_btn").removeClass("active");
            $("#viewinventory_btn").addClass("active")

            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText; 
                        if(firsttime_response === "unsucessfully") { 
                            $("#msgbox").text('View Inventory is not woorking at this moment. Try again later.' + firsttime_response).show();
                            setTimeout(() => { $("#msgbox").fadeOut(); }, 2000)
                        }
                        else {
                            $("#content_area").html(firsttime_response);
                        }
                    }

                    if(type === 'all' || type === 'name' || type === 'type' || type === 'date')
                        {  xmlhttp.open("GET", "view_inventory.php?s=" + type); }
                    else { xmlhttp.open("GET", "view_inventory.php?c=" + type); }
                                    xmlhttp.send();
        }

         viewInventory("all"); 


        const editItem = index => {
            const root = document.getElementById(`ul${index}`);
            const list = root.querySelectorAll("li");
            let id = $(list[0]).text();
            let name = $(list[1]).text();
            let dis = $(list[2]).text();
            let quan = $(list[3]).text();
            let type = $(list[4]).text();
            let price = $(list[5]).text();

            addItem_Form();
            $("#submit").remove();

            $("#equ_form").html($("#equ_form").html() + 
            `<input id="hidden" type='hidden' name='eq_id' value='${id}' /> <input id='update' type='submit' name='update' />`)

            $("#name").val(name)
            $("#disc").val(dis)
            $("#quantity").val(quan)
            $("#type").val(type)
            $("#price").val(price)
            $("#hidden").val(id)



        }
    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>