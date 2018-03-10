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
	<title>Project Siller | Privacy Police</title>
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
					<h1>Privacy Policy</h1>
					<h2>Last Updated: 01/19/2018</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-privacy">
		<div class="container grid-lg text-center">
			<div class="columns">
				<div class="column col-12 privacy">
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
			</div>
		</div>
	</div>
	<?php require_once('../inc/dynamic/footer.php'); ?>
</body>
</html>