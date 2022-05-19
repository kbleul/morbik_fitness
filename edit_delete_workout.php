<?php
        include('database_connect.php');

        session_start(); 
        if(isset($_REQUEST['o'])) { 

            $wid = $_REQUEST['o'];
            $query = "DELETE FROM added_workout_plan WHERE id = $wid";

            if(mysqli_query($con,$query)) { echo "success"; }
             else { echo mysqli_error($con);}
        }

?>