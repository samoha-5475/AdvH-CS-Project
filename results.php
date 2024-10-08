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

// Includes 'search.php' which process the user's search
include 'search.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="numResultsContainer">
                    <?php
                    // Displays the number of results generated by the search
                    echo '<p id="numResults"><b>'.mysqli_num_rows($result).'</b> '.$searchType.' found for "'.$searchText.'"</p>';
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="flexContainer">
                    <table id="resultsTable">
                        <?php
                        // Checks if the number of rows produced by the search is more than zero
                        if (mysqli_num_rows($result) > 0) {
                            // Checks if the search type is not a driver search
                            if ($searchType != 'drivers') {
                                // Returns table information about the result and assigns it to an array
                                $headers = mysqli_fetch_fields($result);

                                // Creates the header row
                                echo '<tr>';

                                // Displays each header contained in the $headers array
                                foreach ($headers as $header) {
                                    // Since '$headers' is an array of objects the -> operator must be used
                                    echo '<th>'.ucfirst($header->name).'</th>';
                                }
                                echo '</tr>';

                                // Displays each row of the search while there is a row in left in the result array
                                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

                                    // Creates the table row, and loops for each column in a row
                                    echo '<tr>';
                                    foreach ($row as $r) {
                                        echo "<td>$r</td>";
                                    }
                                    echo '</tr>';
                                }
                            } else {
                                // Displays the headers for a driver search
                                echo '<tr><th>Number</th><th>Code</th><th>Forename</th><th>Surname</th><th>Nationality</th></tr>';

                                // Displays each row of the driver search while there is a row left in the result array
                                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                    // Assigns the length of the row array to a variable
                                    $columns = count($row);

                                    echo '<tr>';

                                    // Displays each column except the last one, as it is not needed
                                    for ($i = 0; $i < $columns - 1; $i++) {
                                        echo "<td>$row[$i]</td>";
                                    }

                                    // Creates the button to allow users to add drivers to their favourites
                                    echo '<td><form method="GET" action="mydrivers.php"><input type="hidden" name="driverId" value="'.$row[$columns - 1].'"><button type="submit" class="addToMyDriversButton">Add to "My Drivers"</button></form></td></tr>';
                                }
                            }
                        } else {
                            // Displays to the user, no results were found
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