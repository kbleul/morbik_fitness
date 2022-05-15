<?php
    include('database_connect.php');

    session_start(); 
echo "1";
     if(isset($_REQUEST['s'])) {
//         $html = "";

//         $id = $_SESSION['id'];

//   $query = "SELECT * FROM workout_main WHERE TrainerId = $id";

//   if($result= $con->query($query)){
//     while($row= $result -> fetch_assoc() ){ echo "hii";
//         $wid = $row['id'];
//         $name = $row['Name'];
//         $dis = $row['Discription'];
//         $forwho = $row['Forwho';];
//         $weeks = $row['Weeks'];
//         $rest = $row['Rest'];
//         $reg = $row['registration_date'];
//         $img = $row['img'];
//         $addedby = $row['Added_By'];

//         $html .= "<ul><li><h2>$name</h2></li><li>$dis</li><li>$forwho</li><li>$reg</li>
//         <div class='hidden'>";

//         $query = "SELECT * FROM exercise WHERE Wid = $id";

//         if($resultwo = $conn->query($query)) {
//             while($rowtwo = $resultwo-> fetch_assoc()) {  echo "hii2";
//                 $ex_name = $rowtwo['Name'];
//                 $sets = $rowtwo['Sets'];
//                 $rep = $rowtwo['Rep'];

//                 $html .= "<li>$ex_name</li><li>$sets</li><li>$rep</li>";
//             }
//             $html .= "</div></ul>";
//         } else { 
//             $error = mysqli_error($con);
//             echo $error; 
//         }

//     }

//     echo $html;
//    } else {
//     $error = mysqli_error($con);
//     echo $error; 
//    }
  echo $_REQUEST['s'];
  } 
?>