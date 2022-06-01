<?php
    include('database_connect.php');
    session_start();

     if(isset($_REQUEST['i'])){ 
        $memid = $_REQUEST['i'];
        $id = $_SESSION['id'];
        $counter = 0;
        $output = '';
        $mem_name = '';

     $query = "SELECT * FROM member WHERE ID = $memid";

     if($result = $con->query($query)) {
         while($row = $result->fetch_assoc()) {
             $mem_name = $row['FName']." ".$row['LName'];
         echo "<script>console.log('error3 $mem_name')</script>";

         }
         echo "<script>console.log('error2 $memid')</script>";

        $query = "SELECT * FROM member_notice WHERE Senderid = '$id' AND Mid ='$memid' ORDER BY Time ASC";

      if($resulttwo = $con->query($query)) {
        $rowcount=mysqli_num_rows($resulttwo);

        if($rowcount == 0)  
        {   $output = "<section id='showmsg_sec'> <li class='msg_from'>TO : $mem_name</li><div class='msg_subwrapper'>
            <p>No messages yet ...</p></div></ul>";   }
        else {
      $output = "<section id='showmsg_sec'><li class='msg_from'>TO : $mem_name</li><div class='msg_subwrapper'>";        
            }
  
            while($rowtwo = $resulttwo->fetch_assoc()) {
                $msg = $rowtwo['Message'];
                $time = $rowtwo['Time'];

        $output = $output . "<li class='msg_text'>$msg</li><li class='msg_time'>$time</li>";
            }

            $output = $output . "</div></section><form id='msg_form'><div id='forminput_wrapper'>
            <textarea id='msg_textarea' type='text' name='msg' placeholder='Message...' required='required'></textarea>

            <button id='sendbtn' type='submit' name='sendbtn'>
            <svg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' role='img' width='3em' height='3em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 32 32'><path fill='currentColor' d='M27.71 4.29a1 1 0 0 0-1.05-.23l-22 8a1 1 0 0 0 0 1.87l8.59 3.43L19.59 11L21 12.41l-6.37 6.37l3.44 8.59A1 1 0 0 0 19 28a1 1 0 0 0 .92-.66l8-22a1 1 0 0 0-.21-1.05Z'/></svg>
            </button></div></form>";
        } else { $output = mysqli_error($con); }
        
       
      } else { $output = mysqli_error($con); }

      echo $output;
     }
    

?>