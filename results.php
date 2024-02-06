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
include 'search.php';
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <table id="resultsTable">
                    <tr>
                        <?php
                        $headers = mysqli_fetch_fields($result);

                        foreach ($headers as $header) {echo "<th>{$header->name}</th>";}
                        ?>
                        <th>Favourite</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                            // echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
                            echo "<tr>";
                            foreach ($row as $r) {echo "<td>{$r}</td>";}
                            echo "</tr>";
                        }
                    } else {
                        die("<br><p>No results found!</p>");
                    }
                    ?>
                </table>
                <?php
                echo "<br><p>There are ".mysqli_num_rows($result)." results!</p>";
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