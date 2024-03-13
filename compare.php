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

if (isset($_GET['driverId'])) {
    $drivers = $_GET['driverId'];
    var_dump($drivers);
}
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </section>
</main>
<?php
include 'footer.php';
?>
</body>
</html>
