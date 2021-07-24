<?php

$servername = "localhost";
$username = "root";
$password = "";

$banco = "db_clinic";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $banco);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

?>