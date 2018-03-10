<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Project Siller</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/css_old/please-wait.css">
	<link rel="stylesheet" href="../assets/css_old/pinkit.css">
	<link href="../assets/css_old/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css_old/index.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css_old/sweetalert2.min.css">
	<link rel="stylesheet" href="../assests/css_old/jquery-ui.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src=../"assets/js/jquery.cookie.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/sweetalert2.min.js"></script>
	<script src="../assets/js/jquery-ui.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Project Siller</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../pit/index.php">Pit Scouting</a></li>
					<li ><a href="../match/index.php">Match Scouting</a></li>
					<li class="active"><a href="stats.php">Statistics</a></li>
						</ul>
				</ul>
			</div>
		</div>
	</nav>
<?php
// Translate data through function
function binary($input) {
  if($input == 0) {
    echo 'No';
  } elseif($input == 1) {
    echo 'Yes';
  } else {
    echo 'N/A';
  }
}
function coach($input) {
  if($input == 0) {
    echo 'Student';
  } elseif($input == 1) {
    echo 'Mentor';
  } else {
    echo 'N/A';
  }
}

$servername = "localhost";
$database = "main";
$username = "webmaster";
$password = "ZsBugG5zfPCDWtv8pHSuKfQtX5v5nBh4";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pit scouting Report</title>
</head>
<body>
        <?php
				 $requested_team = $_POST['requestteam'];
            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die(mysql_error());
            }

              $sql = "SELECT * FROM pit_1391 WHERE team_number = '$requested_team'";
                  $result = mysqli_query($conn, $sql);
									$scout_name = "";
									$scout_number = "";
									$team_number = "";
									$vision = "";
									$drive_coach = "";
									$number_of_wheels = "";
									$wheel_type = "";
									$drive_motor_type = "";
									$number_of_motors = "";
									$cross_autoline = "";
									$auto_scale = "";
									$auto_switch = "";
									$cubes_used = "";
									$collect_cubes = "";
									$layers = "";
									$defense = "";
									$prefered = "";
									$scale = "";
									$switch = "";
									$climb = "";
									$park = "";
									$assist_others = "";
									$notes = "";

                      if (mysqli_num_rows($result) > 0) {
                          // output data of each row
                          while($row = mysqli_fetch_assoc($result)) {
                            $scout_name = $row["scout_name"]; $scout_number = $row["scout_number"]; $team_number = $row["team_number"]; $vision = $row["vision"]; $drive_coach = $row["drive_coach"];
                            $number_of_wheels = $row["number_of_wheels"]; $wheel_type = $row["wheel_type"]; $drive_motor_type = $row["drive_motor_type"]; $number_of_motors = $row["number_of_motors"];
                            $cross_autoline = $row["cross_autoline"]; $auto_scale = $row["scale_cube"]; $auto_switch = $row["switch_cube"]; $cubes_used = $row["number_of_cubes"];
                            $collect_cubes = $row["collect_cubes"]; $layers = $row["cube_layers"]; $defense = $row["play_defense"]; $prefered = $row["prefered_location"]; $scale = $row["teleop_scale"]; $switch = $row["teleop_switch"];
                            $climb = $row["climb"]; $park = $row["park"]; $assist_others = $row["helpothers"];
                            $notes = $row["pitnotes"];
                          }
                        } else {

                        }
            ?>
            <div class="container">
          		<div class="panel panel-info">
          			<div class="panel-heading"><h4>Pit Scouting results for team: <?php echo $team_number;?></h4></div>
          			<div class="panel-body">
                  <div class="card-group">
                    <div class="card">
                      <h3 class="card-header primary-color white-text">Basic Info:</h3>
                      <div class="card-body">
                    <p class="card-text">Scout: <?php echo $scout_name; ?></p>
                    <p class="card-text">Scout Team Number: <?php echo $scout_number; ?></p>
                    <p class="card-text">Team Requested: <?php echo $team_number; ?></p>
                    <p class="card-text">Use Vision: <?php echo binary ($vision); ?></p>
                    <p class="card-text">Drive Coach: <?php echo coach ($drive_coach); ?></p>
                  </div>
                </div>
              <div class="card">
                <h3 class="card-header primary-color white-text">Drive Base:</h3>
                <div class="card-body">
                    <p class="card-text">Number of wheels: <?php echo $number_of_wheels; ?></p>
                    <p class="card-text">Type of Wheels: <?php echo $wheel_type; ?></p>
                    <p class="card-text">Type of drive motors: <?php echo $drive_motor_type; ?></p>
                    <p class="card-text">Number of Drive motors: <?php echo $number_of_motors; ?></p>
                  </div>
                </div>

                <div class="card">
                  <h3 class="card-header primary-color white-text">Autonomous:</h3>
                  <div class="card-body">
                    <p class="card-text">Cross Autoline: <?php echo binary ($cross_autoline); ?></p>
                    <p class="card-text">Place Cube on Scale: <?php echo binary ($auto_scale); ?></p>
                    <p class="card-text">Place Cube on Switch: <?php echo binary ($auto_scale); ?></p>
                    <p class="card-text">Number of Cubes used in Auto: <?php echo $cubes_used; ?></p>
                  </div>
                </div>
              </div>
              <div class="card-group">
                <div class="card">
                  <h3 class="card-header primary-color white-text">Tele-Op:</h3>
                  <div class="card-body">
                    <p class="card-text">How they collect cubes: <?php echo $collect_cubes; ?></p>
                    <p class="card-text">How many layers of cubes they can place on the Scale: <?php echo $layers; ?></p>
                    <p class="card-text">Play defense: <?php echo binary ($defense); ?></p>
                    <p class="card-text">Prefered cube location in Tele-Op: <?php echo $prefered; ?></p>
                    <p class="card-text">Place cubes on Scale: <?php echo binary ($scale); ?></p>
                    <p class="card-text">Place cubes on Switch: <?php echo binary ($switch); ?></p>
                  </div>
                </div>
                    <div class="card">
                      <h3 class="card-header primary-color white-text">Endgame</h3>
                      <div class="card-body">
                    <p class="card-text">Climb: <?php echo binary ($climb); ?></p>
                    <p class="card-text">Park: <?php echo binary ($park); ?></p>
                    <p class="card-text">Assist other teams in climbing: <?php echo $assist_others; ?></p>
                  </div>
                </div>
                    <div class="card">
                      <h3 class="card-header primary-color white-text">Notes:</h3>
                      <div class="card-body">
                      <p class="card-text"><?php echo $notes; ?></p>
                    </div>
                  </div>
                </div>

</body>
</html>
