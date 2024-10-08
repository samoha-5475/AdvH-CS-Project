<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula One Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="placeholderTextManager.js" defer></script>
</head>
<body>
<?php
include 'header.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12"">
                <form action="results.php" method="GET" id="searchBarContainer">
                    <div id="searchBar">
                        <select id="searchDropdown" name="searchType">
                            <option value="drivers">Drivers</option>
                            <option value="constructors">Teams</option>
                            <option value="circuits">Tracks</option>
                        </select>
                        <input id="searchText" name="searchText" placeholder="Enter driver name..." required>
                        <button id="searchSubmit" type="submit"><img src="img/search.png" alt="submit"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-6">
                <div class="flexContainer">
                    <img class="imgButtonImg" src="img/drivers.jpg" alt="Drivers from the 2022 season">
                    <button class="imgButton"><a href="drivers.php">Drivers</a></button>
                </div>
            </div>
            <div class="col-6">
                <div class="flexContainer">
                    <img class="imgButtonImg" src="img/circuits.jpg" alt="Incident at the Australian Grand Prix 2023">
                    <button class="imgButton"><a href="tracks.php">Tracks</a></button>
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