<?php
session_start();

if (isset($_GET['driverId'])) {
    $driverId = $_GET['driverId'];

    $_SESSION['favouriteDriver'] = $driverId;

    echo 'favourite driver assigned!';
}

// FAVOURITE ONE TRACK ONE DRIVER ONE TEAM