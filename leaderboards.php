<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<main>
    <section>
        <h1>Top Drivers</h1>

        <?php
        $connection = ""; // To prevent IDE errors

        require 'database.php';

        // Query for most points in a season, result : Red Bull 860 2023
        // $query = "SELECT constructors.name, constructor_standings.points, seasons.year FROM constructors, constructor_standings, races, seasons WHERE constructors.constructorId = constructor_standings.constructorId AND constructor_standings.raceId = races.raceId AND races.year = seasons.year ORDER BY points DESC LIMIT 1;";

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

        die("<br><br><a href='index.php'>Home</a>");
        ?>
    </section>
</main>
</body>
</html>