<?php

    include("includes/config.php");
    // session_destroy();

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
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
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 bg-dark vh-100 position-fixed">
                    <nav class="navbar navbar-light bg-dark">
                        <a class="navbar-brand" href="/not-spotify/register.php">
                            <img src="assets/img/icons/audio-wave.png" alt="">
                        </a>
                    </nav>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">
                                    <img width="20" src="assets/img/icons/search.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-light">
                    <div class="col-12 mb-3">
                        <a class="btn btn-outline-success btn-sm btn-block" role="button" href="browse.php">Browse</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a class="btn btn-outline-success btn-sm btn-block" role="button" href="yourMusic.php">Your Music</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a class="btn btn-outline-success btn-sm btn-block" role="button" href="profile.php">Your Profile</a>
                    </div>
                </div>
                <div class="col-lg-10">

                </div>
            </div>
            <div class="container-fluid bg-dark fixed-bottom">
                <div class="row h-25 p-3">
                    <div class="col-lg-3 col-12">
                        <div class="media album-art">
                            <img class="align-self-start mr-3 img-thumbnail" src="assets/img/album1.jpg" alt="album1">
                            <div class="media-body">
                                <h5 class="mt-0 text-light">Top 10 artist</h5>
                                <p class="lead text-light">My new cool song</p>
                                <p class="text-light">My new album</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="col-12">
                            <div class="controls media justify-content-around">
                                <button class="border-0 bg-transparent" title="Shuffle button">
                                    <img src="assets/img/icons/shuffle.png" alt="Shuffle">
                                </button>
                                <button class="border-0 bg-transparent" title="Previous button">
                                    <img src="assets/img/icons/previous.png" alt="Previous">
                                </button>
                                <button class="border-0 bg-transparent play" title="Play button">
                                    <img src="assets/img/icons/play.png" alt="Play">
                                </button>
                                <button class="border-0 bg-transparent pause d-none" title="Pause button">
                                    <img src="assets/img/icons/pause.png" alt="Pause">
                                </button>
                                <button class="border-0 bg-transparent" title="Next button">
                                    <img src="assets/img/icons/next.png" alt="Next">
                                </button>
                                <button class="border-0 bg-transparent" title="Repeat button">
                                    <img src="assets/img/icons/repeat.png" alt="Repeat">
                                </button>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <span class="text-light float-left mt-2">0.00</span>
                            <span class="text-light float-right mt-2">0.00</span>
                            <div class="progress">
                                <div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 align-self-center">
                        <div class="media">
                            <button class="border-0 bg-transparent" title="Volume button">
                                <img class="align-self-end mr-3 volume" src="assets/img/icons/volume.png" alt="Volume-on">
                            </button>
                            <div class="media-body align-self-center">
                                <div class="progress">
                                    <div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>