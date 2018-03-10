<?php
if (__FILE__ == realpath($_SERVER['SCRIPT_FILENAME'])) {
	http_response_code(404);
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Project Siller | Request Access</title>
	<?php require_once('../inc/dynamic/header.php'); ?>
	<link rel="stylesheet" href="https://siller.io/assets/css/guest.css">
</head>
<body id="request-information">
	<div class="section section-hero bg-gray">
		<div class="grid-hero container grid-lg text-center">
			<div class="docs-brand">
				<a href="https://siller.io" class="docs-logo">
					<img src="https://siller.io/assets/image/logo.png" alt="Siller.io Logo">
					<h2>Project Siller</h2>
				</a>
			</div>
			<div class="columns">
				<div class="column col-12">
					<h1>Request Early Beta Access</h1>
				</div>
				<div class="column col-12">
					<ul class="step">
						<li class="step-item">
							<a href="#" class="tooltip" data-tooltip="Agree">Agree</a>
						</li>
						<li class="step-item active">
							<a href="#" class="tooltip" data-tooltip="Information">Information</a>
						</li>
						<li class="step-item">
							<a href="#" class="tooltip" data-tooltip="Verify">Verify</a>
						</li>
						<li class="step-item">
							<a href="#" class="tooltip" data-tooltip="Submit">Submit</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-information">
		<div class="container grid-lg">
			<div class="columns">
				<div class="column col-12 text-center mt-2">
					<h3>Please fill out the following information</h3>
					<p class="text-bold text-error">* Required Fields</p>
				</div>
				<div class="column col-12">
					<form method="POST" onsubmit="return validate();" id="information">
						<div class="columns">
							<div class="form-group column col-4 col-xs-12">
								<label class="form-label" for="name">Name<span class="text-error">*</span></label>
								<input class="form-input" type="text" id="name" placeholder="Full Name" required autocomplete="off" autofocus>
							</div>
							<div class="form-group column col-4 col-xs-12">
								<label class="form-label" for="team_number">Team Number<span class="text-error">*</span></label>
								<div class="input-group">
									<span class="input-group-addon">Team</span>
									<input class="form-input" type="text" min="0" maxlength="4" id="team_number" placeholder="FRC Team Number" required autocomplete="off">
								</div>
							</div>
							<div class="form-group column col-4 col-xs-12">
								<label class="form-label" for="team_name">Team Name<span class="text-error">*</span></label>
								<input class="form-input" type="text" id="team_name" placeholder="FRC Team Name" required autocomplete="off">
							</div>
							<div class="form-group column col-6 col-xs-12">
								<label class="form-label" for="team_role">Team Role<span class="text-error">*</span></label>
								<select class="form-select" id="team_role" required>
									<option value="0">Choose an option</option>
									<option value="1" >Alumni</option>
									<option value="2" >Animator</option>
									<option value="3" >CAD</option>
									<option value="4" >Coach</option>
									<option value="5" >College Student</option>
									<option value="6" >Communications</option>
									<option value="7" >Driver</option>
									<option value="8" >Electrical</option>
									<option value="9" >Engineer</option>
									<option value="10" >Human Player</option>
									<option value="11" >Leadership</option>
									<option value="12" >Marketing</option>
									<option value="13" >Mascot</option>
									<option value="14" >Mechanical</option>
									<option value="15" >Mentor</option>
									<option value="16" >Operator</option>
									<option value="17" >Parent</option>
									<option value="18" >Photography</option>
									<option value="19" >Programmer</option>
									<option value="20" >RoboCoach</option>
									<option value="21" >Scout</option>
									<option value="22" >Student</option>
									<option value="23" >Tactician</option>
									<option value="24" >Teacher</option>
									<option value="25" >Team Spirit / Cheering</option>
									<option value="26" >Webmaster</option>
								</select>
							</div>
							<div class="form-group column col-6 col-xs-12">
								<label class="form-label" for="team_member">Number of Team Members<span class="text-error">*</span></label>
								<input class="form-input" type="number" id="team_member" min="1" placeholder="Total Number of Members" required autocomplete="off">
							</div>
							<div class="form-group column col-6 col-xs-12">
								<label class="form-label" for="about">How did you hear about us?<span class="text-error">*</span></label>
								<select class="form-select" id="about" required>
									<option value="0">Choose an option</option>
									<option value="1">Google</option>
									<option value="2">Chief Delphi</option>
									<option value="3">Another FRC Team (Please Specify)</option>
									<option value="4">Other</option>
								</select>
							</div>
							<div class="form-group column col-6 col-xs-12">
								<label class="form-label" for="about_other">Other (Specify)</label>
								<input class="form-input" type="text" id="about_other" placeholder="Specify If Necessary" autocomplete="off">
							</div>
							<div class="form-group column col-12">
								<label class="form-label" for="expectation">What do you want to see from Project Siller? (<span id="maxlength">100</span> Characters Left)</label>
								<textarea class="form-input" id="expectation" placeholder="Short Description" rows="3" maxlength="100" onkeyup="countChar(this)"></textarea>
							</div>
							<div class="form-group column col-12">
								<button class="btn btn-lg btn-block btn-primary" type="submit" id="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once('../inc/dynamic/footer.php'); ?>
<script src="https://siller.io/assets/javascript/jquery.min.js"></script>
<script src="https://siller.io/assets/javascript/js.cookie.js"></script>
<script src="https://siller.io/assets/javascript/sweetalert2.all.min.js"></script>
<script src="https://siller.io/assets/javascript/core.js"></script>
<script>
	function countChar(val) {
		var len = val.value.length;
		if (len > 100) {
			val.value = val.value.substring(0, 100);
		} else {
			$('#maxlength').text(100 - len);
		}
	};

	function lightsOff(choice) {
		if(choice == 'disabled') {
			$('#submit').addClass('loading disabled');
			$('#information input').prop('disabled', true);
			$('#information select').prop('disabled', true);
			$('#information textarea').prop('disabled', true);
			$('#information div').removeClass('has-error');
			$('.form-input-hint').remove();
		} else {
			$('#submit').removeClass('loading disabled');
			$('#information input').prop('disabled', false);
			$('#information select').prop('disabled', false);
			$('#information textarea').prop('disabled', false);
		}
	}

	function errorShow(div, message) {
		if(div == '#team_number') {
			$(div).parent().parent().addClass('has-error');
			$(div).parent().parent().append('<p class="form-input-hint">' + message + '</p>');
		} else {
			$(div).parent().addClass('has-error');
			$(div).parent().append('<p class="form-input-hint">' + message + '</p>');
		}
	}

	function finalSubmit(team_name_final) {
		$.ajax ({
			url: 'https://siller.io/request/submit',
			method: 'POST',
			data: {
				name: $('#name').val(),
				team_number: $('#team_number').val().trim(),
				team_name: team_name_final,
				team_role: $('#team_role').val().trim(),
				team_member: $('#team_role').val().trim(),
				about: $('#about').val().trim(),
				about_other: $('#about_other').val(),
				expectation: $('#expectation').val(),
				csrf: '<?php echo $_SESSION["csrf"]?>'
			},
			datatype: 'json',
			success: function(response) {
				if(response.hasOwnProperty('Message')) {
					if(response['Message'] === 'Success') {
						Cookies.set('progress', '3', { domain: 'siller.io', path: '/request', 'secure': true });
						window.location.reload();
					} else {
						swal('API Error!', 'Please try reloading and trying again! If this continues, contact support.', 'error');
						lightsOff('enabled');
						event.preventDefault();
					}
				} else {
					swal('API Error!', 'Please try reloading and trying again! If this continues, contact support.', 'error');
					lightsOff('enabled');
					event.preventDefault();
				}
			},
			error: function() {
				swal('API Error!', 'Please try reloading and trying again! If this continues, contact support.', 'error');
				lightsOff('enabled');
				event.preventDefault();
			}
		});
	}

	function validate() {
		lightsOff('disabled');
		var error = false;
		if(!$('#name').val().match(/\b([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[ -\']{1}[A-Z]{1}[a-z]{1,30}){2,5}/)) {
			errorShow('#name', 'Name format is incorrect. Make sure to captilize your name!');
			lightsOff('enabled');
			error = true;
		}
		if(!$('#team_number').val().match(/^\d+$/)) {
			errorShow('#team_number', 'Team Number must be numeric.');
			lightsOff('enabled');
			error = true;
		}
		if($('#team_role').val() == '0') {
			errorShow('#team_role', 'Option is not valid!');
			lightsOff('enabled');
			error = true;
		}
		if($('#about').val() == '0') {
			errorShow('#about', 'Option is not valid!');
			lightsOff('enabled');
			error = true;
		}
		if($('#about').val() == '4' || $('#about').val() == '3') {
			if($('#about_other').val() == '') {
				errorShow('#about_other', 'Please specify!');
				lightsOff('enabled');
				error = true;
			}
		}
		if(error == false) {
			$.ajax ({
				url: 'https://siller.io/request/validation',
				method: 'POST',
				data: {
					team: $('#team_number').val().trim(),
					csrf: '<?php echo $_SESSION["csrf"]?>'
				},
				datatype: 'json',
				success: function(response) {
					if(response.hasOwnProperty('Message')) {
						if(response['Message'] === 'Success' && response.hasOwnProperty('Nickname')) {
							if($('#team_name').val() !== response['Nickname']) {
								swal({
									title: 'Are you sure?',
									text: 'The team name on Blue Alliance is different from the one entered. The name on Blue Alliance is ' + response['Nickname'] + '. Would you like to change it?',
									type: 'warning',
									showCancelButton: true,
									confirmButtonText: 'Yes, change it!',
									cancelButtonText: 'No, leave it!'
								}).then((result) => {
									if (result.value) {
										swal({
											title: 'Team Name Changed!',
											text: 'Team name has been changed to ' + response['Nickname'] + '!',
											type: 'success'
										}).then((result) => {
											finalSubmit(response['Nickname']);
										});
									} else if (result.dismiss === 'cancel') {
										swal({
											title: 'Team Name Not Altered!',
											text: 'Your team name is still ' + $('#team_name').val() +'!',
											type: 'info'
										}).then((result) => {
											finalSubmit($('#team_name').val());
										});
									}
								});
							} else {
								finalSubmit($('#team_name').val());
							}
						} else {
							if(response.hasOwnProperty('Reason')) {
								errorShow('#team_number', response['Reason']);
							} else {
								errorShow('#team_number', 'Team number is not valid!');
							}
							lightsOff('enabled');
							event.preventDefault();
						}
					} else {
						swal('API Error!', 'Please try reloading and trying again! If this continues, contact support.', 'error');
						lightsOff('enabled');
						event.preventDefault();
					}
				},
				error: function() {
					swal('API Error!', 'Please try reloading and trying again! If this continues, contact support.', 'error');
					lightsOff('enabled');
					event.preventDefault();
				}
			});
		}
		return false;
	}
</script>
</body>
</html>
