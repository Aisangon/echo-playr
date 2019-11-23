<?php
    include('includes/config.php');
    include('includes/classes/Account.php');
    include('includes/classes/Constants.php');

    $account = new Account($con);

    include('includes/handlers/register-handler.php');
    include('includes/handlers/login-handler.php');

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Just a music player</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="assets/js/register.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>

    <?php
        if(isset($_POST['submitSignUp'])) {
            echo "<script>
                    $(function() {
                        $('#loginForm').hide();
                        $('#registerForm').show();
                    });
                </script>";
        } else {
            echo "<script>
                    $(function() {
                        $('#loginForm').show();
                        $('#registerForm').hide();
                    });
                </script>";
        }
    ?>

    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-12 col-sm-6">
                <form id="loginForm" action="register.php" method="post">
                <h2 class="text-white">Login to your account</h2>
                    <div class="form-group">
                        <label class="text-white" for="inputUsername">Username</label>
                        <input type="text" name="loginUsername" value="<?php getInputValue('loginUsername'); ?>" class="form-control" id="inputUsername" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="exampleInputPassword1">Password</label>
                        <input type="password" name="loginPassword" value="<?php getInputValue('loginPassword'); ?>" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    </div>
                    <button type="submit" name="submitLogin" class="btn btn-outline-success">Log In</button>
                    <div class="form-group mt-3">
                        <small><a id="hideLogin" class="text-white" href="javascript:void(0)">Don't have an account yet? Sign up here.</a></small>
                    </div>
                </form>
                <form id="registerForm" action="register.php" method="post">
                    <h2 class="text-white">New? Register.</h2>
                    <div class="form-group">
                        <label class="text-white" for="usernameInput">Username</label>
                        <input type="text" name="userName" value="<?php getInputValue('userName'); ?>" class="form-control" id="usernameInput" aria-describedby="emailHelp" placeholder="Enter username" required>
                        <?php echo $account->getError(Constants::$userNameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white" for="firstNameInput">First name</label>
                                <input class="form-control" type="text" name="firstName" value="<?php getInputValue('firstName'); ?>" id="firstNameInput" placeholder="First name">
                                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="surnameInput">Last name</label>
                                <input class="form-control" type="text" name="lastName" value="<?php getInputValue('lastName'); ?>" id="surnameInput" placeholder="Last name">
                                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="exampleInputEmail2">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail2" name="email1" value="<?php getInputValue('email1'); ?>" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="confirmEmail">Confirm Email</label>
                        <input type="email" class="form-control" id="confirmEmail" name="email2" value="<?php getInputValue('email2'); ?>" aria-describedby="emailHelp" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="password1">Password</label>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="password2">Confirm Password</label>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="submitSignUp" class="btn btn-outline-success">Sign Up</button>
                    <div class="form-group mt-3">
                        <small><a id="hideSignUp" class="text-white" href="javascript:void(0)">Already have an account? Login here.</a></small>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-6">
                <div class="jumbotron">
                    <h1 class="display-4">Welcome to Music Player.</h1>
                    <p class="lead">Come here to listen to great music.</p>
                    <hr class="my-4">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="mr-1" src="assets/img/icons/list-check.png" alt="features-checklist">
                            <p class="lead">Discover new music to fall in love with.</p>
                        </li>
                        <li class="media">
                            <img class="mr-1" src="assets/img/icons/list-check.png" alt="features-checklist">
                            <p class="lead">Create your own playlists.</p>
                        </li>
                        <li class="media">
                            <img class="mr-1" src="assets/img/icons/list-check.png" alt="features-checklist">
                            <p class="lead">Follow artists to keep up to date.</p>
                        </li>
                    </ul>
                    <!-- <p>Discover new music to fall in love with. Create your own playlists. Follow artists to keep up to date.</p> -->
                    <p class="lead">
                        <a class="btn btn-outline-success btn-lg" href="#" role="button">Learn more</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>