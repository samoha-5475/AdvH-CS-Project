<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
include 'header.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="resultsTableContainer">
                    <table id="resultsTable">
                        <?php
                        include 'search.php';

                        if (mysqli_num_rows($result) > 0) {
                            $headers = mysqli_fetch_fields($result);

                            echo '<tr>';
                            foreach ($headers as $header) {
                                echo "<th>{$header->name}</th>";
                            }
                            echo '</tr>';

                            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                echo '<tr>';
                                foreach ($row as $r) {
                                    echo "<td>{$r}</td>";
                                }
                                echo '</tr>';
                            }
                        } else {
                            die('<br><p>No results found!</p>');
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                echo '<p>There are ' . mysqli_num_rows($result) . ' results!</p>';
                ?>
            </div>
        </div>
    </section>
</main>
<?php
include 'footer.php';
?>
</body>
</html>