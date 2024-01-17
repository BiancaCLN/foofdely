<?php
$server = "sql109.infinityfree.com";
$username = "if0_35801008";
$password = "W0tUCGTbL4";
$database = "if0_35801008_fooddely;port=3306";

// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//$conn->close();

