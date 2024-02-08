<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="favourite.js" defer></script>
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

                            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                echo '<tr>';
                                foreach ($row as $r) {
                                    echo "<td>$r</td>";
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