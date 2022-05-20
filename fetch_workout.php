<?php
    include('database_connect.php');

    session_start(); 
     if(isset($_REQUEST['s'])) {
        $html = "<div class='mymeal_sec'>";

        $id = $_SESSION['id'];

  $query = "SELECT * FROM workout_main WHERE TrainerId = $id";
        $counter = 0;
  if($result= $con->query($query)){
    while($row= $result -> fetch_assoc() ){ 
        $wid = $row['id'];
        $name = $row['Name'];
        $dis = $row['Discription'];
        $forwho = $row['Forwho'];
        $weeks = $row['Weeks'];
        $rest = $row['Rest'];
        $reg = $row['registration_date']; 
        $img = $row['img'];
        $addedby = $row['Added_By'];
        $let = strval($counter);
        $indexplusid = "5 - $wid";
        
        if($dis == "" || $dis == " ") {
            $html = $html . "<div class='front'><ul class='mealslist_div'><li><h2 class='title'>$name</h2></li><li class='forwho'>For : $forwho</li><li class='addedon'> Added On : $reg</li><li class='hidden_week'>$weeks</li>
            </ul>
            </div> 
             
           <div class='hidden'>
           <div class='btn_wrapper'>
            <button id='backbtn_yelllow' class='backbtn' onClick='backToFront()'>
            <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='3em' height='2.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><g fill='none' stroke='yellow' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path d='m8 5l-5 5l5 5'/><path d='M3 10h8c5.523 0 10 4.477 10 10v1'/></g></svg>
            </button>
            <button class='hamburger_btn' onClick='showSubmenu($counter)'>
            <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='2em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 16 16'><path fill='none' stroke='red' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M2.75 12.25h10.5m-10.5-4h10.5m-10.5-4h10.5'/></svg></button>   
            </button>

            <div class='submenu_wrapper'>
                <button onClick='editMyWorkout($counter)'>Edit Workout</button>
                <button onClick='deleteWorkout($wid)'>Delete Workout</button>
            </div>
       </div>
           <p class='rest'>Rest between reptition = <b>$rest min</b></p>
           <ul class='exe_list'><li>Exercise</li><li>Sets</li><li>Reptition</li></ul>";     
        } else {
        $html = $html . "<div class='front'><ul class='mealslist_div'><li><h2 class='title'>$name</h2></li><li class='disc'>Discription : $dis</li><li class='forwho'>For : $forwho</li><li class='addedon'> Added On : $reg</li><li class='hidden_week'>$weeks</li>
        </ul>
        </div>
        <div class='hidden'>
        <div class='btn_wrapper'>
            <button id='backbtn_yelllow' class='backbtn' onClick='backToFront()'>
            <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='3em' height='2.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><g fill='none' stroke='yellow' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path d='m8 5l-5 5l5 5'/><path d='M3 10h8c5.523 0 10 4.477 10 10v1'/></g></svg>
            </button>
            <button class='hamburger_btn' onClick='showSubmenu($counter)'>
            <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='2em' height='2em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 16 16'><path fill='none' stroke='red' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M2.75 12.25h10.5m-10.5-4h10.5m-10.5-4h10.5'/></svg></button>   
            </button>

            <div class='submenu_wrapper'>
                <button onClick='editMyWorkout($counter)'>Edit Workout</button>
                <button onClick='deleteWorkout($counter)'>Delete Workout</button>
            </div>
       </div>
       <p class='rest'>Rest between reptition = <b>$rest min</b></p>
       <ul class='exe_list'><li>Exercise</li><li>Sets</li><li>Reptition</li></ul>";
        }

        $query = "SELECT * FROM exercise WHERE Wid = $wid";

        if($resultwo = $con->query($query)) {
            while($rowtwo = $resultwo-> fetch_assoc()) {  
                $ex_name = $rowtwo['Name'];
                $sets = $rowtwo['Sets'];
                $rep = $rowtwo['Rep'];

                $html = $html . "<ul class='exe_list'><li>$ex_name</li><li>$sets</li><li>$rep</li></ul>";
            }
            $html =  $html . "</div></ul>";
        } else { 
            $error = mysqli_error($con);
            echo $error; 
        }
        $counter++;

    }

    echo $html."</div>";
   } else {
    $error = mysqli_error($con);
    echo $error; 
   } 
  } 
     
  //FETCH WORKOUTs BY OTHER TRAINERS

  if(isset($_REQUEST['o'])) {
    $html = "<div class='mymeal_sec'>";

    $id = $_SESSION['id'];

$query = "SELECT * FROM workout_main WHERE TrainerId NOT IN ($id)";

if($result= $con->query($query)){
while($row= $result -> fetch_assoc() ){ 
    $wid = $row['id'];
    $name = $row['Name'];
    $dis = $row['Discription'];
    $forwho = $row['Forwho'];
    $weeks = $row['Weeks'];
    $rest = $row['Rest'];
    $reg = $row['registration_date']; 
    $img = $row['img'];
    $addedby = $row['Added_By'];

    if($dis == "" || $dis == " ") {
        $html = $html . "<div class='front'><ul class='mealslist_div'><li><h2>$name</h2></li><li>For : $forwho</li><li> Added By : $addedby </li><li>Added On : $reg</li>
        </div>
        <div class='hidden'>
        <button id='backbtn_yelllow' class='backbtn' onClick='backToFront()'>
       <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='5em' height='5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><g fill='none' stroke='yellow' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path d='m8 5l-5 5l5 5'/><path d='M3 10h8c5.523 0 10 4.477 10 10v1'/></g></svg>
       </button>
       <p>Rest between reptition = <b>$rest min</b></p>
       <ul class='exe_list'><li>Exercise</li><li>Sets</li><li>Reptition</li></ul>";     
    } else {
    $html = $html . "<div class='front'><ul class='mealslist_div'><li><h2>$name</h2></li><li>Discription : $dis</li><li>For : $forwho</li><li> Added By : $addedby </li><li> Added On : $reg</li>
    </div><div class='hidden'>
       <button id='backbtn_yelllow' class='backbtn' onClick='backToFront()'>
       <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='5em' height='5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><g fill='none' stroke='yellow' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path d='m8 5l-5 5l5 5'/><path d='M3 10h8c5.523 0 10 4.477 10 10v1'/></g></svg>
       </button>
       <p>Rest between reptition = <b>$rest min</b></p>
       <ul class='exe_list'><li>Exercise</li><li>Sets</li><li>Reptition</li></ul>";
    }

    $query = "SELECT * FROM exercise WHERE Wid = $wid";

    if($resultwo = $con->query($query)) {
        while($rowtwo = $resultwo-> fetch_assoc()) {  
            $ex_name = $rowtwo['Name'];
            $sets = $rowtwo['Sets'];
            $rep = $rowtwo['Rep'];

            $html = $html . "<ul class='exe_list'><li>$ex_name</li><li>$sets</li><li>$rep</li></ul>";
        }
        $html =  $html . "</div></ul>";
    } else { 
        $error = mysqli_error($con);
        echo "<script>console.log($error)</script>"; 
    }

}

echo $html."</div>";
} else {
$error = mysqli_error($con);
echo $error; 
}
} 
?>