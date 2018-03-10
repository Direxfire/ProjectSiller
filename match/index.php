<?php
if ($_failed_entry == 1) {
	echo "<script>
	$(document).ready(function() {
		swal(
		'Success!',
		'Data has been saved!',
		'success'
		);});</script>";
	}
else{
	echo "<script>
	$(document).ready(function() {
		swal(
		'Error!',
		'Data already exists!',
		'error'
		);});</script>";
	}
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
	<link rel="stylesheet" href="../assets/css_old/please-wait.css">
	<link rel="stylesheet" href="../assets/css_old/pinkit.css">
	<link href="../assets/css_old/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css_old/index.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css_old/sweetalert2.min.css">
	<link rel="stylesheet" href="../assests/css_old/jquery-ui.min.css">

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
					<a href="https://siller.io/" class="docs-logo">
				<a class="navbar-brand" href="index.php">Project Siller</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../pit/index.php">Pit Scouting</a></li>
					<li class="active" ><a href="../match/index.php">Match Scouting</a></li>
					<li><a href="../statistics/stats.php">Statistics</a></li>
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

}s
		?>
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading"> <h2 class="panel-title">Match Scouting <span class="pull-right">Position: <?php echo $position;?></h2></div>
				<div class="panel-body">
					<form action="savedata.php" method="post">
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
								<input class="form-control" name="teamnumber" id="teamnumber" type="number"  autocomplete="off" required>
							</div>
							<div class="form-group col-md-4">
								<label for="color">Alliance Color</label>
								<input class="form-control" name="color" type="text" readonly="readonly" automcomplete="off" required value="<?php echo $clean; ?>">
							</div>
						</div>
						<div class="col-md-12">
							<h4 class="text-center underlined">Autonomous</h4>
								<!--Autonomous Input Forms from the Auto Folder-->
								<?php
								include ('auto/cross_autoline.shtml');
								include ('auto/auto_scale.shtml');
								include ('auto/auto_switch.shtml');
								?>
								<!-- Start of Teleop-->
								<div class="col-md-12">
								<h4 class="text-center underlined">Teleop</h4>
								<?php
								//Gaining points from holding this switch or scale_fail
								//Written in seperate files under teleop/offense
								include ('teleop/offense/switch_fail.shtml');
								include ('teleop/offense/switch_success.shtml');
								include ('teleop/offense/scale_fail.shtml');
								include ('teleop/offense/scale_success.shtml');
								//Loosing points from these, or returning the switch/scale
								//to nuetral possition
								include ('teleop/defense/switch_fail.shtml');
								include ('teleop/defense/switch_success.shtml');

								//Collecting Cubes, from ground and from Chute
								include ('teleop/cube/chute_fail.shtml');
								include ('teleop/cube/chute_success.shtml');
								include ('teleop/cube/ground_fail.shtml');
								include ('teleop/cube/ground_success.shtml');

								//Exchange Cubes
								include ('teleop/exchange/exchange_fail.shtml');
								include ('teleop/exchange/exchange_success.shtml');
								?>
							</div>
						</div>
						<div class="col-md-12">
								<h4 class="text-center underlined">End Game</h4>
								<?php
								//End game questions
								include ('endgame/assit_others.shtml');
								include ('endgame/climb_on_other_robot.shtml');
								include ('endgame/park.shtml');
								include ('endgame/climb.shtml');
								include ('endgame/rung.shtml');
								include ('endgame/levitate.shtml');
								 ?>
							 </div>
						 <div class="col-md-12" style="margin-top: 20px;">
							 <input class="btn btn-success btn-lg btn-block" type="submit" name="submit" value="Submit">
						 </div>
						 </form>

<script src="../assets/js/plus_minus_buttons.js"></script>
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
