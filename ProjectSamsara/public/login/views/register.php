<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- register form -->
<form method="post" action="register.php" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body>
      <div class="container">
              <div class="row centered-form">
              <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
              	<div class="panel panel-default">
              		<div class="panel-heading">
      			    		<h3 class="panel-title">Register for Project Siller</h3>
      			 			</div>
      			 			<div class="panel-body">
      			    		<form role="form">
      			    			<div class="row">
      			    				<div class="col-xs-6 col-sm-6 col-md-6">
      			    					<div class="form-group">
      			                <input type="number" name="user_name" id="login_input_username" class="form-control input-sm" placeholder="Team Name" required >
      			    					</div>
      			    				</div>
      			    			</div>

      			    			<div class="form-group">
      			    				<input type="email" name="user_email" id="email" class="form-control input-sm" placeholder="Email Address">
      			    			</div>

      			    			<div class="row">
      			    				<div class="col-xs-6 col-sm-6 col-md-6">
      			    					<div class="form-group">
      			    						<input type="password" name="user_password_new" id="login_input_password_new" class="form-control input-sm" placeholder="Password" pattern=".{6,}" required autocomplete="off">
      			    					</div>
      			    				</div>
      			    				<div class="col-xs-6 col-sm-6 col-md-6">
      			    					<div class="form-group">
      			    						<input type="password" name="user_password_repeat" id="login_input_password_repeat" class="form-control input-sm" placeholder="Confirm Password"  pattern=".{6,}" required autocomplete="off">
      			    					</div>
      			    				</div>
      			    			</div>

      			    			<input type="submit" class="btn btn-info btn-block" name="register" value="Register">

      			    		</form>
      			    	</div>
      	    		</div>
          		</div>
          	</div>
          </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../ssets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="../../assets/js/please-wait.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        if($.cookie('loading') == undefined || $.cookie('loading') == null) {
          window.loading_screen = window.pleaseWait({
            logo: "../assets/images/logo.svg",
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
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>
