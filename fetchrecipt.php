<?php 
    include("database_connect.php");

    if(isset($_REQUEST['s'])) {
    $mid = $_REQUEST['s'];
    $output = "";

    $query = "SELECT * FROM payment_main WHERE Mid = $mid";
        if($result = mysqli_query($con,$query)) {
            if(mysqli_num_rows($result) == 0) { $output = "<p class='no_payment_p'>No payments made yet.</p>"; }

            while($row = $result->fetch_assoc()) {
                $name = $row['FName']. " ".$row["LName"];
                $by = $row['ProcessedBy'];
                $fee = $row['Fee'];
                $date = $row['Date'];

                $output = $output . "<ul class='view_ul_ul'><li>$name</li><li>$by</li><li>$fee</li><li>$date</li></ul>";
            }
            echo $output;

       } else { echo "<script>console.log(".mysqli_error($con)."</script>"; }
        
    } else { echo "none"; }
?>