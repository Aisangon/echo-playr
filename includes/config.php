<?php
    ob_start();

    $timezone = date_default_timezone_set("Europe/Berlin");

    $con = mysqli_connect("localhost", "root", "", "not_spotify");

    if(mysqli_connect_errno()) {
        echo "Fail to connect" . mysqli_connect_errno();
    }
?>