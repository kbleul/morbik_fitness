
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
          echo "<script>console.log('$name $disc $quantity $type $price $last_added')</script>";
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
            
                        <li> <a href="manager_dashboard.php" aria-expanded="false">Dashboard</a></li> 
        
                        <li><a href="manage_member.php">Members</a></li>
                        <li><a href="manage_inventory.php">Inventory</a></li>

                        <li><a href="messages.php" aria-expanded="false">Messages/Requests</a></li>
                                   
                        <li><a href="payments.php" aria-expanded="false">Payments</a></li>

                        <li class="submenu_conatiner">
                            <div id="0" class="drop_down-container">
                                <p>Employees</p>
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                            </div>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="new_employee.php">New Employee</a></li>
                                    <li><a href="view_plan.php">Edit Employee Details</a></li>
                                </ul>
                        </li>

                        <li class="submenu_conatiner">
                            <div id="1" class="drop_down-container">
                            <p>Plan</p>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>    
                            </div> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_plan.php">New Plan</a></li>
                               <li><a href="view_plan.php">Edit Subsciption Details</a></li>
                            </ul>
                        </li>
                        <li  class="submenu_conatiner">
                            <div id="2" class="drop_down-container">
                                 <p>Overview</p>
                                 <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                            </div>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="over_members_month.php">Members per Month</a></li>
                                <li> <a href="over_members_year.php">Members per Year</a></li>
                                <li> <a href="revenue_month.php">Income per Month</a> </li>
                            </ul>
                        </li>

                         <li class="submenu_conatiner">
                          <div id="3" class="drop_down-container">
                             <p>Exercise Routine</p>
                             <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="gray" fill-rule="evenodd" d="m5 8l7 8l7-8z"/></svg>
                          </div>
                            <ul  aria-expanded="false" class="collapse">
                               <li><a href="addroutine.php">Add Routine</a> </li>
                               <li> <a href="editroutine.php">Edit Routine</a> </li>
                               <li> <a href="viewroutine.php">View Routine</a></li>
                            </ul>
                        </li>
                        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>
               <div id='topnav'>
                   <button>Equipments</button>
                   <button onclick="addItem_Form()">Add New</button>
               </div>

               <div id="msgbox_wrapper">
                <p id='msgbox'><?php if($status != "") { echo $status; } ?></p>
            </div>

            <script> 
                 setTimeout(() => { $("#msgbox").fadeOut(); }, 3000)
            </script>

                <div class='topnav'>
                   <select name="sortby" id="sortby" onchange="viewInventory(this.value)">
                        <option value="all">All</option>
                        <option value="name">Name</option>
                        <option value="type">Type</option>
                        <option value="date">Date</option>
                   </select>
                   <select name="types" id="types" onchange="viewInventory(this.value)">
                        <option value="all">All</option>
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
        const addItem_Form = () => {
            let html = "<form method='POST'> <label for='name'>Name</label><input type='text' name='name' required='required' />";
            html += `<label for="type">Type</label><select name='type' id='type' required='required'>
            <option value="Weights">Weights</option>
                        <option value="Machine">Machines</option>
                        <option value="Other">Other</option>
            </select>`;
            html += `<label for="disc">Discription</label><input type="text" name="disc" required='required' />`;
            html += `<label for="quantity">Quantity</label><input type="number" name="quantity"  value='1' />`;
            html += `<label for="price">Price</label><input type="text" name="price" />`
            html += `<input id="submit" type="submit" name="submit" value="Submit"/>`


            $("#content_area").html(`<div class='formcontainer'>${html}</div>`);

        }

        const viewInventory  = type => {
            const xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onload = function() {  
                        let firsttime_response = this.responseText;  console.log(type);
                        if(firsttime_response === "unsucessfully") { 
                            $("#msgbox").text('View Inventory is not woorking at this moment. Try again later.' + firsttime_response).show();
                            setTimeout(() => { $("#msgbox").fadeOut(); }, 2000)
                        }
                        else {
                            $("#content_area").html(firsttime_response);
                        }
                    }

                    xmlhttp.open("GET", "view_inventory.php?o=" + type);
                                    xmlhttp.send();
        }

         viewInventory("all"); 
    </script>
  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>