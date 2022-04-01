<?php
include 'database_connect.php'; 
if(isset($_POST['submit_member'])) {
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender= $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $password = $_POST['password'];

    $query = "INSERT into member (FName,LName,Gender,DOB,Weight,Height,Email,Username,Password) VALUES 
          ('$fname','$lname','$gender','$dob','$weight','$height','$email','$uname','$password');";

    if( mysqli_query($con,$query))
    {
        $query = "SELECT * FROM member where Password='$password'";

        if($result= $con->query($query)){
            while($row=$result -> fetch_assoc() ){
                $id = $row['ID'];
                $query = "INSERT INTO member_contact(MemID,Phone_Number) VALUES ('$id','$phone');";

                if( mysqli_query($con,$query)) {  echo "<script>alert('successfull');</script>"; }
                else {  
                    $error = mysqli_error($con);
                    echo "<script>alert('unsccessfull director insert operation... '.$error);</script>";
                     }
            }
         }
        }
    } else { 
echo "error";

}
 /* if(isset($_POST['submit_member'])) {
  

    
$query = "INSERT into member (FName,LName,Gender,DOB,Weight,Height,Email,Username,Password) VALUES 
          ('$fname','$lname','$gender','$dob','$weight','$height','$email','$uname','$password');";

    if( mysqli_query($con,$query))
    { echo "<script>console.log('successfull');</script>"
        $query = "SELECT * FROM member where Password='$password'";

        if($result= $con->query($query)){
            while($row=$result -> fetch_assoc() ){
                $id = $row['ID'];
                $phoneno = $row['Phone_Number'];
                $query = "INSERT INTO member_contact(MemID,Phone_Number) VALUES ('$id','$phoneno');";

                if( mysqli_multi_query($con,$query)) {  echo "<script>alert('successfull');</script>"; }
                else {  
                    $error = mysqli_error($con);
                    echo "<script>alert('unsccessfull director insert operation... '.$error);</script>";}
            }
        }
    }
    else {
        $error = mysqli_error($con);
        echo "<script>alert('unsccessfull director insert operation... '.$error);</script>";
    }
  
  }
*/
?>
