<?php

// production
// $servername = "localhost";
// $username = "qerstuserQ42";
// $pass = "TheBestPasswordForQ42Ever";
// $databaseName = "qerst";


// localhost
$servername = "localhost";
$username = "root";
$pass = "";
$databaseName = "qerst";

$conn = mysqli_connect($servername, $username, $pass, $databaseName)
  or die('Error: '.mysqli_connect_error());