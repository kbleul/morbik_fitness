
    <?php
    include('database_connect.php');
    session_start(); 
    
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }


   $mem_count;
   $emp_count;
   $mem_new;
   $new_mem_count;

   $total;
   $error;

   $month = date('m');

   $query_emp = "SELECT * FROM employee";
   $query_mem = "SELECT * FROM member";
   $query_mem_month = "SELECT * FROM member where month(registration_date)= $month";

        if($result_emp = $con ->query($query_emp)) 
                {  $emp_count = mysqli_num_rows($result_emp);  }
          else {  $error = mysqli_error($con);  }

        if($result_mem = $con ->query($query_mem)) 
                {  
                    $mem_count = mysqli_num_rows($result_mem);  
                    $total = $emp_count + $mem_count;
                }
           else {  $error = mysqli_error($con);  }

         if($result_new = $con ->query($query_mem_month)) 
           {  $mem_new = mysqli_num_rows($result_new);  }
           else {  $error = mysqli_error($con);  }


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
    <link rel="stylesheet" href="manager_dashboard.css">


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
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>
            <section class="boxes_container">
                    <div class="boxes">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.11 0-2 .89-2 2v11c0 1.11.89 2 2 2h4v5l4-2l4 2v-5h4c1.11 0 2-.89 2-2V4c0-1.11-.89-2-2-2zm0 13H4v-2h16v2zm0-5H4V5c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v5z"/></svg>
                        <div class="boxes_discription">
                            <p class="count"><?php echo $total; ?></p>
                            <p>Total Site Users</p>
                        </div>
                    </div>
                    <div class="boxes">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path fill="currentColor" d="m34.59 23l-4.08-5l4-4.9a1.82 1.82 0 0 0 .23-1.94a1.93 1.93 0 0 0-1.8-1.16h-31A1.91 1.91 0 0 0 0 11.88v12.25A1.91 1.91 0 0 0 1.94 26h31.11a1.93 1.93 0 0 0 1.77-1.09a1.82 1.82 0 0 0-.23-1.91ZM2 24V12h30.78l-4.84 5.93L32.85 24Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M9.39 19.35L6.13 15H5v6.18h1.13v-4.34l3.26 4.34h1.12V15H9.39v4.35z" class="clr-i-outline clr-i-outline-path-2"/><path fill="currentColor" d="M12.18 21.18h4.66v-1.02h-3.53v-1.61h3.19v-1.03h-3.19v-1.49h3.53V15h-4.66v6.18z" class="clr-i-outline clr-i-outline-path-3"/><path fill="currentColor" d="M24.52 19.43L23.06 15h-1.22l-1.47 4.43L19.05 15h-1.23l1.96 6.18h1.11l1.56-4.59L24 21.18h1.13L27.08 15h-1.23l-1.33 4.43z" class="clr-i-outline clr-i-outline-path-4"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        <div class="boxes_discription">
                            <p class="count"><?php echo $mem_new; ?></p>
                            <p>This Month</p>
                        </div>
                    </div>
                     <div class="boxes">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2.5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="4"><path stroke-linejoin="round" d="M5 19h38v22a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V19Zm0-9a2 2 0 0 1 2-2h34a2 2 0 0 1 2 2v9H5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m16 31l6 6l12-12"/><path stroke-linecap="round" d="M16 5v8m16-8v8"/></g></svg>
                        <div class="boxes_discription">
                            <p class="count"><?php echo $emp_count; ?></p>
                            <p>Employees</p>
                        </div>
                      </div>   
                </section>  

                <section class="boxes_container table_section">
                  <div id="payment_table_container">
                    <h3>Recent Payments</h3>
                    <ul class="payment_ul table_ul">
                    <ul class="header_ul">
                        <li>Name</li>
                        <li>Processed By</li>
                        <li class="amount_li">Amount</li>
                        <li class="date_li">Date</li>
                      </ul>
                            <?php 
                                    $query = "SELECT * FROM payment_main where month(Date)= $month";

                                        if($result = $con -> query($query)){
                                            while($row = $result -> fetch_assoc()) {
                                                $name = $row['FName']." ".$row["LName"];
                                                $processed = $row["ProcessedBy"];
                                                $fee = $row["Fee"];
                                                $date = $row["Date"];

                                                $output = $output . "<ul><li>$name</li><li>$processed</li>
                                                <li class='amount_li'>$fee Birr</li><li class='date_li'>$date</li></ul>";

                                            }
                                            echo $output;
                                        } else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }
                            ?>
                   </ul>
                  </div>
                  <div id="invetoray_table_container">
                    <h3>New Equipments</h3>
                    <ul class="invintory_ul table_ul">
                      <ul class="header_ul">
                        <li>Name</li>
                        <li>Quantity</li>
                        <li class="amount_li">Price</li>
                        <li class="date_li">Date</li>
                      </ul>
                      <?php 
                                    $query = "SELECT * FROM inventory where month(Last_Added)= $month";
                                        $output = "";

                                        if($result = $con -> query($query)){
                                            while($row = $result -> fetch_assoc()) {
                                                $name = $row['Name'];
                                                $quantity = $row["Quantity"];
                                                $price = $row["Price"];
                                                $date = $row["Last_Added"];

                                                $output = $output . "<ul><li>$name</li><li>$quantity</li>
                                                <li class='amount_li'>$price Birr</li><li class='date_li'>$date</li></ul>";

                                            }
                                            echo $output;
                                        } else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }
                            ?>
                   </ul>
                  </div>
                </section>

                <section class="boxes_container" id="boxes_container_midsection">
                   <div class="boxes" id="trainer_box">
                        <div class='topbox'>
                            <h2>Trainers</h2>
                        </div>
                <?php
        $query  = "SELECT * FROM employee WHERE Job_title = 'Trainer' OR Job_title = 'trainer'";
        $output = "";
        $counttotal = 0;
        $countgroup = 0;
        $countprivate = 0;
        $countnewly = 0;

           if($result = $con -> query($query)){ $counttotal = mysqli_num_rows($result); }
             else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $query  = "SELECT * FROM group_trainer";
        if($result = $con -> query($query)){ $countgroup = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $countprivate = $counttotal - $countgroup;


        $query  = "SELECT * FROM employee WHERE month(registration_data)= $month AND Job_title = 'Trainer'";
        if($result = $con -> query($query)){ $countnewly = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }
           
                ?>
                        <div class='midbox'>
                            <p>Total</p>
                            <p><?php echo $counttotal; ?></p>
                        </div>
                        <div class='secondmid_box'>
                           <div class='sub_lastbox'>
                                <p>Group</p>
                                <p><?php echo $countgroup; ?></p>
                            </div>
                            <div class='sub_lastbox'>
                                <p>Private</p>
                                <p><?php echo $countprivate; ?></p>
                            </div>
                        </div>
                        <div class='lastbox'>
                            <div class='sub_lastbox'>
                                <p>Newly added <?php echo $countnewly; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
        $query  = "SELECT * FROM inventory";
        $output = "";
        $counttotal = 0;
        $countmachine = 0;
        $countweight = 0;
        $countother = 0;
        $countnewly = 0;


           if($result = $con -> query($query)){ $counttotal = mysqli_num_rows($result); }
             else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $query  = "SELECT * FROM inventory WHERE Type = 'Machine'";
        if($result = $con -> query($query)){ $countmachine = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $query  = "SELECT * FROM inventory WHERE Type = 'Weights'";
        if($result = $con -> query($query)){ $countweight = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $query  = "SELECT * FROM inventory WHERE Type = 'Others'";
        if($result = $con -> query($query)){ $countother = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }

        $query  = "SELECT * FROM inventory WHERE month(Last_Added) = $month";
        if($result = $con -> query($query)){ $countnewly = mysqli_num_rows($result); }
        else { echo "<script>console.log('". mysqli_error($con)."');</script>"; }
           
                ?>
                    <div class="boxes" id="inventory_box">
                        <div class='topbox'>
                            <h2>Inventory</h2>
                        </div>
                        <div class='midbox'>
                            <p>Total</p>
                            <p><?php echo $counttotal; ?></p>
                        </div>
                        <div class='secondmid_box'>
                           <div class='sub_lastbox'>
                                <p>Machines</p>
                                <p><?php echo $countmachine; ?></p>
                            </div>
                            <div class='sub_lastbox'>
                                <p>Weights</p>
                                <p><?php echo $countweight; ?></p>
                            </div>
                            <div class='sub_lastbox'>
                                <p>Others</p>
                                <p><?php echo $countother; ?></p>
                            </div>
                        </div>
                        <div class='lastbox'>
                            <div class='sub_lastbox'>
                                <p>Newly added <?php echo $countnewly; ?></p>
                            </div>
                        </div>
                    </div>

                </section>

               

            </main>
        </section>
    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>