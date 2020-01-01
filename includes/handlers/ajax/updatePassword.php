<?php
    include("../../config.php");

    header('Content-Type: application/json');

    if(!isset($_POST["username"])) {
        echo "ERROR: could not set username.";
        exit();
    }

    if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['confirmPassword'])) {
        echo "Not all passwords have ben set.";
        exit();
    }

    if($_POST['oldPassword'] == "" || $_POST['newPassword'] == "" || $_POST['confirmPassword'] == "") {
        echo "Please fill in all fields.";
        exit();
    }

    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $oldMd5 = md5($oldPassword);

    $passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");
    if(mysqli_num_rows($passwordCheck) != 1) {
        echo "Password is incorrect.";
    }

    if($newPassword != $confirmPassword) {
        echo "Your new passwords do not match.";
        exit();
    }

    if(preg_match('/[^A-Za-z0-9]/', $newPassword)) {
        echo " Your password must contain letters and numbers.";
        exit();
    }

    if(strlen($newPassword) > 30 || strlen($newPassword) < 5) {
        echo "Your username must be between 5 and 30 characters.";
        exit();
    }

    $newMd5 = md5($newPassword);
    $query = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");

    echo "Updated successfully.";
?>