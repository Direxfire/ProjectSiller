<?php
if (__FILE__ == realpath($_SERVER['SCRIPT_FILENAME'])) {
	http_response_code(404);
	die();
}

function verify($resp, $provider) {
	if(isset($resp[0]['type'])) {
		return true;
	} else {
		return false;
	}
}


$methods = array();

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://www.thebluealliance.com/api/v3/team/frc'.$_SESSION['team_number'].'/social_media',
	CURLOPT_USERAGENT => 'Project Siller',
	CURLOPT_HTTPHEADER => array('X-TBA-Auth-Key: FP8EuLi1ASK3GKlXqHhUZFunb8CRJHP2ZRW6AVDyI2J5WyDeiVTw8MBR8SZhutHx')
));
$resp = curl_exec($curl);
curl_close($curl);
$resp = json_decode($resp, true);
if(isset($resp['Errors'][0]['team_id'])) {
	unset($_COOKIE['progress']);
	header('Location: https://siller.io');
	die();
} elseif(isset($_SESSION['oauth'], $_SESSION['oauth-detail'])) {
	// Oauth complete, check value
	switch($_SESSION['oauth']) {
		case('github'):
		if(verify($resp, 'gitub-profile')) {
			$array_key = array_search('github-profile', $resp);
			if($resp[$array_key]['foreign_key'] === $_SESSION['oauth-detail']) {
				$verification = true;
			} else {
				$verification = false;
				if(isset($resp[0]['type'])) {
					foreach($resp as $key => $data) {
						array_push($methods, $data['type']);
					}
				}
			}
		} else {
			unset($_SESSION['oauth']);
			unset($_SESSION['oauth-detail']);
		}
		break;
		case('twitter'):
		if(verify($resp, 'twitter-profile')) {
			$array_key = array_search('twitter-profile', $resp);
			// if($resp[$array_key]['foreign_key'] === $_SESSION['oauth-detail']) {
			if('unitynet' === $_SESSION['oauth-detail']) {
				$verification = true;
			} else {
				$verification = false;
				if(isset($resp[0]['type'])) {
					foreach($resp as $key => $data) {
						array_push($methods, $data['type']);
					}
				}
			}
		} else {
			unset($_SESSION['oauth']);
			unset($_SESSION['oauth-detail']);
		}
		break;
		default:
		unset($_SESSION['oauth']);
		unset($_SESSION['oauth-detail']);
	}
} else {
	if(isset($resp[0]['type'])) {
		foreach($resp as $key => $data) {
			array_push($methods, $data['type']);
		}
	}
}

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://www.thebluealliance.com/api/v3/team/frc'.$_SESSION['team_number'],
	CURLOPT_USERAGENT => 'Project Siller',
	CURLOPT_HTTPHEADER => array('X-TBA-Auth-Key: FP8EuLi1ASK3GKlXqHhUZFunb8CRJHP2ZRW6AVDyI2J5WyDeiVTw8MBR8SZhutHx')
));
$resp = curl_exec($curl);
curl_close($curl);
$resp = json_decode($resp, true);
if(isset($resp['Errors'][0]['team_id'])) {
	unset($_COOKIE['progress']);
	header('Location: https://siller.io');
	die();
} else {
	if(isset($resp['website'])) {
		$full_domain = $resp['website'];
		$domain = str_replace('www.', '', parse_url($resp['website'])['host']);
		array_push($methods, 'domain');
		$code = md5(uniqid(rand(), TRUE));
		$_SESSION['domain_code'] = $code;
	}
}

function ghost($type, $methods) {
	if(!in_array($type, $methods)) {
		return false;
	} else {
		return true;
	}
}

$github = $service->getProvider('github');
$twitter = $service->getProvider('twitter');
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
<body id="request-verification">
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
						<li class="step-item">
							<a href="#" class="tooltip" data-tooltip="Information">Information</a>
						</li>
						<li class="step-item active">
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
	<div class="section section-verification">
		<div class="container grid-lg">
			<div class="columns">
				<div class="column col-12 text-center mt-2">
					<h3>Please choose one of the options below to verify yourself</h3>
					<p class="text-bold">Data collected from Blue Alliance API</p>
				</div>
				<div class="column col-12">
					<div class="columns">
						<div class="column col-4 col-xs-12 form-group">
							<button class="btn btn-primary btn-lg btn-block options" id="facebook" disabled><i class="zmdi zmdi-facebook-box zmdi-hc-3x"></i><br><i class="icofont icofont-disabled"></i>Disabled</button>
						</div>
						<div class="column col-4 col-xs-12 form-group">
							<?php if(ghost('github-profile', $methods)) { ?>
							<a href="<?php echo $github->makeAuthUrl(); ?>"><button class="btn bg-dark btn-lg btn-block options" id="github"><i class="zmdi zmdi-github zmdi-hc-3x"></i><br>Github</button></a>
							<?php } else { ?>
							<button class="btn bg-dark btn-lg btn-block options" id="github" disabled><i class="zmdi zmdi-github zmdi-hc-3x"></i><br>Github</button>
							<?php } ?>
						</div>
						<div class="column col-4 col-xs-12 form-group">
							<button class="btn bg-dark btn-lg btn-block options" id="instagram" disabled><i class="zmdi zmdi-instagram zmdi-hc-3x"></i><br>Disabled</button>
						</div>
						<div class="column col-12 mt-2"></div>
						<div class="column col-4 col-xs-12 form-group">
							<?php if(ghost('twitter-profile', $methods)) { ?>
							<a href="<?php echo $twitter->makeAuthUrl(); ?>"><button class="btn bg-dark btn-lg btn-block options" id="twitter"><i class="zmdi zmdi-twitter zmdi-hc-3x"></i><br>Twitter</button></a>
							<?php } else { ?>
							<button class="btn bg-dark btn-lg btn-block options" id="twitter" disabled><i class="zmdi zmdi-twitter zmdi-hc-3x"></i><br>Twitter</button>
							<?php } ?>
						</div>
						<div class="column col-4 col-xs-12 form-group">
							<button class="btn bg-dark btn-primary btn-lg btn-block options" id="youtube" disabled><i class="zmdi zmdi-youtube-play zmdi-hc-3x"></i><br>Disabled</button>
						</div>
						<div class="column col-4 col-xs-12 form-group">
							<?php if(ghost('domain', $methods)) { ?>
							<a href="#domainModal"><button class="btn bg-dark btn-primary btn-lg btn-block options" id="domain"><i class="zmdi zmdi-dns zmdi-hc-3x"></i><br>Domain</button></a>
							<div class="modal" id="domainModal">
								<a href="#close" class="modal-overlay" aria-label="Close"></a>
								<div class="modal-container">
									<div class="modal-header">
										<a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
										<div class="modal-title h5">
											Domain Verification<br><span class="h6">Please make sure your domain is: <span class="text-primary"><?php echo $domain; ?></span></span>
										</div>
									</div>
									<div class="modal-body">
										<div class="content">
											<div class="filter">
												<input type="radio" id="tag-0" class="filter-tag" name="filter-radio" hidden>
												<input type="radio" id="tag-1" class="filter-tag" name="filter-radio" hidden checked>
												<input type="radio" id="tag-2" class="filter-tag" name="filter-radio" hidden>
												<p class="text-bold">Please choose an option below to get started</p>
												<div class="filter-nav">
													<label class="chip" for="tag-1">DNS Verification</label>
													<label class="chip" for="tag-2">HTML File</label>
												</div>
												<div class="filter-body">
													<div class="filter-item card" data-tag="tag-1">
														<ol>
															<li>Login to DNS Manager</li>
															<li>Create a new TXT record</li>
															<li>Set <span class="text-bold">Name/Host/Alias</span> to <span class="text-primary text-bold">"@"</span></li>
															<li>Set <span class="text-bold">Value/Answer/Destination</span> to <span class="text-primary text-bold">"siller-verification=<?php echo $code;?>"</span></li>
															<li>Set <span class="text-bold">TTL</span> to <span class="text-primary text-bold">"86400"</span> or <span class="text-primary text-bold">default</span></li>
															<li>Save the record</li>
															<li><span class="text-primary text-bold">Click "Verify Domain" to continue!</span></li>
														</ol>
														<p class="text-bold">Note: This may take up to 24 hours depending on your DNS provider</p>
														<div class="modal-footer">
															<button class="btn btn-success" onclick="dns();">Verify Domain</button>
														</div>
													</div>
													<div class="filter-item card" data-tag="tag-2">
														<ol>
															<li>Create a new HTML file in your website root directory named <br><span class="text-primary text-bold">"siller-verification.html"</span></li>
															<li>Put the following code in:</li>
															<pre class="code" data-lang="HTML"><code><?php echo $code; ?></code></pre>
															<li>Save the file</li>
															<li>Make sure you can access it using the link: <a class="text-primary text-bold" href="<?php echo $full_domain.'/siller-verification.html'; ?>" target="_blank"><?php echo $full_domain.'/siller-verification.html'; ?></a></li>
															<li>If you cannot access the link above, check your file permissions. Otherwise <span class="text-primary text-bold">click "Verify HTML File"</span>!</li>
														</ol>
														<p class="text-bold">Note: You may delete the file after verification</p>
														<div class="modal-footer">
															<button class="btn btn-success" onclick="html();">Verify HTML File</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } else { ?>
							<button class="btn bg-dark btn-primary btn-lg btn-block options" id="domain" disabled><i class="zmdi zmdi-dns zmdi-hc-3x"></i><br>Domain</button>
							<?php } ?>
						</div>
						<div class="column col-12 col-xs-12 form-group">
							<a href="#manualModal"><button class="btn bg-dark btn-primary btn-lg btn-block options" id="manual"><i class="zmdi zmdi-shield-check zmdi-hc-1x"></i> Manual Verification</button></a>
						</div>
						<div class="modal modal-lg" id="manualModal">
							<a href="#close" class="modal-overlay" aria-label="Close"></a>
							<div class="modal-container">
								<div class="modal-header">
									<a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
									<div class="modal-title h5">
										Manual Verification<br><span class="h6 text-error">Please only use this option if all other methods are unavailable</span>
									</div>
								</div>
								<div class="modal-body">
									<div class="content">
										<p class="text-bold">Check the information below before submitting</p>
										<form method="POST" onsubmit="return validate();" id="manualInformation">
											<div class="columns">
												<div class="form-group column col-4 col-xs-12">
													<label class="form-label" for="name">Name<span class="text-error">*</span></label>
													<input class="form-input" type="text" id="name" placeholder="Full Name" required autocomplete="off" autofocus value="<?php echo $_SESSION['name']; ?>">
												</div>
												<div class="form-group column col-4 col-xs-12">
													<label class="form-label" for="team_number">Team Number<span class="text-error">*</span></label>
													<div class="input-group">
														<span class="input-group-addon">Team</span>
														<input class="form-input" type="text" min="0" maxlength="4" id="team_number" placeholder="FRC Team Number" required autocomplete="off" value="<?php echo $_SESSION['team_number']; ?>">
													</div>
												</div>
												<div class="form-group column col-4 col-xs-12">
													<label class="form-label" for="team_name">Team Name<span class="text-error">*</span></label>
													<input class="form-input" type="text" id="team_name" placeholder="FRC Team Name" required autocomplete="off" value="<?php echo $_SESSION['team_name']; ?>">
												</div>
												<div class="form-group column col-6 col-xs-12">
													<label class="form-label" for="team_role">Team Role<span class="text-error">*</span></label>
													<select class="form-select" id="team_role" required>
														<?php
														$possible = array('Alumni','Animator','CAD','Coach','College Student','Communications','Driver','Electrical','Engineer','Human Player','Leadership','Marketing','Mascot','Mechanical','Mentor','Operator','Parent','Photography','Programmer','RoboCoach','Scout','Student','Tactician','Teacher','Team Spirit / Cheering','Wemaster');
														for($i = 1; $i < 26; $i++) {
															if($i == $_SESSION['team_role']) {
																echo '<option value="'.$i.'" selected>'.$possible[$i-1].'</option>';
															} else {
																echo '<option value="'.$i.'">'.$possible[$i-1].'</option>';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group column col-6 col-xs-12">
													<label class="form-label" for="team_member">Number of Team Members<span class="text-error">*</span></label>
													<input class="form-input" type="number" id="team_member" min="1" placeholder="Total Number of Members" required autocomplete="off" value="<?php echo $_SESSION['team_member']; ?>">
												</div>
												<div class="form-group column col-6 col-xs-12">
													<label class="form-label" for="about">How did you hear about us?<span class="text-error">*</span></label>
													<select class="form-select" id="about" required>
														<?php
														$possible = array('Google', 'Chief Delphi', 'Another FRC Team (Please Specify)', 'Other');
														for($i = 1; $i < 4; $i++) {
															if($i == $_SESSION['about']) {
																echo '<option value="'.$i.'" selected>'.$possible[$i-1].'</option>';
															} else {
																echo '<option value="'.$i.'">'.$possible[$i-1].'</option>';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group column col-6 col-xs-12">
													<label class="form-label" for="about_other">Other (Specify)</label>
													<input class="form-input" type="text" id="about_other" placeholder="Specify If Necessary" autocomplete="off" value="<?php echo $_SESSION['about_other']; ?>">
												</div>
												<div class="form-group column col-12">
													<label class="form-label" for="expectation">What do you want to see from Project Siller? (<span id="maxlength"><?php echo 100 - strlen($_SESSION['expectation']); ?></span> Characters Left)</label>
													<textarea class="form-input" id="expectation" placeholder="Short Description" rows="3" maxlength="100" onkeyup="countChar(this)"><?php echo $_SESSION['expectation']; ?></textarea>
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
				</div>
			</div>
		</div>
	</div>
	<?php require_once('../inc/dynamic/footer.php'); ?>
	<script src="https://cdn.auth0.com/js/auth0/9.0.1/auth0.min.js"></script>
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
				$('#manualInformation input').prop('disabled', true);
				$('#manualInformation select').prop('disabled', true);
				$('#manualInformation textarea').prop('disabled', true);
				$('#manualInformation div').removeClass('has-error');
				$('.form-input-hint').remove();
			} else {
				$('#submit').removeClass('loading disabled');
				$('#manualInformation input').prop('disabled', false);
				$('#manualInformation select').prop('disabled', false);
				$('#manualInformation textarea').prop('disabled', false);
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
				url: 'https://siller.io/request/manual/submit',
				method: 'POST',
				data: {
					name: $('#name').val(),
					team_number: $('#team_number').val().trim(),
					team_name: team_name_final,
					team_role: $('#team_role').val().trim(),
					team_member: $('#team_member').val().trim(),
					about: $('#about').val().trim(),
					about_other: $('#about_other').val(),
					expectation: $('#expectation').val(),
					csrf: '<?php echo $_SESSION["csrf"]?>'
				},
				datatype: 'json',
				success: function(response) {
					if(response.hasOwnProperty('Message')) {
						if(response['Message'] === 'Success') {
							Cookies.set('progress', '4', { domain: 'siller.io', path: '/request', 'secure': true });
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
					url: 'https://siller.io/request/manual/validation',
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
								errorShow('#team_number', 'Team number is not valid!');
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
	<?php if(ghost('domain', $methods)) { ?>
	<script>
		function domainFinish() {
			Cookies.set('progress', '4', { domain: 'siller.io', path: '/request', 'secure': true });
			window.location.reload();
		}

		function dns() {
			swal({
				title: 'Verify Domain Name',
				text: 'Is <?php echo $domain; ?> the correct domain?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes it is',
				cancelButtonText: 'No it is not'
			}).then((result) => {
				if (result.value) {
					swal({
						title: 'Are you ready?',
						confirmButtonText: 'Request Confirmation',
						text:'Our system will query DNS records for your domain',
						showCancelButton: false,
						showLoaderOnConfirm: true,
						preConfirm: () => {
							return new Promise((resolve) => {
								return $.get('https://siller.io/request/domain/dns?domain=<?php echo $domain; ?>&csrf=<?php echo $_SESSION['csrf'];?>', function(data) {
									if(data.Message == 'Success') {
										swal({
											title: 'Verification Successful',
											text: 'Click the button below to continue!',
											type: 'success',
										}).then((result) => {
											domainFinish();
										})
									} else {
										swal({
											title: 'Verification Failed!',
											text: 'Our system failed to detect the correct DNS records',
											type: 'error'
										})
									}
								})
								resolve()
							})
						},
						allowOutsideClick: () => !swal.isLoading()
					});
				} else if (result.dismiss === 'cancel') {
					swal({
						title: 'Verification Failed!',
						text: 'Please choose another method for verification or click "Manual Verification"',
						type: 'error'
					});
				}
			});
		}

		function html() {
			swal({
				title: 'Verify Domain Name',
				text: 'Is <?php echo $domain; ?> the correct domain?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes it is',
				cancelButtonText: 'No it is not'
			}).then((result) => {
				if (result.value) {
					swal({
						title: 'Are you ready?',
						confirmButtonText: 'Request Confirmation',
						text:'Our bot will visit your website to verify the verification code exists',
						showCancelButton: false,
						showLoaderOnConfirm: true,
						preConfirm: () => {
							return new Promise((resolve) => {
								return $.get('https://siller.io/request/domain/html?domain=<?php echo $domain; ?>&csrf=<?php echo $_SESSION['csrf'];?>', function(data) {
									if(data.Message == 'Success') {
										swal({
											title: 'Verification Successful',
											text: 'Click the button below to continue!',
											type: 'success',
										}).then((result) => {
											domainFinish();
										})
									} else {
										swal({
											title: 'Verification Failed!',
											text: 'Our system failed to detect the correct verification code',
											type: 'error'
										})
									}
								})
								resolve()
							})
						},
						allowOutsideClick: () => !swal.isLoading()
					});
				} else if (result.dismiss === 'cancel') {
					swal({
						title: 'Verification Failed!',
						text: 'Please choose another method for verification or click "Manual Verification"',
						type: 'error'
					});
				}
			});
		}
	</script>
	<?php } if(isset($verification)) { if($verification === true) { ?>
	<script>
		function next() {
			Cookies.set('progress', '4', { domain: 'siller.io', path: '/request', 'secure': true });
			window.location.reload();
		}

		$(document).ready(function() {
			swal({
				title: 'Verification Successful!',
				text: 'Your profile has been successfully identified. Please click "ok" to continue!',
				type: 'success',
				onClose: next()
			});
		});
	</script>
	<?php } else { ?>
	<script>
		$(document).ready(function() {
			swal({
				title: '<?php echo ucfirst($_SESSION['oauth']); ?> Verification Failed!',
				text: "The information provided by The Blue Alliance didn't match your profile. Please try another option!",
				type: 'error'
			});
		});
	</script>
	<?php } } ?>
</body>
</html>
