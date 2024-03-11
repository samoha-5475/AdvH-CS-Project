<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//if (isset($_GET['searchType']) && isset($_GET['searchText'])) {
    $searchType = $_GET['searchType'];
    $searchText = $_GET['searchText'];

//    $_GET['searchType'] = null;
//    $_GET['searchText'] = null;

    switch ($searchType) {
        case 'drivers':
            $query = ("SELECT IFNULL(number, 'N/A') as number, IFNULL(code, 'N/A') as code, forename, surname, nationality, driverId FROM drivers WHERE CONCAT(forename, ' ', surname) LIKE '%$searchText%';");
            break;
        case 'constructors':
            $query = ("SELECT name, nationality FROM constructors WHERE name LIKE '%$searchText%';");
            break;
        case 'circuits':
            $query = ("SELECT name, location, country  FROM circuits WHERE name LIKE '%$searchText%' OR location LIKE '%$searchText%' OR country LIKE '%$searchText%';");
    }

    include 'database.php';

    if (!$connection) {die('Connection to database failed!');}

    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}