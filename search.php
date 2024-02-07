<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $searchType = $_GET['searchType'];
    $searchText = $_GET['searchText'];

    // SELECT CONCAT(forename, ' ', surname) AS Name FROM drivers WHERE CONCAT(forename, ' ', surname) LIKE '%$searchText%';

    switch ($searchType) {
        case 'drivers':
            $query = ("SELECT number, code, forename, surname, nationality FROM drivers WHERE CONCAT(forename, ' ', surname) LIKE '%$searchText%';");
            break;
        case 'constructors':
            $query = ("SELECT name, nationality FROM constructors WHERE name LIKE '%$searchText%';");
            break;
        case 'circuits':
            $query = ("SELECT name, location, country  FROM circuits WHERE name LIKE '%$searchText%' OR location LIKE '%$searchText%' OR country LIKE '%$searchText%';");
    }

    require 'database.php';

    if (!$connection) {die('Connection to database failed!');}

    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}