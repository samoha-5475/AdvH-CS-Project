<?php
session_start();

if (isset($_GET['driverId'])) {
    $driverId = $_GET['driverId'];

    if (!isset($_SESSION['favDrivers'])) {
        $_SESSION['favDrivers'] = array();
    }

    if (!in_array($driverId, $_SESSION['favDrivers'])) {
        $_SESSION['favDrivers'][] = $driverId;
        echo 'favourite added!';
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
        <form method="GET" action="compare.php">
            <div class="row">
                <div class="col-12">
                    <div id="resultsTableContainer">
                        <table id="resultsTable">
                            <?php
                            if (!isset($_SESSION['favDrivers'])) {
                                echo '<p>Select some favourite drivers first!</p>';
                            } else {
                                include 'database.php';

                                if (!$connection) {die('Connection to database failed!');}

                                echo '<tr><th>Number</th><th>Code</th><th>Forename</th><th>Surname</th><th>Nationality</th></tr>';

                                foreach ($_SESSION['favDrivers'] as $driverId) {
                                    $query = ("SELECT IFNULL(number, 'N/A') as number, IFNULL(code, 'N/A') as code, forename, surname, nationality FROM drivers WHERE driverId = '$driverId'");

                                    $result = mysqli_query($connection, $query);
                                    $row = mysqli_fetch_array($result, MYSQLI_NUM);

                                    echo '<tr>';

                                    foreach ($row as $column) {
                                        echo "<td>$column</td>";
                                    }

                                    echo '<td><input type="checkbox" class="checkbox" name="driverId[]" value="'.$driverId. '"></td></tr>';
                                }
                                mysqli_close($connection);
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit">Submit</button>
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