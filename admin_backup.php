<?php
session_start(); 
if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
{  echo "<script>location.href = 'unautorizedaction.php';</script>"; }

$connect = new PDO("mysql:host=localhost;dbname=gymdb", "root", "");
$get_all_table_query = "SHOW TABLES";
$statement = $connect->prepare($get_all_table_query);
$statement->execute();
$result = $statement->fetchAll();

if(isset($_POST['table']))
{
 $output = '';
 foreach($_POST["table"] as $table)
 {
  $show_table_query = "SHOW CREATE TABLE " . $table . "";
  $statement = $connect->prepare($show_table_query);
  $statement->execute();
  $show_table_result = $statement->fetchAll();

  foreach($show_table_result as $show_table_row)
  {
   $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
  }
  $select_query = "SELECT * FROM " . $table . "";
  $statement = $connect->prepare($select_query);
  $statement->execute();
  $total_row = $statement->rowCount();

  for($count=0; $count<$total_row; $count++)
  {
   $single_result = $statement->fetch(PDO::FETCH_ASSOC);
   $table_column_array = array_keys($single_result);
   $table_value_array = array_values($single_result);
   $output .= "\nINSERT INTO $table (";
   $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
   $output .= "'" . implode("','", $table_value_array) . "');\n";
  }
 }
 $file_name = 'UnifiedGym_DBbackup_on_' . date('y-m-d') . '.sql';
 $file_handle = fopen($file_name, 'w+');
 fwrite($file_handle, $output);
 fclose($file_handle);
 header('Content-Description: File Transfer');
 header('Content-Type: application/octet-stream');
 header('Content-Disposition: attachment; filename=' . basename($file_name));
 header('Content-Transfer-Encoding: binary');
 header('Expires: 0');
 header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_name));
    ob_clean();
    flush();
    readfile($file_name);
    unlink($file_name);
}

?>


<?php session_start(); 
   if( isset($_SESSION["email"]) == false || isset($_SESSION["password"] ) == false)
   {  echo "<script>location.href = 'unautorizedaction.php';</script>"; }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Qahiri&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="home.css">

    <!-- google translate script 1-->
    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<!-- Call back function 2 -->
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                <div id="google_translate_element"></div>

                </ul>
            </nav>
           
        </header>
       
    </article>

    <article class="main_wrapper">
        <section class="side_nav-wrapper">
            <nav>
                <li><a href="admin_dashboard.php" aria-expanded="false">Dashboard</a></li> 
                <li><a href="admin_addmanager.php" aria-expanded="false">Add Manager</a></li> 
                <li><a href="admin_backup.php" aria-expanded="false">Back Up</a></li>
                <li id="logout_li" onclick="showPrompt()">Log Out</li>
            </nav>
        </section>
        <section class="main_content-wrapper">
        <div class="container">
   <div class="row">
    <h2 align="center"> Backup Tables Or Full Database </h2>
    <br />
<script>
    const showPrompt = () => {
        let do_logout = confirm("Are you sure you want to log out ?");

        if(do_logout) { location.href = "logout.php";  }
    }

 const checkAll = () => {
     if( $("#checkall").val() === "false") {
        for(let table of document.querySelectorAll(".checkbox_table")) {
            table.checked = true;
        }s

        $("#checkall").text("Uncheck All").val("true")
    } else {
        for(let table of document.querySelectorAll(".checkbox_table")) {
            table.checked = false;
        }

        $("#checkall").text("Check All").val("false")
    }
    }
</script>
    <button id="checkall" onclick="checkAll()" value="false">Check All</button>
    <form method="post" id="export_form">
     <h3>Select Tables for Export</h3>
     <div id="checkbox_wrapper">
    <?php
    foreach($result as $table)
    {
    ?>
     <div class="checkbox">
      <label><input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_gymdb"]; ?>" /> <?php echo $table["Tables_in_gymdb"]; ?></label>
     </div>
    <?php
    }
    ?>
    </div>
     <div class="form-group">
      <input  type="submit" name="submit" id="submit" class="btn btn-info" value="Export" />
     </div>
    </form>
   </div>
  </div>
        </section>
    </article>

  <script type="text/javascript" src="togglesubmenu.js"></script>


</body>
</html>


<script>
$(document).ready(function(){
 $('#submit').click(function(){
  var count = 0;
  $('.checkbox_table').forEach(function(){
   if($(this).is(':checked'))
   {
    count = count + 1;
   }
  });
  if(count > 0)
  {
   $('#export_form').submit();
  }
  else
  {
   alert("Please Select Atleast one table for Export");
   return false;
  }
 });

});

 
</script>