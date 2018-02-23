<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'Hatboro_2018');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'pr0j3cts!l13R');

try {
	$db_connect = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
}
catch (PDOException $e) {
    echo 'Error connecting to SQL Server';
    exit;
}
?>
