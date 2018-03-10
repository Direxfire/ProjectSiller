<?php
require('../../inc/initate.php');
if(isset($_GET['request'])) {
	$request = strip_tags(htmlentities($_GET['request']));
	switch($request) {
		case('1391'):
		require('1391.php');
		break;
		case('pitscouting'):
		require('pit.php');
		break;
	}
} else {
	require('1391.php');
}
