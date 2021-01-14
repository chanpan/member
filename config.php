<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'profile';
$mysqli = new mysqli($serverName,$username,$password,$dbName);

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
$mysqli->set_charset("utf8");
?>