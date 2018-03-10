<?php
$servername = "localhost";
$database = "main";
$username = "webmaster";
$password = "ZsBugG5zfPCDWtv8pHSuKfQtX5v5nBh4";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
  try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
    echo "Connected successfully ";
  } catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
  }

  // Set the variables for the person we want to add to the database
   $teamumber = $_POST["teamnumber"];
   $autoline = $_POST["autoline"];
   $auto_scale = $_POST["auto_scale"];
   $auto_switch = $_POST["auto_switch"];
   $chute_fail = $_POST["teleop_chute_cube_fail"];
   $chute_succes = $_POST["teleop_chute_cube_success"];
   $ground_fail = $_POST["teleop_ground_cube_fail"];
   $ground_success = $_POST["teleop_ground_cube_success"];
   $defense_switch_fail = $_POST["teleop_defense_switch_fail"];
   $defense_switch_success = $_POST["teleop_defense_switch_success"];
   $offense_scale_fail = $_POST["teleop_scale_fail"];
   $offense_scale_success = $_POST["teleop_scale_success"];
   $offense_switch_fail = $_POST["teleop_switch_fail"];
   $offense_switch_success = $_POST["teleop_switch_success"];
   $exchange_fail = $_POST["teleop_exchange_fail"];
   $exchange_success = $_POST["teleop_exchange_success"];
   $assit_others = $_POST["assit_others"];
   $climb_on_other_robot = $_POST["climb_on_other_robot"];
   $climb = $_POST["climb"];
   $levitate = $_POST["levitate"];
   $park = $_POST["park"];
   $userung = $_POST["userung"];
   $matchnumber = $_POST["matchnumber"];
   $scout_name = $_POST["scout_name"];
   $scout_number = $_POST["scout_number"];
   $color = $_POST["color"];



   if(isset($_POST['submit']) && ($_POST['submit'] == "Submit")){
     // Here we create a variable that calls the prepare() method of the database object
     // The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name
     $matchenter = $my_Db_Connection->prepare("INSERT INTO matches_1391(Team_Number) VALUES ('$teamnumber')");

    // Execute the query using the data we just defined
    // The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
    if ($matchenter->execute()) {
      echo "New record created successfully";
      header("Location: index.php"); /* Redirect browser */
exit();
    } else {
      echo "Unable to create record";
    }
  }
else{
   echo "Failed";
}
