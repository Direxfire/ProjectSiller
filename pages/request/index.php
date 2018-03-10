<?php
require('../vendor/autoload.php');
if(isset($_COOKIE['progress'])) {
	$progress = strip_tags(htmlentities($_COOKIE['progress']));
	switch($progress) {
		case('2'):
		// Step 2
		if(isset($_GET['request'])) {
			$request = strip_tags(htmlentities($_GET['request']));
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $request === "validation" && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['team'], $_POST['csrf'])) {
				$csrf = strip_tags(htmlentities($_POST['csrf']));
				if($csrf === $_SESSION['csrf']) {
					try {
						$database_temp = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
					} catch (PDOException $e) {
						header('Content-Type: application/json');
						die(json_encode(array('Message' => 'Fail')));
					}
					$team = strip_tags(htmlentities($_POST['team']));
					$ghost_check = $database_temp->prepare("SELECT COUNT(*) FROM `request` WHERE `Team_Number` = :team_number LIMIT 1");
					$ghost_check->execute(array(':team_number' => $team));
					$ghost_result = $ghost_check->fetchColumn(0);
					if($ghost_result == 0) {
						$curl = curl_init();
						curl_setopt_array($curl, array(
							CURLOPT_RETURNTRANSFER => 1,
							CURLOPT_URL => 'https://www.thebluealliance.com/api/v3/team/frc'.$team,
							CURLOPT_USERAGENT => 'Project Siller',
							CURLOPT_HTTPHEADER => array('X-TBA-Auth-Key: FP8EuLi1ASK3GKlXqHhUZFunb8CRJHP2ZRW6AVDyI2J5WyDeiVTw8MBR8SZhutHx')
						));
						$resp = curl_exec($curl);
						curl_close($curl);
						$resp = json_decode($resp, true);
						if(isset($resp['Errors'][0]['team_id'])) {
							header('Content-Type: application/json');
							die(json_encode(array('Message' => 'Failed')));
						} else {
							header('Content-Type: application/json');
							die(json_encode(array('Message' => 'Success', 'Nickname' => $resp['nickname'])));
						}
					} else {
						header('Content-Type: application/json');
						die(json_encode(array('Message' => 'Failed', 'Reason' => 'Team is already registered!')));
					}
				} else {
					header('Location: https://siller.io');
					die();
				}
			} elseif(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $request === "submit" && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['team_number'], $_POST['team_name'], $_POST['team_role'], $_POST['team_member'], $_POST['about'], $_POST['about_other'], $_POST['about_other'], $_POST['expectation'], $_POST['csrf'])) {
				$csrf = strip_tags(htmlentities($_POST['csrf']));
				if($csrf === $_SESSION['csrf']) {
					$_SESSION['progress'] = 3;
					$_SESSION['name'] = strip_tags(htmlentities($_POST['name']));
					$_SESSION['team_number'] = strip_tags(htmlentities($_POST['team_number']));
					$_SESSION['team_name'] = strip_tags(htmlentities($_POST['team_name']));
					$_SESSION['team_role'] = strip_tags(htmlentities($_POST['team_role']));
					$_SESSION['team_member'] = strip_tags(htmlentities($_POST['team_member']));
					$_SESSION['about'] = strip_tags(htmlentities($_POST['about']));
					$_SESSION['about_other'] = strip_tags(htmlentities($_POST['about_other']));
					$_SESSION['expectation'] = strip_tags(htmlentities($_POST['expectation']));
					header('Content-Type: application/json');
					die(json_encode(array('Message' => 'Success')));
				} else {
					header('Location: https://siller.io');
					die();
				}
			} else {
				header('Location: https://siller.io');
				die();
			}
		} else {
			include('information.php');
			die();
		}
		break;
		case('3'):
		if(isset($_SESSION['progress']) && $_SESSION['progress'] === 3) {
			require('../inc/function/oauth.php');
			if(isset($_GET['request']) && isset($_GET['detail'])) {
				$request = strip_tags(htmlentities($_GET['request']));
				$detail = strip_tags(htmlentities($_GET['detail']));
				if($request === "oauth" && $service->getFactory()->has($detail)) {
					switch($detail) {
						case('github'):
						$detail = $service->getProvider('github');
						$accessToken = $detail->getAccessTokenByRequestParameters($_GET);
						$user = $detail->getIdentity($accessToken);
						$_SESSION['oauth'] = 'github';
						$_SESSION['oauth-detail'] = $user->username;
						header('Location: https://siller.io/request');
						die();
						break;
						case('twitter'):
						$detail = $service->getProvider('twitter');
						$accessToken = $detail->getAccessTokenByRequestParameters($_GET);
						dump($accessToken);
						dump($accessToken->getUserId());
						dump($accessToken->getExpires());
						$user = $detail->getIdentity($accessToken);
						dump($user);
						break;
						default:
						header('Location: https://siller.io/request');
						die();
					}
				} elseif(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $request === "domain" && isset($_GET['domain'], $_GET['csrf'])) {
					$csrf = strip_tags(htmlentities($_GET['csrf']));
					if($csrf === $_SESSION['csrf']) {
						require('../inc/function/domain.php');
						$domain = new domain;
						$requestedDomain = strip_tags(htmlentities($_GET['domain']));
						switch($detail) {
							case('dns'):
							$domain->dns($requestedDomain);
							die();
							break;
							case('html'):
							$domain->html($requestedDomain);
							die();
							break;
							default:
							header('Location: https://siller.io/request');
							die();
						}
					} else {
						header('Location: https://siller.io/request');
						die();
					}
				} elseif(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $request === "manual" && $_SERVER['REQUEST_METHOD'] === 'POST') {
					if($detail === "validation" && isset($_POST['team'], $_POST['csrf'])) {
						$csrf = strip_tags(htmlentities($_POST['csrf']));
						if($csrf === $_SESSION['csrf']) {
							$team = strip_tags(htmlentities($_POST['team']));
							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => 'https://www.thebluealliance.com/api/v3/team/frc'.$team,
								CURLOPT_USERAGENT => 'Project Siller',
								CURLOPT_HTTPHEADER => array('X-TBA-Auth-Key: FP8EuLi1ASK3GKlXqHhUZFunb8CRJHP2ZRW6AVDyI2J5WyDeiVTw8MBR8SZhutHx')
							));
							$resp = curl_exec($curl);
							curl_close($curl);
							$resp = json_decode($resp, true);
							if(isset($resp['Errors'][0]['team_id'])) {
								header('Content-Type: application/json');
								die(json_encode(array('Message' => 'Failed',)));
							} else {
								header('Content-Type: application/json');
								die(json_encode(array('Message' => 'Success', 'Nickname' => $resp['nickname'])));
							}
						} else {
							header('Location: https://siller.io');
							die();
						}
					} elseif($detail === "submit" && isset($_POST['name'], $_POST['team_number'], $_POST['team_name'], $_POST['team_role'], $_POST['team_member'], $_POST['about'], $_POST['about_other'], $_POST['about_other'], $_POST['expectation'], $_POST['csrf'])) {
						// Insert into database
						$csrf = strip_tags(htmlentities($_POST['csrf']));
						if($csrf === $_SESSION['csrf']) {
							try {
								$database_temp = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
							} catch (PDOException $e) {
								header('Content-Type: application/json');
								die(json_encode(array('Message' => 'Fail')));
							}
							// Possible null values
							if(empty(strip_tags(htmlentities($_POST['about_other'])))) {
								$about_other = NULL;
							} else {
								$about_other = strip_tags(htmlentities($_POST['about_other']));
							}
							if(empty(strip_tags(htmlentities($_POST['expectation'])))) {
								$expectation = NULL;
							} else {
								$expectation = strip_tags(htmlentities($_POST['expectation']));
							}
							$insert = $database_temp->prepare("INSERT INTO `request` VALUES(NULL, :name, :team_number, :team_name, :team_role, :team_member, :about, :about_other, :expectation, NULL, 0)");
							$insert->execute(array(':name' => strip_tags(htmlentities($_POST['name'])), ':team_number' => strip_tags(htmlentities($_POST['team_number'])), ':team_name' => strip_tags(htmlentities($_POST['team_name'])), ':team_role' => strip_tags(htmlentities($_POST['team_role'])), ':team_member' => strip_tags(htmlentities($_POST['team_member'])), ':about' => strip_tags(htmlentities($_POST['about'])), ':about_other' => $about_other, ':expectation' => $expectation));
							$_SESSION['progress'] = 4;
							header('Content-Type: application/json');
							die(json_encode(array('Message' => 'Success')));
						} else {
							header('Location: https://siller.io');
							die();
						}
					} else {
						header('Location: https://siller.io/request');
						die();
					}
				}
			} else {
				include('verification.php');
				die();
			}
		} else {
			unset($_SESSION['progress']);
			setcookie("progress", "1", 1, "/request", "siller.io", TRUE, TRUE);
			header('Location: https://siller.io/request');
			die();
		}
		break;
		case('4'):
		die('next');
		break;
		default:
		// User shouldn't have cookie
		setcookie("progress", "1", 1, "/request", "siller.io", TRUE, TRUE);
		header('Location: https://siller.io');
		die();
	}
} else {
	// User doesn't have cookie at all!
	include('agree.php');
	die();
}
?>
