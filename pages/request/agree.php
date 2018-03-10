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
<body id="request-agree">
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
						<li class="step-item active">
							<a href="#" class="tooltip" data-tooltip="Agree">Agree</a>
						</li>
						<li class="step-item">
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
	<div class="section section-agree">
		<div class="container grid-lg text-center">
			<div class="columns">
				<div class="column col-12">
					<h3>You <u class="text-primary">must</u> agree to the following Terms of Service &amp; Privacy Policy</h3>
				</div>
				<div class="column col-12 bg-gray agreements">
					<h3><u>Terms of Service</u></h3>
					<h4>General</h4>
					<ul>
						<li>Any violation of the Terms of Service will result in a termination of the account</li>
						<li>Siller.io reserves the right to deny access to anyone at anytime</li>
						<li>Siller.io reserves the right to terminate any account at anytime</li>
						<li>Siller.io reserves the right to change its Terms of Service at any given time without prior notice</li>
						<li>Siller.io will comply with any reasonable request from FIRST Robotics</li>
						<li>You acknowledge that Unity Networks LLC hosts, develops, and protects Siller.io's platform</li>
					</ul>
					<h4>Data</h4>
					<ul>
						<li>Any data uploaded to the platform is owned by Siller.io</li>
						<li>Siller.io does not validate the data users input onto the platform</li>
						<li>Siller.io has the right to publish any data it seems fit</li>
						<li>Siller.io reserves the right to determine who can access which data</li>
						<li>Siller.io has the final say in all data access policies</li>
					</ul>
					<h4>Use of Service</h4>
					<ul>
						<li>You may not use the service in anyway that violates or interferes FRC's official rules</li>
						<li>You may not use the service to harm anyone</li>
						<li>You will use this service at your own risk</li>
						<li>Siller.io is not responsible for any damage or lawsuit that may derive from the use of this service</li>
					</ul>
					<h4>Security</h4>
					<ul>
						<li>All security is handled by Unity Networks LLC</li>
						<li>All data collected and retained by Unity Networks LLC is encrypted</li>
						<li>All of Unity Networks LCC's data is kept and secured in Panama</li>
						<li>Unity Networks LLC operates several endpoints around the world</li>
						<li>Unity Networks LLC keeps encrypted backup of data</li>
						<li>Unity Networks LLC cannot and will not decrypt Siller.io's user data without their cooperation or consent</li>
						<li>Unity Networks LLC does not intercept and view passwords</li>
						<li>At no point will Unity Networks LLC sell or abuse data collected on Siller.io or any platform</li>
					</ul>
					<h4>Abuse</h4>
					<ul>
						<li>The following will result in the immediate termination of your team's entire account:</li>
						<ul>
							<li>Attempting to "hack" or disrupt the platform</li>
							<li>Attempting to manipulate data on the platform</li>
							<li>Attempting to gain an unfair advantage over other users on the platform</li>
						</ul>
						<li>Any bans performed by Unity Network's Firewalls will not be lifted</li>
					</ul>
					<h4>Legal Action</h4>
					<ul>
						<li>All final legal action will go through Unity Networks LLC</li>
						<li>Unity Networks LLC only recognizes the law of Panama and does not have a legal obligation to follow any law in any other country including the United States of America</li>
						<li>Unity Networks LLC does not comply to any DMCA requests</li>
						<li>Unity Networks LLC will only respond to subpoenas that are signed by a judge in Panama</li>
						<li>Unity Networks LLC reserves the right to deny any subpoenas that does not meet the requirement above</li>
					</ul>
				</div>
				<div class="column col-12 bg-gray agreements">
					<h3><u>Privacy Policy</u></h3>
					<h4>General</h4> 
					<ul>
						<li>Siller.io only collects data that is listed here</li>
						<li>Siller.io reserves the right to change its Privacy Policy at any given time without prior notice</li>
						<li>Siller.io is entirely hosted on Unity Networks LLC</li>
						<li>All data on Siller.io is hosted and secured by Unity Networks LLC</li>
						<li>Siller.io or Unity Networks LLC does not any user data</li>
						<li>At the time of this writing, Unity Networks LLC is currently storing all Siller.io's data in Panama</li>
					</ul>
					<h4>Identifying Information</h4>
					<ul>
						<li>When you visit or use our platform, the following is collected by Unity Networks LLC:</li>
						<ul>
							<li>IP Address</li>
							<li>User Agent</li>
							<li>Requested URL &amp; URI</li>
							<li>Source</li>
						</ul>
					</ul>
					<h4>Accounts</h4>
					<ul>
						<li>The following information is collected on accounts:</li>
						<ul>
							<li>Basic Information given by User</li>
							<li>Registered IP Address</li>
							<li>Last Known IP Address</li>
						</ul>
					</ul>
					<h4>Legal Actions</h4>
					<ul>
						<li>All final legal action will go through Unity Networks LLC</li>
						<li>Unity Networks LLC only recognizes the law of Panama and does not have a legal obligation to follow any law in any other country including the United States of America</li>
						<li>Unity Networks LLC does not comply to any DMCA requests</li>
						<li>Unity Networks LLC will only respond to subpoenas that are signed by a judge in Panama</li>
						<li>Unity Networks LLC reserves the right to deny any subpoenas that does not meet the requirement above</li>
					</ul>
				</div>
				<div class="column col-12 col-xs-12 buttons">
					<button class="btn btn-success" onclick="agree();">I Agree &amp; Understand</button>
					<button class="btn btn-error" onclick="disagree();">I Disagree</button>
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
	function agree() {
		Cookies.set('progress', '2', { domain: 'siller.io', path: '/request', 'secure': true });
		window.location.reload();
	}

	function disagree() {
		swal({
			title: 'Are you sure?',
			text: "You need to agree to the Terms of Service & Privacy Policy in order to use Siller.io",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, I\'m sure!'
		}).then((result) => {
			if (result.value) {
				window.location.href = "https://siller.io";
			}
		})
	}
</script>
</body>
</html>