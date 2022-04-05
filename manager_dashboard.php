
    <?php session_start();  ?>

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
            
                        <li> <a href="dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a>
                        </li> 
                        
                    
                         <li id="0" class="submenu_conatiner"> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Members</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_entry.php">Add Member</a></li>
                                <li><a href="view_mem.php">Manage Member</a></li>
                            
                            </ul>
                        </li>
                         <li><a href="payments.php" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Payments</span></a></li>
                        <li id="1" class="submenu_conatiner has-arrow"><a href="new_health_status.php"><i class="fa fa-heart"></i><span class="hide-menu">Employees</span></a>
                        <ul aria-expanded="false" class="collapse">
                                <li><a href="new_plan.php">New Employee</a></li>
                               <li><a href="view_plan.php">Edit Employee Details</a></li>
                            </ul>
                    </li>
                        <li id="2"> <a class="submenu_conatiner has-arrow" href="#" aria-expanded="false"><i class="fa fa-file-text-o"></i><span class="hide-menu">Plan</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_plan.php">New Plan</a></li>
                               <li><a href="view_plan.php">Edit Subsciption Details</a></li>
                            </ul>
                        </li>
                        <li id="3"> <a class="submenu_conatiner has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive"></i><span class="hide-menu">Overview</span></a>
                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                    <a href="over_members_month.php">Members per Month</a>
                                </li>

                                <li>
                                    <a href="over_members_year.php">Members per Year</a>
                                </li>

                                <li>
                                    <a href="revenue_month.php">Income per Month</a>
                                </li>
                            </ul>
                        </li>

                         <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-wheelchair"></i><span class="hide-menu">Exercise Routine</span></a>
                            <ul id="4" aria-expanded="false" class="submenu_conatiner collapse">
                               <li>
                <a href="addroutine.php">Add Routine</a>
            </li>

            <li>
                <a href="editroutine.php">Edit Routine</a>
            </li>

            <li>
                <a href="viewroutine.php">View Routine</a>
            </li>
                            </ul>
                        </li>
                        
                        
            </nav>
        </section>
        <section class="main_content-wrapper">
            <main>
                
            </main>
        </section>
    </article>

    <script>
        const expandSubmemnu = (e) => {
            const element_id = e.target.id;
            console.log(element_id);
           $(document.getElementsByClassName("collapse")[element_id]).toggle();
        }

       let submenu_container = document.getElementsByClassName("submenu_conatiner");

        for(let i = 0; i < submenu_container.length; i++)
        {
            submenu_container[i].addEventListener("click", (e) => { expandSubmemnu(e)} )
        }
    </script>


</body>
</html>