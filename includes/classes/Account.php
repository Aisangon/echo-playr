<?php
    class Account {

        private $errorArray;

        public function __construct() {
            $this->errorArray = array();
        }

        public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2) {
            $this->validateUserName($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em1, $em2);
            $this->validatePasswords($pw1, $pw2);

            if(empty($this->errorArray)) {
                // Insert into DB
                return true;
            } else {
                return false;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = '';
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function validateUserName($un) {
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;

                // TODO: check if username exists
            }
        }
    
        private function validateFirstName($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }
    
        private function validateLastName($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }
    
        private function validateEmails($em1, $em2) {
            if($em1 != $em2) {
                array_push($this->errorArray, Constants::$emailsDontMatch);
                return;
            }

            if(!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //TODO: check that username hasn't already been used
        }
    
        private function validatePasswords($pw1, $pw2) {
            if($pw1 != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw1)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if(strlen($pw1) > 30 || strlen($pw1) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }
    }
?>