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

if (isset($_GET['driverId'])) {
    $drivers = $_GET['driverId'];

    $driverOneId = $drivers[0];
    $driverTwoId = $drivers[1];

    function queryDatabase($connection, $query) {
        $query = mysqli_query($connection, $query);
        $result = mysqli_fetch_array($query, MYSQLI_NUM);

        return $result;
    }

    include 'database.php';

    if (!$connection) {die('Connection to database failed!');}
}
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="resultsTableContainer">
                    <table id="resultsTable">
                        <?php
                        $driverOne = queryDatabase($connection, "SELECT forename, surname, nationality FROM drivers WHERE driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT forename, surname, nationality FROM drivers WHERE driverId = '$driverTwoId';");

                        // Displays the headings for the comparison table
                        echo '<tr><th></th>';
                        echo "<th><h2>{$driverOne[0]} {$driverOne[1]}</h2></th>";
                        echo "<th><h2>{$driverTwo[0]} {$driverTwo[1]}</h2></th></tr>";

                        // Displays driver nationalities
                        echo "<tr><th>Nationality</th><td>$driverOne[2]</td><td>$driverTwo[2]</td></tr>";

                        $driverOne = queryDatabase($connection, "SELECT COUNT(DISTINCT races.raceId) FROM races, results WHERE races.raceId = results.raceId AND results.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT COUNT(DISTINCT races.raceId) FROM races, results WHERE races.raceId = results.raceId AND results.driverId = '$driverTwoId';");

                        echo "<tr><th>Races</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        $driverOne = queryDatabase($connection, "SELECT IFNULL(SUM(results.position = 1), 0) AS Wins FROM drivers, results WHERE drivers.driverId = results.driverId AND drivers.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT IFNULL(SUM(results.position = 1), 0) AS Wins FROM drivers, results WHERE drivers.driverId = results.driverId AND drivers.driverId = '$driverTwoId';");

                        echo "<tr><th>Grand Prix Wins</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        $driverOne = queryDatabase($connection, "SELECT IFNULL(SUM(sprint_results.position = 1), 0) FROM drivers, sprint_results WHERE drivers.driverId = sprint_results.driverId AND drivers.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT IFNULL(SUM(sprint_results.position = 1), 0) FROM drivers, sprint_results WHERE drivers.driverId = sprint_results.driverId AND drivers.driverId = '$driverTwoId';");

                        echo "<tr><th>Sprint Wins</th><td>$driverOne[0]</td><td>$driverTwo[0]</td></tr>";

                        $driverOne = queryDatabase($connection, "SELECT MIN(lap_times.time), circuits.location FROM lap_times, races, circuits WHERE lap_times.raceId = races.raceId AND races.circuitId = circuits.circuitId AND lap_times.driverId = '$driverOneId';");
                        $driverTwo = queryDatabase($connection, "SELECT MIN(lap_times.time), circuits.location FROM lap_times, races, circuits WHERE lap_times.raceId = races.raceId AND races.circuitId = circuits.circuitId AND lap_times.driverId = '$driverTwoId';");

                        echo "<tr><th>Fastest Lap</th><td>$driverOne[0], $driverOne[1]</td><td>$driverTwo[0], $driverTwo[1]</td></tr>";

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