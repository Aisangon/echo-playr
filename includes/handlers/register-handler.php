<?php

    function sanitizeFormUsername($formInput) {
        $formInput = strip_tags($formInput);
        $formInput = str_replace(" ", "", $formInput);
        return $formInput;
    }

    function sanitizeFormPassword($formInput) {
        $formInput = strip_tags($formInput);
        return $formInput;
    }

    function sanitizeFormString($formInput) {
        $formInput = strip_tags($formInput);
        $formInput = str_replace(" ", "", $formInput);
        $formInput = ucfirst(strtolower($formInput));
        return $formInput;
    }

    if (isset($_POST["submitSignUp"])) {
        // If resgister button was pressed
        $username = sanitizeFormUsername($_POST["userName"]);
        $firstName = sanitizeFormString($_POST["firstName"]);
        $lastName = sanitizeFormString($_POST["lastName"]);
        $email1 = sanitizeFormString($_POST["email1"]);
        $email2 = sanitizeFormString($_POST["email2"]);
        $password1 = sanitizeFormPassword($_POST["password1"]);
        $password2 = sanitizeFormPassword($_POST["password2"]);

        $wasSuccessful = $account->register($username, $firstName, $lastName, $email1, $email2, $password1, $password2);

        if($wasSuccessful) {
            $_SESSION['userLoggedIn'] = $username;
            header('Location: index.php');
        }
    }
?>