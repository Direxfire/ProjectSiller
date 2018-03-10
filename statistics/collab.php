<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
  echo '<html>
  <head><title>WAF Triggered</title></head>
  <body bgcolor="white">
    <center><h1>Web Application Firewall Triggered: Access Denied</h1></center>
    <hr><center>Steel Mountain Networks</center>
  </body>
  </html>';
  die();
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

  <?php if(isset($_GET['teams'])) { ?>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/css/please-wait.css">
  <link rel="stylesheet" href="../../assets/css/spinkit.css">
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/css/index.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/sweetalert2.min.css">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/jquery.cookie.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/sweetalert2.min.js"></script>
  <?php } else { ?>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/css/please-wait.css">
  <link rel="stylesheet" href="../assets/css/spinkit.css">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/index.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery.cookie.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/sweetalert2.min.js"></script>
  <?php } ?>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php if(isset($_GET['teams'])) { ?>
        <a class="navbar-brand" href="../../">Project Siller</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php if($user -> contribute($db_connect)) { ?>
          <li><a href="../../pit">Pit Scouting</a></li>
          <li><a href="../../mobile">Match Scouting</a></li>
          <?php } ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../1391">1391</a></li>
              <li class="active"><a href="/">Collaborative</a></li>
              <li><a href="../pitscouting">Pit Scouting</a></li>
            </ul>
          </li>
          <?php if($user -> admin($db_connect)){ ?>
          <li><a href="../../overwatch/">Overwatch</a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } else {?>
      <a class="navbar-brand" href="../">Project Siller</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php if($user -> contribute($db_connect)) { ?>
        <li><a href="../pit">Pit Scouting</a></li>
        <li><a href="../mobile">Match Scouting</a></li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="1391">1391</a></li>
            <li class="active"><a href="/">Collaborative</a></li>
            <li><a href="pitscouting">Pit Scouting</a></li>
          </ul>
        </li>
        <?php if($user -> admin($db_connect)){ ?>
        <li><a href="../overwatch/">Overwatch</a></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
  </div>
</nav>

<div class="col-md-8 col-md-offset-2">
  <h2 class="text-center underlined">Statistics</h2>
  <h3 class="text-center">Data from Collaborative</h3>
  <div class="panel panel-success">
    <div class="panel-heading"> <h2 class="panel-title">Request Teams</h2></div>
    <div class="panel-body">
      <div class="col-md-12">
        <form method="POST">
          <p style="font-size: 17px;"><b>Put in team numbers separated by a space</b></p>
          <div class="col-md-12">
            <input class="form-control" type="text" name="teams" required autocomplete="off" placeholder="1391 1640 1712">
          </div>
          <div class="col-md-12">
            <br>
            <button class="btn btn-success btn-block" type="submit" name="request">Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  if(isset($_POST['request'])) {
    $teams = strip_tags(htmlentities($_POST['teams']));
    header('Location: /statistics/collaborative/'.urlencode($teams).'');
  }
  if(isset($_GET['teams'])) {
    $teams = strip_tags(htmlentities($_GET['teams']));
    $teams = explode('+', $teams);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.thebluealliance.com/api/v2/event/2017tes/stats",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
        "postman-token: 352cf268-6b33-dc81-b74b-927b93c865cb",
        "x-tba-app-id: 1391:project-siller:v01"
        )
      ));
    $opr = json_decode(curl_exec($curl), true);
    curl_close($curl);
    $nodata = array();
    foreach($teams as $key => $data) {
      if(is_numeric($data)) {
        $ghostcheck = $db_connect -> prepare("SELECT COUNT(*) FROM `matches_collab` WHERE `Team_Number` = :requested");
        $ghostcheck -> execute(array(':requested' => $data));
        $ghostresult = $ghostcheck -> fetchColumn(0);
        // What the fuck am I doing?
        $matches = $ghostresult;
        if($matches > 0) {
          echo '<div class="panel panel-danger">
          <div class="panel-heading"><h2 class="panel-title">Team '.$data.'</h2></div>
          <div class="panel-body">';
            $totalgears = array();
            $totalgear_init = $db_connect -> prepare("SELECT `Total_Gears` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $totalgear_init -> execute(array(':requested' => $data));
            $totalgear_result = $totalgear_init -> fetchAll();
            foreach($totalgear_result as $key => $totalgears_array) {
              array_push($totalgears, $totalgears_array['Total_Gears']);
            }
            echo '<h4>Basic Info: </h4>';
            echo '<h5>OPR (Offensive Power Rating)*: '.round($opr['oprs'][$data],2).'</h5>';
            echo '<h5>Matches Played: '.$matches.'</h5>';
            echo '<h5>Total Gears Scored: '.array_sum($totalgears).'</h5>';
            if(count($totalgear_result) > 0) {
              echo '<h5>Average Gears: '.round(array_sum($totalgears)/count($totalgears), 2).'</h5>';
            } else {
              echo '<h5>Average Gears: N/A</h5>';
            }
            $climbs = array();
            $climb_init = $db_connect -> prepare("SELECT `Rope_Climb` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $climb_init -> execute(array(':requested' => $data));
            $climb_result = $climb_init -> fetchAll();
            foreach($climb_result as $key => $totalclimbs_array) {
              array_push($climbs, $totalclimbs_array['Rope_Climb']);
            }
            echo '<h5>Total Climbs: '.array_sum($climbs).'</h5>';
            if(count($climbs) > 0) {
              echo '<h5>Average Climbs: '.round(array_sum($climbs)/count($climbs), 2).'</h5>';
            } else {
              echo '<h5>Average Climbs: N/A</h5>';
            }
            $percent_climbs = array_sum($climbs)/$matches;
            $percent_climbs = $percent_climbs * 100;
            echo '<h5>Percent Climbs: '.round($percent_climbs, 2).'%</h5>';
            echo '<h5>Alliance KPA Per Match:</h5><div class="row"><div class="col-md-5"><table class="table table-bordered table-striped"><thead><tr><th>Match Number</th><th>Alliance KPA</th></th><tbody>';
            $match_numbers_init = $db_connect -> prepare("SELECT `Match_Number` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $match_numbers_init -> execute(array(':requested' => $data));
            $match_numbers = $match_numbers_init -> fetchAll();
            $match_numbers_array = array();
            foreach($match_numbers as $key => $match_numbers_result_array) {
              array_push($match_numbers_array, $match_numbers_result_array['Match_Number']);
            }
            foreach($match_numbers_array as $key => $match_numbers_data) {
              $alliance_kpa_init = $db_connect -> prepare("SELECT `KPA` FROM `matches_collab` WHERE `Match_Number` = :requested LIMIT 1");
              $alliance_kpa_init -> execute(array(':requested' => $match_numbers_data));
              $alliance_kpa = $alliance_kpa_init -> fetchColumn(0);
              echo '<tr>';
              echo '<td>'.$match_numbers_data.'</td>';
              echo '<td>'.$alliance_kpa.'</td>';
              echo '</tr>';
            }
            echo '</tbody></table></div></div>';
            $g1 = array();
            $g1_init = $db_connect -> prepare("SELECT `Gear_R1_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $g1_init -> execute(array(':requested' => $data));
            $g1_result = $g1_init -> fetchAll();
            foreach($g1_result as $key => $g1_result_array) {
              array_push($g1, $g1_result_array['Gear_R1_Success']);
            }
            $g2 = array();
            $g2_init = $db_connect -> prepare("SELECT `Gear_R2_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $g2_init -> execute(array(':requested' => $data));
            $g2_result = $g2_init -> fetchAll();
            foreach($g2_result as $key => $g2_result_array) {
              array_push($g2, $g2_result_array['Gear_R2_Success']);
            }
            $g3 = array();
            $g3_init = $db_connect -> prepare("SELECT `Gear_R3_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $g3_init -> execute(array(':requested' => $data));
            $g3_result = $g3_init -> fetchAll();
            foreach($g3_result as $key => $g3_result_array) {
              array_push($g3, $g3_result_array['Gear_R3_Success']);
            }
            echo '<hr>';
            echo '<h4>Gears:</h4>';
            echo '<h5>Location G1 Total: '.array_sum($g1).'</h5>';
            echo '<h5>Location G2 Total: '.array_sum($g2).'</h5>';
            echo '<h5>Location G3 Total: '.array_sum($g3).'</h5>';
            $ground_init = $db_connect -> prepare("SELECT `Teleop_Gear_Ground_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $ground_init -> execute(array(':requested' => $data));
            $ground = $ground_init -> fetchAll();
            $ground_result = array();
            foreach($ground as $key => $ground_result_array) {
              array_push($ground_result, $ground_result_array['Teleop_Gear_Ground_Success']);
            }
            $ground_result = array_sum($ground_result)/$matches;
            echo '<h5>Ground Gear Collect: '.round($ground_result, 2).' Gears Average Per Match</h5>';
            $chute_init = $db_connect -> prepare("SELECT `Teleop_Gear_Chute_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $chute_init -> execute(array(':requested' => $data));
            $chute = $chute_init -> fetchAll();
            $chute_result = array();
            foreach($chute as $key => $chute_result_array) {
              array_push($chute_result, $chute_result_array['Teleop_Gear_Chute_Success']);
            }
            $chute_result = array_sum($chute_result)/$matches;
            echo '<h5>Chute Gear Collect: '.round($chute_result, 2).' Gears Average Per Match</h5>';
            echo '<hr>';
            echo '<h4>Autonomous:</h4>';
            $baseline_init = $db_connect -> prepare("SELECT `Auton_Baseline` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $baseline_init -> execute(array(':requested' => $data));
            $baseline = $baseline_init -> fetchAll();
            $baseline_result = array();
            foreach($baseline as $key => $baseline_result_array) {
              array_push($baseline_result, $baseline_result_array['Auton_Baseline']);
            }
            echo '<h5>Baseline: '.array_sum($baseline_result).'/'.$matches.'';
            $autongear_init = $db_connect -> prepare("SELECT `Auton_Gear` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $autongear_init -> execute(array(':requested' => $data));
            $autongear = $autongear_init -> fetchAll();
            $autongear_result = array();
            foreach($autongear as $key => $autongear_result_array) {
              array_push($autongear_result, $autongear_result_array['Auton_Gear']);
            }
            echo '<h5>Gear Placement: '.array_sum($autongear_result).'/'.$matches.'';
            $autongear_location_init = $db_connect -> prepare("SELECT `Auton_Gear_Location` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $autongear_location_init -> execute(array(':requested' => $data));
            $autongear_location = $autongear_location_init -> fetchAll();
            $auton_gear_location_result = array();
            foreach($autongear_location as $key => $autongear_location_result_array) {
              if($autongear_location_result_array['Auton_Gear_Location'] == "None") {
                continue;
              }
              array_push($auton_gear_location_result, $autongear_location_result_array['Auton_Gear_Location']);
            }
            $auton_gear_location_result = implode(', ', $auton_gear_location_result);
            echo '<h5>Gear Location(s): '.$auton_gear_location_result.'</h5>';
            echo '<hr>';
            echo '<h4>Fuel:</h4>';
            $fuel_high_success_init = $db_connect -> prepare("SELECT `Teleop_Fuel_High_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $fuel_high_success_init -> execute(array(':requested' => $data));
            $fuel_high_success = $fuel_high_success_init -> fetchAll();
            $fuel_high_success_result = array();
            foreach($fuel_high_success as $key => $fuel_high_success_result_array) {
              array_push($fuel_high_success_result, $fuel_high_success_result_array['Teleop_Fuel_High_Success']);
            }
            $fuel_high_success = array_sum($fuel_high_success_result);
            $fuel_high_attempt_init = $db_connect -> prepare("SELECT `Teleop_Fuel_High_Attempt` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $fuel_high_attempt_init -> execute(array(':requested' => $data));
            $fuel_high_attempt = $fuel_high_attempt_init -> fetchAll();
            $fuel_high_attempt_result = array();
            foreach($fuel_high_attempt as $key => $fuel_high_attempt_result_array) {
              array_push($fuel_high_attempt_result, $fuel_high_attempt_result_array['Teleop_Fuel_High_Attempt']);
            }
            $fuel_high_attempt = array_sum($fuel_high_attempt_result);
            $high_average = round($fuel_high_success/$fuel_high_attempt,2);
            if($fuel_high_success === 0 && $fuel_high_attempt === 0) {
              echo '<h5>High Average: N/A </h5>';
            } else {
              echo '<h5>High Average: '.$high_average.'</h5>';
            }

            $fuel_low_success_init = $db_connect -> prepare("SELECT `Teleop_Fuel_Low_Success` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $fuel_low_success_init -> execute(array(':requested' => $data));
            $fuel_low_success = $fuel_low_success_init -> fetchAll();
            $fuel_low_success_result = array();
            foreach($fuel_low_success as $key => $fuel_low_success_result_array) {
              array_push($fuel_low_success_result, $fuel_low_success_result_array['Teleop_Fuel_Low_Success']);
            }
            $fuel_low_success = array_sum($fuel_low_success_result);
            $fuel_low_attempt_init = $db_connect -> prepare("SELECT `Teleop_Fuel_Low_Attempt` FROM `matches_collab` WHERE `Team_Number` = :requested");
            $fuel_low_attempt_init -> execute(array(':requested' => $data));
            $fuel_low_attempt = $fuel_low_attempt_init -> fetchAll();
            $fuel_low_attempt_result = array();
            foreach($fuel_low_attempt as $key => $fuel_low_attempt_result_array) {
              array_push($fuel_low_attempt_result, $fuel_low_attempt_result_array['Teleop_Fuel_Low_Attempt']);
            }
            $fuel_low_attempt = array_sum($fuel_low_attempt_result);
            $low_average = round($fuel_low_success/$fuel_low_attempt,2);
            if($fuel_low_success === 0 && $fuel_low_attempt === 0) {
              echo '<h5>Low Average: N/A </h5>';
            } else {
              echo '<h5>Low Average: '.$low_average.'</h5>';
            }
            echo '<hr>';
            echo '<h4>Match Notes:</h4>';
            echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
            $notes_count = 1;
            foreach($match_numbers_array as $key => $notes_match_number) {
              $notes_init = $db_connect -> prepare("SELECT `Notes` FROM `matches_collab` WHERE `Match_Number` = :requested AND `Team_Number` = :data LIMIT 1");
              $notes_init -> execute(array(':requested' => $notes_match_number, ':data' => $data));
              $notes = $notes_init -> fetchColumn(0);
              if(empty($notes) OR $notes == "N/A" OR $notes === NULL) {
                $notes = "No notes available for this match";
              }
              if($notes_count == 1) {
                echo '<div class="panel panel-default">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$notes_match_number.'" aria-expanded="true" aria-controls="collapse'.$notes_match_number.'">
                  <div class="panel-heading" role="tab" id="heading'.$notes_match_number.'" style="color: #333333;background-color: #f5f5f5;border-color: #dddddd;border-bottom: 1px solid transparent;">
                    <h4 class="panel-title">
                      Match '.$notes_match_number.'';
                      if($user -> admin($db_connect) OR $data === $_SESSION['Team_Number']) { 
                        $admin_scoutname_init = $db_connect -> prepare("SELECT `Scout_Name` FROM `matches_collab` WHERE `Match_Number` = :requested AND `Team_Number` = :data LIMIT 1");
                        $admin_scoutname_init -> execute(array(':requested' => $notes_match_number, ':data' => $data));
                        $admin_scout_name= $admin_scoutname_init -> fetchColumn(0);
                        $admin_scoutnumber_init = $db_connect -> prepare("SELECT `Scout_Team` FROM `matches_collab` WHERE `Match_Number` = :requested AND `Team_Number` = :data LIMIT 1");
                        $admin_scoutnumber_init -> execute(array(':requested' => $notes_match_number, ':data' => $data));
                        $admin_scout_number= $admin_scoutnumber_init -> fetchColumn(0);
                        if(empty($admin_scout_name) && empty($admin_scout_number)) {
                          echo '<span class="pull-right"> Scout: Not Available</span>';
                        } else {
                          echo '<span class="pull-right"> Scout: '.ucfirst($admin_scout_name).' '.$admin_scout_number.'</span>';
                        }
                      }
                      echo '</h4>
                    </div>    </a>
                    <div id="collapse'.$notes_match_number.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$notes_match_number.'">
                      <div class="panel-body">
                        '.ucfirst($notes).'
                      </div>
                    </div>
                  </div>';
                } else {
                  echo '<div class="panel panel-default">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$notes_match_number.'" aria-expanded="false" aria-controls="collapse'.$notes_match_number.'">
                    <div class="panel-heading" role="tab" id="heading'.$notes_match_number.'" style="color: #333333;background-color: #f5f5f5;border-color: #dddddd;border-bottom: 1px solid transparent;">
                      <h4 class="panel-title">
                        Match '.$notes_match_number.'';
                        if($user -> admin($db_connect) OR $data === $_SESSION['Team_Number']) { 
                          $admin_scoutname_init = $db_connect -> prepare("SELECT `Scout_Name` FROM `matches_collab` WHERE `Match_Number` = :requested AND `Team_Number` = :data LIMIT 1");
                          $admin_scoutname_init -> execute(array(':requested' => $notes_match_number, ':data' => $data));
                          $admin_scout_name= $admin_scoutname_init -> fetchColumn(0);
                          $admin_scoutnumber_init = $db_connect -> prepare("SELECT `Scout_Team` FROM `matches_collab` WHERE `Match_Number` = :requested AND `Team_Number` = :data LIMIT 1");
                          $admin_scoutnumber_init -> execute(array(':requested' => $notes_match_number, ':data' => $data));
                          $admin_scout_number= $admin_scoutnumber_init -> fetchColumn(0);
                          if(empty($admin_scout_name) && empty($admin_scout_number)) {
                            echo '<span class="pull-right"> Scout: Not Available</span>';
                          } else {
                            echo '<span class="pull-right"> Scout: '.ucfirst($admin_scout_name).' '.$admin_scout_number.'</span>';
                          }
                        }
                        echo '</h4>
                      </div>    </a>
                      <div id="collapse'.$notes_match_number.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$notes_match_number.'">
                        <div class="panel-body">
                          '.ucfirst($notes).'
                        </div>
                      </div>
                    </div>';
                  }
                  $notes_count++;
                }
                echo '</div>';
                echo '<br><p style="font-size: 12px;">*OPR (Offensive Power Rating) provided by The Blue Alliance API</p>';
                echo '</div></div>';
              } else {
                echo '<div class="alert alert-danger text-center" style="font-size: 20px;"><strong>Fatal Error: No data for Team '.$data.'</strong></div>';
              }
            } else {
              echo '<div class="alert alert-danger text-center" style="font-size: 20px;"><strong>Fatal Error: Query not allowed</strong></div>';
            }
          }
        }
        ?>
      </div>

      <?php if(isset($_GET['teams'])) { ?>
      <script type="text/javascript" src="../../assets/js/please-wait.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          if($.cookie('loading') == undefined || $.cookie('loading') == null) {
            window.loading_screen = window.pleaseWait({
              logo: "../../assets/images/logo.svg",
              backgroundColor: '#AC1B1E',
              loadingHtml: "<p class='loading-message'>Project Siller<br>A online scouting platform for FIRST Robotics</p><div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>"
            });
            setTimeout(function() { window.loading_screen.finish();}, 3000);
            var date = new Date();
            date.setTime(date.getTime() + (5 * 60 * 1000));
            $.cookie("loading", "true", { expires: date });
          }
        });
      </script>
      <?php } else { ?>
      <script type="text/javascript" src="../assets/js/please-wait.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          if($.cookie('loading') == undefined || $.cookie('loading') == null) {
            window.loading_screen = window.pleaseWait({
              logo: "../assets/images/logo.svg",
              backgroundColor: '#AC1B1E',
              loadingHtml: "<p class='loading-message'>Project Siller<br>A online scouting platform for FIRST Robotics</p><div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>"
            });
            setTimeout(function() { window.loading_screen.finish();}, 3000);
            var date = new Date();
            date.setTime(date.getTime() + (5 * 60 * 1000));
            $.cookie("loading", "true", { expires: date });
          }
        });
      </script>
      <?php } ?>
    </body>
    </html>