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
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid bg-dark fixed-bottom">
        <div class="row h-25 p-3">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="col-12">
                    <div class="controls media justify-content-around">
                        <button class="border-0 bg-transparent" title="Shuffle button">
                            <img src="assets/img/icons/shuffle.png" alt="Shuffle">
                        </button>
                        <button class="border-0 bg-transparent" title="Previous button">
                            <img src="assets/img/icons/previous.png" alt="Previous">
                        </button>
                        <button class="border-0 bg-transparent" title="Play button">
                            <img src="assets/img/icons/play.png" alt="Play">
                        </button>
                        <button class="border-0 bg-transparent d-none" title="Pause button">
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
                <div class="col-12">

                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>