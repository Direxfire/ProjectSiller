<?php
session_start();
if(isset($_POST['position'])) {
	$_SESSION['position'] = $_POST['position'];
}
if(isset($_SESSION['position'])) {
	switch($_SESSION['position']) {
		case('red1'):
		$position = "Red 1";
		break;
		case('red2'):
		$position = "Red 2";
		break;
		case('red3'):
		$position = "Red 3";
		break;
		case('blue1'):
		$position = "Blue 1";
		break;
		case('blue2'):
		$position = "Blue 2";
		break;
		case('blue3'):
		$position = "Blue 3";
		break;
	}
	$clean = preg_replace('/[0-9]/','', $position);
	$clean = str_replace(' ', '', $clean);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Project Siller</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/css/please-wait.css">
	<link rel="stylesheet" href="../assets/css/pinkit.css">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/index.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../assests/css/jquery-ui.min.css">

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
			<div  	class="navbar-header">
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
					<li><a href="../pit">Pit Scouting</a></li>
					<li class="active"><a href="/">Match Scouting</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../statistics/1391">1391</a></li>
							<li><a href="../statistics/collaborative">Collaborative</a></li>
							<li><a href="../statistics/pitscouting">Pit Scouting</a></li>
						</ul>
					<li><form method="POST"><button class="btn btn-success navbar-btn" type="submit" name="change">Change Position</button></form></li>
				</ul>
			</div>
		</div>
	</nav>

	<?php
	if(isset($_POST['change'])) {
		unset($_SESSION['position']);
		header('Location: index.php');
	}
	if(!isset($_SESSION['position'])) {
		echo "<script type=\"text/javascript\">
		$(document).ready(function() {
			swal({
				title: 'Select Position',
				type: 'info',
				html:
				'Choose a position on the field to scout. You may change this later. <select class=\"form-control\" id=\"position\" autofocus required style=\"margin-top: 10px;\"><option value=\"red1\">Red 1</option><option value=\"red2\">Red 2</option><option value=\"red3\">Red 3</option><option value=\"blue1\">Blue 1</option><option value=\"blue2\">Blue 2</option><option value=\"blue3\">Blue 3</option></select> ".$_SESSION['position']."',
				confirmButtonColor: '#3fad46',
				confirmButtonText:
				'<input class=\"btn btn-success\" name=\"saveposition\"value=\"Save Position\" style=\"font-size: 20px;\">',
			}).then(function () {
				var e = document.getElementById(\"position\");
				var wantedposition = e.options[e.selectedIndex].text;
				var wantedposition_value = e.options[e.selectedIndex].value;
				$.post('index.php', { position: wantedposition_value });
				swal(
				'Position Set!',
				'Your position has been set to <b>' + wantedposition + '</b>',
				'success'
				).then(function () {
					location.reload();
				})
			})
		});
	</script>";
}
if(isset($_POST['submit'])) {
	// if($user -> admin($db_connect)) {
	$ghostcheck = $db_connect -> prepare("SELECT COUNT(*) FROM `matches_1391` WHERE `Match_Number` = :matchgiven AND `Team_Number` = :teamgiven");
	// } else {
		//$ghostcheck = $db_connect -> prepare("SELECT COUNT(*) FROM `matches_collab` WHERE `Match_Number` = :matchgiven AND `Team_Number` = :teamgiven");
	//}
	$ghostcheck -> execute(array(':matchgiven' => $_POST['matchnumber'], ':teamgiven' => $_POST['teamnumber']));
	$ghostresult = $ghostcheck -> fetchColumn(0);
	if($ghostresult < 1) {
		$totalgears = $_POST['gear_g1_success'] + $_POST['gear_g2_success'] + $_POST['gear_g3_success'] + $_POST['autongear'];
		//if($user -> admin($db_connect)) {
		$dontcrash = $db_connect -> prepare("INSERT INTO `matches_1391` VALUES (NULL, :scout_name, :scout_number, :match, :team, :color, :baseline, :autongear, :autongear_location, :autonhopper, :autonhopper_location, :autonfuel_low, :autonfuel_high, :teleopfuel_high_attempt, :teleopfuel_high_success, :teleopfuel_low_attempt, :teleopfuel_low_success, :teleopgear_chute_attempt, :teleopgear_chute_success, :teleopgear_ground_attempt, :teleopgear_ground_success, :gear_g1_attempt, :gear_g1_success, :gear_g2_attempt, :gear_g2_success, :gear_g3_attempt, :gear_g3_success, :acquirerope, :climbrope, :centerrope, :total_gears, :notes, :kpa)");
	// } else {
		//$dontcrash = $db_connect -> prepare("INSERT INTO `matches_collab` VALUES (NULL, :scout_name, :scout_number, :match, :team, :color, :baseline, :autongear, :autongear_location, :autonhopper, :autonhopper_location, :autonfuel_low, :autonfuel_high, :teleopfuel_high_attempt, :teleopfuel_high_success, :teleopfuel_low_attempt, :teleopfuel_low_success, :teleopgear_chute_attempt, :teleopgear_chute_success, :teleopgear_ground_attempt, :teleopgear_ground_success, :gear_g1_attempt, :gear_g1_success, :gear_g2_attempt, :gear_g2_success, :gear_g3_attempt, :gear_g3_success, :acquirerope, :climbrope, :centerrope, :total_gears, :notes, :kpa)");
	//}
		$dontcrash -> execute(array(':scout_name' => $_POST['scout_name'], ':scout_number' => $_POST['scout_number'], ':match' => $_POST['matchnumber'], ':team' => $_POST['teamnumber'], ':color' => $_POST['color'], ':baseline' => $_POST['baseline'], ':autongear' => $_POST['autongear'], ':autongear_location' => $_POST['autongear_location'], ':autonhopper' => $_POST['autonhopper'], ':autonhopper_location' => $_POST['autonhopper_location'], ':autonfuel_low' => $_POST['autonfuel_low'], ':autonfuel_high' => $_POST['autonfuel_high'], ':teleopfuel_high_attempt' => $_POST['teleopfuel_high_attempt'], ':teleopfuel_high_success' => $_POST['teleopfuel_high_success'], ':teleopfuel_low_attempt' => $_POST['teleopfuel_low_attempt'], ':teleopfuel_low_success' => $_POST['teleopfuel_low_success'], ':teleopgear_chute_attempt' => $_POST['teleopgear_chute_attempt'], ':teleopgear_chute_success' => $_POST['teleopgear_chute_success'], ':teleopgear_ground_attempt' => $_POST['teleopgear_ground_attempt'], ':teleopgear_ground_success' => $_POST['teleopgear_ground_success'], ':gear_g1_attempt' => $_POST['gear_g1_attempt'], ':gear_g1_success' => $_POST['gear_g1_success'], ':gear_g2_attempt' => $_POST['gear_g2_attempt'], ':gear_g2_success' => $_POST['gear_g2_success'], ':gear_g3_attempt' => $_POST['gear_g3_attempt'], ':gear_g3_success' => $_POST['gear_g3_success'], ':acquirerope' => $_POST['acquirerope'], ':climbrope' => $_POST['climbrope'], ':centerrope' => $_POST['centerrope'], ':total_gears' => $totalgears, ':notes' => $_POST['notes'], ':kpa' => $_POST['kpa']));
		echo "<script>
		$(document).ready(function() {
			swal(
			'Success!',
			'Data has been saved!',
			'success'
			);});</script>";
		} else {
			echo "<script>
			$(document).ready(function() {
				swal(
				'Error!',
				'Data already exists!',
				'error'
				);});</script>";
			}
		}
		?>
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading"> <h2 class="panel-title">Match Scouting <span class="pull-right">Position: <?php echo $position;?></h2></div>
				<div class="panel-body">
					<form method="POST">
						<div class="col-md-12">
							<div class="form-group col-md-6">
								<label for="scout_name">Scout Name</label>
								<input class="form-control" name="scout_name" type="text" autocomplete="off" required autofocus>
							</div>
							<div class="form-group col-md-6">
								<label for="scout_number">Scout Team Number</label>
								<input class="form-control" name="scout_number" type="number" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group col-md-4">
								<label for="matchnumber">Match Number</label>
								<input class="form-control" name="matchnumber" id="matchnumber" type="number" onchange="getTeam(this.value);" autocomplete="off" required>
							</div>
							<div class="form-group col-md-4">
								<label for="teamnumber">Team Number</label>
								<input class="form-control" name="teamnumber" id="teamnumber" type="number" readonly="readonly" autocomplete="off" required>
							</div>
							<div class="form-group col-md-4">
								<label for="color">Alliance Color</label>
								<input class="form-control" name="color" type="text" readonly="readonly" automcomplete="off" required value="<?php echo $clean; ?>">
							</div>
						</div>
						<div class="col-md-12">
							<h4 class="text-center underlined">Autonomous</h4>
							<div class="form-group col-md-4">
								<label for="autoline">Cross Autoline</label>
								<div class="radio" data-toggle="buttons">
									<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="auotline" value="1" required>Yes</label>
									<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="autoline" value="0" required>No</label>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label for="autoswitch">Place cube on Switch</label>
								<div class="radio" data-toggle="buttons">
									<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="autonswitch" value="1" required>Yes</label>
									<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="autonswitch" value="0" required>No</label>
								</div>
							</div>
							<div class="input-group" style="width:50%">
									               	<span class="input-group-btn">
									                  	<button class="btn btn-white btn-minuse" type="button">-</button>
									               	</span>
									               	<input type="text" class="form-control no-padding add-color text-center height-25" maxlength="3" value="0">
									               	<span class="input-group-btn">
									                  	<button class="btn btn-red btn-pluss" type="button">+</button>
									               	</span>
									            </div><!-- /input-group -->
							<div class="form-group col-md-3">
								<label for="autonscale">Place cube on Scale</label>
								<div class="radio" data-toggle="buttons">
									<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="autonscale" value="1" required>Yes</label>
									<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="autonscale" value="0" required>No</label>
								</div>
							</div>
						<div class="col-md-12">
							<h4 class="text-center underlined">Teleop</h4>
							<div class="form-group col-md-3">
								<label for="teleopfuel_offense_switch_fail">Offense Switch Fail</label>
								<div class="input-group">
									<span class="input-group-btn">
										<button type="button" class="btn btn-danger" onclick="offense_switch_fail_minus()"><span class="glyphicon glyphicon-minus"></span></button>
									</span>
									<input class="form-control" name="teleop_offense_switch_fail" id="offense_switch_fail" type="number" value="0" required>
									<span class="input-group-btn">
										<button type="button" class="btn btn-success" onclick="offense_switch_fail_plus()"><span class="glyphicon glyphicon-plus"></span></button>
									</span>
								</div>
							</div><div class="form-group col-md-3">
							<label for="teleop_offense_switch_success">Offense Switch Success</label>
							<div class="input-group">
								<span class="input-group-btn">
									<button type="button" class="btn btn-danger" onclick="offense_switch_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
								</span>
								<input class="form-control" name="teleop_switch_success" id="teleop_switch_Success" type="number" min="0" value="0" required>
								<span class="input-group-btn">
									<button type="button" class="btn btn-success" onclick="offense_switch_Success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
								</span>
							</div>
						</div><div class="form-group col-md-3">
						<label for="teleop_scale_fail">Scale Fail</label>
						<div class="input-group">
							<span class="input-group-btn">
								<button type="button" class="btn btn-danger" onclick="scale_fail_minus()"><span class="glyphicon glyphicon-minus"></span></button>
							</span>
							<input class="form-control" name="teleop_scale_fail" id="scale_fail" type="number" min="0" value="0" required>
							<span class="input-group-btn">
								<button type="button" class="btn btn-success" onclick="scale_success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
							</span>
						</div>
					</div><div class="form-group col-md-3">
					<label for="teleop_scale_success">Scale Success</label>
					<div class="input-group">
						<span class="input-group-btn">
							<button type="button" class="btn btn-danger" onclick="scale_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
						</span>
						<input class="form-control" name="teleop_scale_success" id="scale_success" type="number" min="0" value="0" required>
						<span class="input-group-btn">
							<button type="button" class="btn btn-success" onclick="scale_success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div>
				</div><div class="form-group col-md-3">
				<label for="teleop_defense_switch_fail">Defense Switch Fail</label>
				<div class="input-group">
					<span class="input-group-btn">
						<button type="button" class="btn btn-danger" onclick="defense_switch_minus()"><span class="glyphicon glyphicon-minus"></span></button>
					</span>
					<input class="form-control" name="teleopgear_chute_attempt" id="defense_switch" type="number" min="0" value="0" required>
					<span class="input-group-btn">
						<button type="button" class="btn btn-success" onclick="defense_switch_plus()"><span class="glyphicon glyphicon-plus"></span></button>
					</span>
				</div>
			</div><div class="form-group col-md-3">
			<label for="defense_switch_success">Defense Switch Success</label>
			<div class="input-group">
				<span class="input-group-btn">
					<button type="button" class="btn btn-danger" onclick="defense_switch_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
				</span>
				<input class="form-control" name="teleopgear_chute_success" id="defense_switch_success" type="number" min="0" value="0" required>
				<span class="input-group-btn">
					<button type="button" class="btn btn-success" onclick="defense_switch_success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
				</span>
			</div>
		</div><div class="form-group col-md-3">
		<label for="teleopcube_ground_fail">Ground Cube Fail</label>
		<div class="input-group">
			<span class="input-group-btn">
				<button type="button" class="btn btn-danger" onclick="cube_ground_fail_minus()"><span class="glyphicon glyphicon-minus"></span></button>
			</span>
			<input class="form-control" name="teleopgear_ground_attempt" id="cube_ground_fail" type="number" min="0" value="0" required>
			<span class="input-group-btn">
				<button type="button" class="btn btn-success" onclick="cube_ground_fail_plus()"><span class="glyphicon glyphicon-plus"></span></button>
			</span>
		</div>
	</div><div class="form-group col-md-3">
	<label for="teleopcube_ground_success">Ground Cube Success</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="button" class="btn btn-danger" onclick="cube_ground_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
		</span>
		<input class="form-control" name="teleopgear_ground_success" id="cube_ground_success" type="number" min="0" value="0" required>
		<span class="input-group-btn">
			<button type="button" class="btn btn-success" onclick="cube_ground_success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
		</span>
	</div>
</div>
<div class="form-group col-md-3">
	<label for="teleopcube_chute_fail">Chute Cube Fail</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="button" class="btn btn-danger" onclick="cube_chute_fail_minus()"><span class="glyphicon glyphicon-minus"></span></button>
		</span>
		<input class="form-control" name="teleopgear_ground_success" id="cube_chute_fail" type="number" min="0" value="0" required>
		<span class="input-group-btn">
			<button type="button" class="btn btn-success" onclick="cube_chute_fail_plus()"><span class="glyphicon glyphicon-plus"></span></button>
		</span>
	</div>
</div>
<div class="form-group col-md-3">
	<label for="teleopcube_chute_success">Chute Cube Success</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="button" class="btn btn-danger" onclick="cube_chute_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
		</span>
		<input class="form-control" name="teleopgear_ground_success" id="cube_chute_success" type="number" min="0" value="0" required>
		<span class="input-group-btn">
			<button type="button" class="btn btn-success" onclick="cube_chute_Success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
		</span>
	</div>
</div>
<div class="form-group col-md-3">
	<label for="teleopcube_exchange_fail">Exchange Cube Fail</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="button" class="btn btn-danger" onclick="cube_exchange_fail_minus()"><span class="glyphicon glyphicon-minus"></span></button>
		</span>
		<input class="form-control" name="teleopgear_ground_success" id="cube_exchange_fail" type="number" min="0" value="0" required>
		<span class="input-group-btn">
			<button type="button" class="btn btn-success" onclick="cube_exchange_fail_plus()"><span class="glyphicon glyphicon-plus"></span></button>
		</span>
	</div>
</div>
<div class="form-group col-md-3">
	<label for="teleopcube_exchange_success">Exchange Cube Success</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="button" class="btn btn-danger" onclick="cube_exchange_success_minus()"><span class="glyphicon glyphicon-minus"></span></button>
		</span>
		<input class="form-control" name="teleopgear_ground_success" id="cube_exchange_success" type="number" min="0" value="0" required>
		<span class="input-group-btn">
			<button type="button" class="btn btn-success" onclick="cube_exchange_success_plus()"><span class="glyphicon glyphicon-plus"></span></button>
		</span>
	</div>
</div>
<div class="col-md-12">
	<h4 class="text-center underlined">End Game</h4>
	<div class="col-md-3">
		<label for="grab_rung">Grab Rung</label>
		<div class="radio" data-toggle="buttons">
			<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="grab_rung" value="1" required>Yes</label>
			<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="grab_rung" value="0" required>No</label>
		</div>
	</div>
	<div class="col-md-3">
		<label for="climb">Climb</label>
		<div class="radio" data-toggle="buttons">
			<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="climb" value="1" required>Yes</label>
			<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="climb" value="0" required>No</label>
		</div>
	</div>
	<div class="col-md-3">
		<label for="userung">Use rung?</label>
		<div class="radio" data-toggle="buttons">
			<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="userung" value="1" required>Yes</label>
			<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="userung" value="0" required>No</label>
		</div>
	</div>
	<div class="col-md-3">
		<label for="levitate">Levitate?</label>
		<div class="radio" data-toggle="buttons">
			<label class="radio-inline btn btn-success sharespace"><input class="sr-only" type="radio" name="levitate" value="1" required>Yes</label>
			<label class="radio-inline btn btn-danger sharespace"><input class="sr-only" type="radio" name="levitate" value="0" required>No</label>
		</div>
<div class="col-md-12" style="margin-top: 20px;">
	<button class="btn btn-success btn-block" tpye="submit" name="submit">Submit</button>
</div>
</form>
</div>
</div>
</div>
<script>
$('.btn-minuse').on('click', function(){
	$(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) - 1)
})

$('.btn-pluss').on('click', function(){
	$(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) + 1)
})

</script>
<script src="/mobile.js"></script>
<script type="text/javascript" src="please-wait.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		if($.cookie('loading') == undefined || $.cookie('loading') == null) {
			window.loading_screen = window.pleaseWait({
				logo: "logo.svg",
				backgroundColor: '#AC1B1E',
				loadingHtml: "<p class='loading-message'>Project Siller<br>An online scouting platform for FIRST Robotics</p><div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>"
			});
			setTimeout(function() { window.loading_screen.finish();}, 3000);
			var date = new Date();
			date.setTime(date.getTime() + (5 * 60 * 1000));
			$.cookie("loading", "true", { expires: date });
		}
	});
</script>
</body>
</html>
