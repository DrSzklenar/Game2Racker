<?php 
$hostname = "87.229.6.116";
$username = "bruhajuj";
$password = "Kaklanaf";
$dbname = "Game2Racker";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
  echo "Database connection error".mysqli_connect_error();
}
?>