<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Tracks</title>
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
                    // Connects to the database
                    include 'database.php';

                    // Creates a query to get all the circuits from the database in name order
                    $query = ('SELECT name FROM circuits ORDER BY name;');

                    // Assigns the result of the query to a variable
                    $result = mysqli_query($connection, $query);

                    // Closes the connection to the database
                    mysqli_close($connection);

                    // Displays each circuit while there is a row in left in the result array
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