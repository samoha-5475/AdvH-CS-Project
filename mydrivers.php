<?php
// Starts a php session
session_start();

// Checks if 'driverId' is populated
if (isset($_GET['driverId'])) {
    // Assigns the received data
    $driverId = $_GET['driverId'];

    // Checks if the 'favDrivers' session variable already exists
    if (!isset($_SESSION['favDrivers'])) {
        // Initialises the 'favDrivers' session variable as an array
        $_SESSION['favDrivers'] = array();
    }

    // Adds a new 'driverId' to the 'favDrivers' session variable along as this 'driverId' isn't already in the array
    if (!in_array($driverId, $_SESSION['favDrivers'])) {
        $_SESSION['favDrivers'][] = $driverId;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="checkboxValidation.js" defer></script>
</head>
<body>
<?php
include 'header.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <h2>My Drivers</h2>
            </div>
        </div>
        <form id="compareForm" method="GET" action="compare.php">
            <div class="row">
                <div class="col-12">
                    <div id="resultsTableContainer">
                        <table id="resultsTable">
                            <?php
                            // Checks if the session variable 'favDrivers' is populated
                            if (!isset($_SESSION['favDrivers'])) {
                                echo '<p id="numResults">Select some favourite drivers first!</p>';
                            } else {
                                // Creates a connection to the database
                                include 'database.php';

                                // Displays the headings for the driver information
                                echo '<tr><th>Number</th><th>Code</th><th>Forename</th><th>Surname</th><th>Nationality</th></tr>';

                                // Starts a loop for each driver saved in the session variable
                                foreach ($_SESSION['favDrivers'] as $driverId) {
                                    // Initialises the query to get the driver information of the current driver in the session variable
                                    $query = ("SELECT IFNULL(number, 'N/A') as number, IFNULL(code, 'N/A') as code, forename, surname, nationality FROM drivers WHERE driverId = '$driverId'");

                                    // Queries the database and assigns the result to a numeric array
                                    $result = mysqli_query($connection, $query);
                                    $row = mysqli_fetch_array($result, MYSQLI_NUM);

                                    // Displays each column of the row in a table row
                                    echo '<tr>';
                                    foreach ($row as $column) {
                                        echo "<td>$column</td>";
                                    }

                                    // Displays a checkbox with the current 'driverId' provided as the value
                                    echo '<td><input type="checkbox" class="checkbox" name="driverId[]" value="'.$driverId. '"></td></tr>';
                                }

                                // Closes the connection to the database
                                mysqli_close($connection);
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="compareButtonContainer">
                        <button id="compareButton" type="submit">Compare</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
<?php
include 'footer.php';
?>
</body>
</html>