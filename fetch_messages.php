<?php session_start(); 
    include('database_connect.php');

    if(isset($_REQUEST['r'])) {
        if($_REQUEST['r'] == 'group') {
            $query = "SELECT * FROM all_notice WHERE Groups = 'Members' OR Groups = 'All' ORDER BY Time ASC";
            $output = "";
            $counter = 0;
               
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
               }
              else { $output = mysqli_error($con); }
            
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
                    $output = $output . "<ul class='msgul'><li class='msg_from'>From : $name </li><li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
            
                    }
                    else {
                    $output = $output . "<li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
                    }
                   
                    $counter++;
                }
                if($output != "") { $output = $output . "</ul>"; }
                else { $output = "No Messages yet ..."; }
               }
              else { $output = mysqli_error($con); }
            
              echo $output;
        }
    }
   

    ?>