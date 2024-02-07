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
require 'database.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-4">
                <h1>Top Drivers</h1>
            </div>
            <div class="col-4">
                <h1>Top Constructors</h1>
            </div>
            <div class="col-4">
                <h1>Top Points</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?php
                $query = "SELECT forename, surname, IFNULL(SUM(results.position = 1), 0) AS `Grand Prix Wins` FROM drivers, results WHERE drivers.driverId = results.driverId GROUP BY drivers.driverId ORDER BY `Grand Prix Wins` DESC;";

                $result = mysqli_query($connection, $query);

                mysqli_close($connection);

                if (mysqli_num_rows($result) > 0) {
                    $rows = 0;
                    echo "<table>";
                    echo "<tr><th>Forename</th><th>Surname</th><th>Grand Prix Wins</th></tr>";
                    while ($rows < 10 and $row = mysqli_fetch_array($result)) {
                        $rows++;
                        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><</tr>";
                    }
                    echo "</table>";
                } else {
                    die("<br>No results found!<br><br><a href='index.php'>Home</a>");
                }
                ?>
            </div>
        </div>
    </section>
</main>
<?php
include 'footer.php';

// Query for most points in a season, result : Red Bull 860 2023
// $query = "SELECT constructors.name, constructor_standings.points, seasons.year FROM constructors, constructor_standings, races, seasons WHERE constructors.constructorId = constructor_standings.constructorId AND constructor_standings.raceId = races.raceId AND races.year = seasons.year ORDER BY points DESC LIMIT 1;";
?>
</body>
</html>