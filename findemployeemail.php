<?php
include 'database_connect.php';




 $mailaddress = $_REQUEST['r'];
 $randcode = "";


  $query = "SELECT * FROM  important_employee_main WHERE Email='$mailaddress'";

  for ($x = 0; $x < 6; $x++) {
    $randcode = $randcode .rand(0,9);
  }
  
        if($result = $con->query($query)){
                    while( $row = $result -> fetch_assoc() ) {
                      $empid = $row['ID'];

                      $to = "vegomag342@hhmel.com";
                      $subject = "Recovery Process\n\nMorbik Gym";
                      $message = "This is your recovery code. 252624";
                      $header = "From: kbleulseged@gmail.com\r\nReply-To: kbleulseged@gmail.com";

                      $mail_sent = mail($to, $subject, $message, $header);
                      if($mail_sent == true) {

                $query = "INSERT into recovery_table (Eid,Recovery_code ) VALUES ('$empid','$randcode');";

        if($con->query($query)){  echo "Message Sent".$randcode; }
        else { echo mysqli_error($con); }

                      }
                      else {
                        echo "Unexpected Error";
                      }

          }
        } else { echo "Email address not found.\n".mysqli_error($con);  }

?>