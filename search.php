<?php
// Checks if the server send method was 'GET'
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Assigns the received data to variables
    $searchType = $_GET['searchType'];
    $searchText = $_GET['searchText'];

    // Defines a switch statement of the variable '$searchType'
    switch ($searchType) {
        // Alters the query based on the search type
        case 'drivers':
            $query = ("SELECT IFNULL(number, 'N/A') as number, IFNULL(code, 'N/A') as code, forename, surname, nationality, driverId FROM drivers WHERE CONCAT(forename, ' ', surname) LIKE '%$searchText%';");
            break;
        case 'constructors':
            $query = ("SELECT name, nationality FROM constructors WHERE name LIKE '%$searchText%';");
            break;
        case 'circuits':
            $query = ("SELECT name, location, country  FROM circuits WHERE name LIKE '%$searchText%' OR location LIKE '%$searchText%' OR country LIKE '%$searchText%';");
    }

    // Connects to the database
    include 'database.php';

    // Gets the result from the query
    $result = mysqli_query($connection, $query);

    // Closes the connection to the database
    mysqli_close($connection);
}