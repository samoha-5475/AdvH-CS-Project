<?php
// Defines the parameters for the database connection
$host = "formula-one-db.czo0uem2g0q9.eu-north-1.rds.amazonaws.com";
$username = "root";
$password = "YiWU13=7f?WBlPznBV+";
$database = "f1db";
$port = 3306;

// Creates a connection to a database using the parameters above
$connection = mysqli_connect($host, $username, $password, $database, $port);

// If the connection fails, ends the running of the script
if (!$connection) {die('Connection to database failed!');}