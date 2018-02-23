<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'login');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'AMDr0cks');

try {
  $db_connect = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
}
catch (PDOException $e) {
    echo 'Error connecting to SQL Server';
    exit;
}
?>
