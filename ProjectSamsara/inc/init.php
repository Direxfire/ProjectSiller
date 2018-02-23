<?php
date_default_timezone_set('America/New_York');
require('db.php');
require('functions.php');
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
$user = new user;
?>
