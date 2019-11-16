<?php
    include('includes/classes/Account.php');

    $account = new Account();

    include('includes/handlers/register-handler.php');
    include('includes/handlers/login-handler.php');

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Just a music player</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body style="margin: 0; padding: 0; overflow-x: hidden;">
    <div class="container">
        <form action="register.php" method="post">
        <h2>Login to your account</h2>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submitLogin" class="btn btn-primary">Log In</button>
        </form>
        <form action="register.php" method="post">
            <h2>New? Register.</h2>
            <div class="form-group">
                <?php echo $account->getError('Your username must be between 5 and 25 characters.'); ?>
                <label for="usernameInput">Username</label>
                <input type="text" name="userName" class="form-control" id="usernameInput" aria-describedby="emailHelp" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $account->getError('Your first name must be between 2 and 25 characters.'); ?>
                        <label for="firstNameInput"></label>
                        <input class="form-control" type="text" name="firstName" id="firstNameInput" placeholder="First name">
                    </div>
                    <div class="col-md-6">
                        <?php echo $account->getError('Your last name must be between 2 and 25 characters.'); ?>
                        <label for="surnameInput"></label>
                        <input class="form-control" type="text" name="lastName" id="surnameInput" placeholder="Surname">
                    </div>
                </div>
            </div>
            <div class="form-group">
            <?php echo $account->getError('Your email and confirm email must be the same.'); ?>
            <?php echo $account->getError('Your email is inivalid.'); ?>
                <label for="exampleInputEmail2">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail2" name="email1" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="confirmEmail">Confirm Email</label>
                <input type="email" class="form-control" id="confirmEmail" name="email2" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <?php echo $account->getError("Your passwords don't match ivalid."); ?>
                <?php echo $account->getError('Your password can only contain numbers and letters.'); ?>
                <?php echo $account->getError('Your password must be between 5 and 30 characters.'); ?>
                <label for="password1">Password</label>
                <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="submitSignUp" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</body>
</html>