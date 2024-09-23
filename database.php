<?php
// Defines the parameters for the database connection
$host = "";
$username = "";
$password = "";
$database = "";
$port = 3306;

// Creates a connection to a database using the parameters above
$connection = mysqli_connect($host, $username, $password, $database, $port);

// If the connection fails, ends the running of the script
if (!$connection) {die('Connection to database failed!');}
