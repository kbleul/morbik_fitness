<?php
include('database_connect.php');

   if(isset($_POST['submit_newpassword']))
   {
       $eid = $_POST['eid'];
       $newpassword = $_POST['new_password'];

       $query= "UPDATE important_employees SET Password = '$newpassword' WHERE id = '$eid'";

       if( mysqli_query($con,$query))
       {  echo "<script>location.href = 'employee_login.php'</script>"; }
       else { echo mysqli_error($con); }

   }

?>