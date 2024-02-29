<?php
session_start();

if (isset($_GET['driverId'])) {
    $driverId = $_GET['driverId'];

    if (!isset($_SESSION['favDrivers'])) {
        $_SESSION['favDrivers'] = array();
    }

    $_SESSION['favDrivers'][] = $driverId;
}
?>
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
include 'search.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="numResultsContainer">
                    <?php
                    echo '<p id="numResults"><b>'.mysqli_num_rows($result).'</b> '.$searchType.' found for "'.$searchText.'"</p>';
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="resultsTableContainer">
                    <table id="resultsTable">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $headers = mysqli_fetch_fields($result);

                            echo '<tr>';
                            foreach ($headers as $header) {
                                echo '<th>'.ucfirst($header->name).'</th>';
                            }
                            echo '</tr>';

                            if ($searchType != 'drivers') {
                                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                    echo '<tr>';
                                    foreach ($row as $r) {
                                        echo "<td>$r</td>";
                                    }
                                    echo '</tr>';
                                }
                            } else {
                                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                    $columns = count($row);

                                    echo '<tr>';
                                    for ($i = 0; $i < $columns - 1; $i++) {
                                        echo "<td>$row[$i]</td>";
                                    }

                                    echo '<td><form method="GET" action="results.php"><input type="hidden" name="driverId" value="'.$row[$columns - 1].'"><button type="submit">Favourite</button></form></td></tr>';
                                }
                            }
                        } else {
                            echo '<br><p id="noResults">No results found!</p>';
                        }
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