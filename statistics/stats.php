<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
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
					<li><a href="../pit/index.php">Pit Scouting</a></li>
					<li ><a href="../match/index.php">Match Scouting</a></li>
					<li class="active"><a href="stats.php">Statistics</a></li>
				</nav>
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
<form action="pit.php" method="post">
  <div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">Pit Scouting Data from team 1391:</div>
      <div class="panel-body">
        <div class="form-group col-md-12" style="text-align: center;">
          <label for="requestteam">Enter a team number below:</label>
          <input class="form-control" name="requestteam" type="number" autocomplete="off" required>
        </div>
        <div class="column col-12">
          <input class="btn btn-success btn-lg btn-block" type="submit" name="request" value="Find Team">
        </div>
      </form>
