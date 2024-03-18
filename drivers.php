<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Drivers</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scrollToLetter.js" defer></script>
</head>
<body>
<?php
include 'header.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="alphabetContainer"></div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="listContainer">
                    <?php
                    include 'database.php';

                    // Creates the query to get every drivers name from the database
                    $query = ("SELECT CONCAT(forename, ' ', surname) AS Name FROM drivers ORDER BY forename;");

                    // Runs the query and assigns the result to a variable
                    $result = mysqli_query($connection, $query);

                    // Closes the connection to the database
                    mysqli_close($connection);

                    // Displays each driver's name while there is a row in left in the result array
                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        echo '<p class="listItem">'.$row[0].'</p>';
                    }
                    ?>
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