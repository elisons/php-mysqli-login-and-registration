<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'accounts';

$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error());

//function form validation

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
