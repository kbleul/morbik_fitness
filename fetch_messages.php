<?php session_start(); 
    include('database_connect.php');

    if(isset($_REQUEST['r'])) {
        if($_REQUEST['r'] == 'group' || $_REQUEST['r'] == 'trainer') {
        $query = "";

    if($_REQUEST['r'] == 'trainer') {
        $id = $_SESSION['id'];

        $query = "SELECT * FROM main_members_table WHERE ID = $id";

        if($checkresult = $con -> query($query)) {
            while($rowcheck = $checkresult -> fetch_assoc()) {
                $private_t = $rowcheck['Private_Trainer_Id'];
                $group_t = $rowcheck['TrainerId'];
                echo "<script>console.log('1');</script>";
                if(is_null($private_t) && is_null($group_t)) {
                echo "<script>console.log('3');</script>";
                $query = "";
                }
                else if(is_null($private_t) == true && is_null($group_t) == false) {
                    $query = "SELECT * FROM all_notice WHERE id = $group_t And Groups = 'Members' ORDER BY Time ASC";
                echo "<script>console.log('4');</script>";

                }
                else if(is_null($private_t) == false && is_null($group_t) == true) {
                    $query = "SELECT * FROM all_notice WHERE id = $private_t And Groups = 'Members' ORDER BY Time ASC";
                echo "<script>console.log('5');</script>";

                }
                echo "<script>console.log('2');</script>";

            }
        } else {  echo "<script>console.log(".mysqli_error($con).");</script>";  }
    }
     
    else {  $query = "SELECT * FROM all_notice WHERE id= 2 AND Groups = 'Members' OR Groups = 'All' ORDER BY Time ASC";  }

            $output = "";
            $counter = 0;
               
            if($query == "") { 
                $output = "<ul class='msgul'><li class='msg_from'>From :  </li><div class='msg_subwrapper'><p>No trainers ...</p></div>";
            }
            else {
               if($result= $con->query($query)){
                while($row= $result -> fetch_assoc() ){
                    $name = $row['Name'];
                    $group = $row['Groups'];
                    $msg = $row['Msg'];
                    $time = $row['Time'];
            
                    if($counter == 0) {
                    $output = $output . "<ul class='msgul'><li class='msg_from'>From : $name </li><div class='msg_subwrapper'><li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
            
                    }
                    else {
                    $output = $output . "<li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
                    }
                   
                    $counter++;
                }
                if($output != "") { $output = $output . "</div></ul>"; }
                else { $output = "No Messages yet ..."; }

               }
              else { $output = mysqli_error($con); }
        }
              echo $output;
        }

        else {
            $id = $_SESSION['id'];
            $query = "SELECT * FROM member_notice WHERE Mid = '$id' ORDER BY Time ASC";
            $output = "";
            $counter = 0;
              
               if($result= $con->query($query)){  

                while($row= $result -> fetch_assoc() ){

                    $name = $row['Name'];
                    $msg = $row['Message'];
                    $time = $row['Time'];
                    $status = $row['Status'];
            
                    if($counter == 0) {
                    $output = $output . "<ul class='msgul'><li class='msg_from'>From : $name </li><div class='msg_subwrapper'><li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
            
                    }
                    else {
                    $output = $output . "<li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
                    }
                   
                    $counter++;
                }
                if($output != "") { $output = $output . "</div></ul>"; }
                else { $output = "No Messages yet ..."; }
               }
              else { $output = mysqli_error($con); }
            
              echo $output;
        }
    }
   

    ?>