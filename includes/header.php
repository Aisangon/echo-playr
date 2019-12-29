<?php

    include("includes/config.php");
    include("includes/classes/User.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    include("includes/classes/Playlist.php");
    // session_destroy();

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
        $loggedInUser = $userLoggedIn->getUsername();
        echo "<script>let userLoggedIn = '$loggedInUser'</script>";
    } else {
        header("Location: register.php");
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Music Player</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="assets/js/script.js"></script>
    </head>
    <body class="bg-dark border border-secondary">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Container -->
                <?php include('includes/navbarContainer.php'); ?>
                <div class="col-lg-10 offset-lg-2" id="main-content">
                    <section class="container-fluid">