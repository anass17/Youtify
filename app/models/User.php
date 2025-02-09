<?php

    abstract class User {
        protected int $user_id;
        protected string $username;
        protected string $email;
        protected string $password;
        protected string $role;
        protected array $errors = [];


        public function __construct(int $user_id = 0, string $username = '', string $email = '', string $password = '', string $role = '') {
            $this -> user_id = $user_id;
            $this -> username = $username;
            $this -> email = $email;
            $this -> password = $password;
            $this -> role = $role;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setUsername(string $username) : void {
            $this -> username = $username;
        }

        public function setEmail(string $email) : void {
            $this -> email = $email;
        }

        public function setPassword(string $password) : void {
            $this -> password = $password;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getUserId() {
            return $this -> user_id;
        }

        public function getUsername() {
            return htmlspecialchars($this -> username);
        }

        public function getEmail() {
            return htmlspecialchars($this -> email);
        }

        public function getPassword() {
            return $this -> password;
        }

        public function getRole() {
            return $this -> role;
        }

        public function getErrors() {
            return $this -> errors;
        }

        // ------------------------------------
        // Static Methods
        // ------------------------------------

        public static function logout() : void {   

            Security::deleteAccessToken();

            session_destroy();
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function login() : bool {

            $db = Database::getInstance();

            if (!empty($this -> error)) {
                return false;
            }

            if (
                empty($this -> email) ||
                empty($this -> password)
            ) {
                $this -> errors[] = "Please fill in the form";
                return false;
            }

            // Check if the email exists

            $parameters = [
                $this -> email
            ];

            $result = $db -> select("SELECT * from users WHERE email = ?", $parameters);

            if (!$result) {
                $this -> errors[] = "Incorrect email address or password";
                return false;
            }

            // Verify Password

            if (!password_verify($this -> password, $result['password'])) {
                $this -> errors[] = "Incorrect email address or password";
                return false;
            }

            // Create access token

            $this -> user_id = $result['user_id'];

            if (!Security::createAccessToken($this -> user_id)) {
                return false;
            }

            return true;
        }

        public function isEmailExists() : bool|int {

            $db = Database::getInstance();

            $result = $db -> select("SELECT * from users WHERE email = ?", [$this -> email]);

            // If email exists, return user ID

            if ($result) {
                return $result['user_id'];
            }

            return false;
        }

}

