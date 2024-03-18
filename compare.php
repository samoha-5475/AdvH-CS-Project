<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'header.php';

// Checks if 'driverId' is populated
if (isset($_GET['driverId'])) {
    // Assigns the received data
    $driverOneId = $_GET['driverId'][0];
    $driverTwoId = $_GET['driverId'][1];

    // Creates the function to query the database and return the result.
    function queryDatabase($connection, $query) {
        // Queries the database and assigns the result to a numeric array
        $query = mysqli_query($connection, $query);
        $result = mysqli_fetch_array($query, MYSQLI_NUM);

        return $result;
    }
}
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="resultsTableContainer">
                    <table id="resultsTable">
                        <?php
                        // Creates a connection to the database
                        include 'database.php';

                        // Queries the database to get information about the drivers
                        $driverOne = queryDatabase($connection, "SELECT UPPER(driverRef), dob, nationality FROM drivers WHERE driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT UPPER(driverRef), dob, nationality FROM drivers WHERE driverId = '$driverTwoId';");

                        // Displays the headings for the comparison table
                        echo "<tr><th></th><th><h2>$driverOne[0]</h2></th><th><h2>$driverTwo[0]</h2></th></tr>";

                        // Displays the driver's date of birth
                        echo "<tr><th>Date of Birth</th><td>$driverOne[1]</td><td>$driverTwo[1]</td></tr>";

                        // Displays driver's nationalities
                        echo "<tr><th>Nationality</th><td>$driverOne[2]</td><td>$driverTwo[2]</td></tr>";

                        // Queries the database to get the number of races both drivers have started
                        $driverOne = queryDatabase($connection, "SELECT COUNT(DISTINCT races.raceId) FROM races, results WHERE races.raceId = results.raceId AND results.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT COUNT(DISTINCT races.raceId) FROM races, results WHERE races.raceId = results.raceId AND results.driverId = '$driverTwoId';");

                        // Displays the number of races both drivers have started
                        echo "<tr><th>Races</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        // Queries the database to get the number of grand prix's both drivers have won
                        $driverOne = queryDatabase($connection, "SELECT IFNULL(SUM(results.position = 1), 0) AS Wins FROM drivers, results WHERE drivers.driverId = results.driverId AND drivers.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT IFNULL(SUM(results.position = 1), 0) AS Wins FROM drivers, results WHERE drivers.driverId = results.driverId AND drivers.driverId = '$driverTwoId';");

                        // Displays the number of grand prix's both drivers have won
                        echo "<tr><th>Grand Prix Wins</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        // Queries the database to get the number of sprint races both drivers have won
                        $driverOne = queryDatabase($connection, "SELECT IFNULL(SUM(sprint_results.position = 1), 0) FROM drivers, sprint_results WHERE drivers.driverId = sprint_results.driverId AND drivers.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT IFNULL(SUM(sprint_results.position = 1), 0) FROM drivers, sprint_results WHERE drivers.driverId = sprint_results.driverId AND drivers.driverId = '$driverTwoId';");

                        // Displays the number of sprint races both drivers have won
                        echo "<tr><th>Sprint Wins</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        // Queries the database to get the drivers fastest lap times, and where
                        $driverOne = queryDatabase($connection, "SELECT MIN(lap_times.time), circuits.location FROM lap_times, races, circuits WHERE lap_times.raceId = races.raceId AND races.circuitId = circuits.circuitId AND lap_times.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT MIN(lap_times.time), circuits.location FROM lap_times, races, circuits WHERE lap_times.raceId = races.raceId AND races.circuitId = circuits.circuitId AND lap_times.driverId = '$driverTwoId';");

                        // Displays the drivers fastest lap times and where it took place
                        echo "<tr><th>Fastest Lap</th><td>$driverOne[0], $driverOne[1]</td><td>$driverTwo[0], $driverTwo[1]</td></tr>";

                        // Queries the database to get the fastest pit stop of both drivers and where
                        $driverOne = queryDatabase($connection, "SELECT duration, location FROM pit_stops, races, circuits WHERE pit_stops.raceId = races.raceId AND races.circuitId = circuits.circuitId AND driverId = '$driverOneId' HAVING MIN(milliseconds);");
                        $driverTwo = queryDatabase($connection, "SELECT duration, location FROM pit_stops, races, circuits WHERE pit_stops.raceId = races.raceId AND races.circuitId = circuits.circuitId AND driverId = '$driverTwoId' HAVING MIN(milliseconds);");

                        // Displays the fastest pit stops of both drivers and where they took place
                        echo "<tr><th>Fastest Pit Stop</th><td>$driverOne[0], $driverOne[1]</td><td>$driverTwo[0], $driverTwo[1]</td></tr>";

                        // Closes the connection to the database
                        mysqli_close($connection);
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include 'footer.php';
?>
</body>
</html>