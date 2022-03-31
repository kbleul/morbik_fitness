<?php
  
  
  $con =mysqli_connect("localhost:3306","root", "","gymdb");

  if(!$con){
    die('Could not Connect to database :' .mysql_error());
}

  ?>