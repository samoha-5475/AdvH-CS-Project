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

// Creates a connection to the database
include 'database.php';

// Defines the function to create a leaderboard given a connection to the database and a query
function createLeaderboard($connection, $query) {
    // Runs the query and assigns the result to a variable
    $result = mysqli_query($connection, $query);

    // Gets the headers from the result
    $headers = mysqli_fetch_fields($result);

    // Creates the header row, ensuring the first character is uppercase
    echo '<tr><th></th>';
    foreach ($headers as $header) {
        echo '<th>' .ucfirst($header->name). '</th>';
    }
    echo '</tr>';

    // Initialises a counter variable
    $counter = 1;

    // Loops for each row of the leaderboard until there are none left
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        // Displays the leaderboard position
        echo '<tr><td id="leaderboard'.$counter.'">'.$counter.'</td>';

        // Displays each value in the row
        foreach ($row as $r) {
            echo "<td>$r</td>";
        }
        echo '</tr>';

        // Increments the counter variable
        $counter++;
    }
}

?>
<main>
    <section>
        <div class="row">
            <div class="col-4">
                <div class="flexContainer">
                    <div class="leaderboardContainer">
                        <h2>Top Drivers</h2>
                        <table class="leaderboard">
                            <?php
                            // Creates the query to get the top 10 drivers ordered by grand prix wins
                            $query = "SELECT CONCAT(forename, ' ', surname) AS Name, SUM(results.position = 1) AS `Grand Prix Wins` FROM drivers, results WHERE drivers.driverId = results.driverId GROUP BY drivers.driverId ORDER BY `Grand Prix Wins` DESC LIMIT 10;";

                            // Calls the function to create the leaderboard, passing in a connection and the query
                            createLeaderboard($connection, $query);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="flexContainer">
                    <div class="leaderboardContainer">
                        <h2>Top Constructors</h2>
                        <table class="leaderboard">
                            <?php
                            // Creates the query to get the top 10 constructors ordered by total race wins
                            $query = 'SELECT name AS Constructor, SUM(results.position = 1) AS `Grand Prix Wins` FROM constructors, results WHERE constructors.constructorId = results.constructorId GROUP BY constructors.constructorId ORDER BY `Grand Prix Wins` DESC LIMIT 10;';

                            // Calls the function to create the leaderboard, passing in a connection and the query
                            createLeaderboard($connection, $query);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="flexContainer">
                    <div class="leaderboardContainer">
                        <h2>Top Circuits</h2>
                        <table class="leaderboard">
                            <?php
                            // Creates the query to get the top 10 circuits ordered by the number of races held
                            $query = 'SELECT location AS Circuit, COUNT(races.circuitid) AS `Races Held` FROM circuits, races WHERE races.circuitid = circuits.circuitid GROUP BY Circuit ORDER BY `Races Held` DESC LIMIT 10;';

                            // Calls the function to create the leaderboard, passing in a connection and the query
                            createLeaderboard($connection, $query);

                            // Closes the connection to the database
                            mysqli_close($connection);
                            ?>
                        </table>
                    </div>
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