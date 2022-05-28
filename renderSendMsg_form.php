<?php
    include('database_connect.php');

    if(isset($_REQUEST['i'])){
        $memid = $_REQUEST['i'];
        $id = $_SESSION['id'];
        $counter = 0;
        $output = '';

     $query = "SELECT * FROM employee WHERE ID = $memid";

     if($result = $con->query($query)) {
         while($row = $result->fetch_assoc()) {
             $mem_name = $row['FName']." ".$row['LName'];
         }

        $query = "SELECT * FROM member_notice WHERE Senderid = $id AND Mid = $memid ORDER BY Time ASC";

      if($resulttwo = $con->query($query)) {
        $rowcount=mysqli_num_rows($resulttwo);

        if($rowcount == 0)  {$output = "<ul class='msgul'><li></li></ul>";}
          while($rowtwo = $resulttwo->fetch_assoc()) {

          }
      }
     }
    }

?>