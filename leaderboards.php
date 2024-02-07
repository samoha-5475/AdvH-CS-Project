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
include 'database.php';

function createLeaderboard($result) {
    if (mysqli_num_rows($result) > 0) {
        $headers = mysqli_fetch_fields($result);

        echo '<tr>';
        foreach ($headers as $header) {
            echo "<th>$header->name</th>";
        }
        echo '</tr>';

        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo '<tr>';
            foreach ($row as $r) {
                echo "<td>$r</td>";
            }
            echo '</tr>';
        }
    } else {
        die('<p>No results found!</p>');
    }
}

?>
<main>
    <section>
        <div class="row">
            <div class="col-4">
                <h2>Top Drivers</h2>
            </div>
            <div class="col-4">
                <h2>Top Constructors</h2>
            </div>
            <div class="col-4">
                <h2>Top Points</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="leaderboard">
                    <?php
                    $query = "SELECT CONCAT(forename, ' ', surname) AS Name, IFNULL(SUM(results.position = 1), 0) AS `Grand Prix Wins` FROM drivers, results WHERE drivers.driverId = results.driverId GROUP BY drivers.driverId ORDER BY `Grand Prix Wins` DESC LIMIT 10;";

                    $result = mysqli_query($connection, $query);

                    mysqli_close($connection);

                    createLeaderboard($result);
                    ?>
                </table>
            </div>
            <div class="col-4">
                <table class="leaderboard">
                </table>
            </div>
            <div class="col-4">
                <table class="leaderboard">
                </table>
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