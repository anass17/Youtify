<?php

    class Security {

        private function __construct() {}

        // ------------------------------------
        // Token Management
        // ------------------------------------

        public static function createAccessToken(int $id) {

            $db = Database::getInstance();

            // Set the token and its expiration time 

            date_default_timezone_set('Etc/GMT-1');         // Set timezone to UTC + 1
            $token = bin2hex(random_bytes(32));
            $token_expiration = time() + 20 * 60;
            $token_expiration_formated = date('Y-m-d H:i:s', $token_expiration);

            // Columns and parameters

            $columns = [
                'token', 
                'token_expiration'
            ];

            $parameters = [
                $token,
                $token_expiration_formated, 
                $id
            ];

            // Store token in the database

            if (!$db -> update('users', $columns, 'user_id = ?', $parameters)) {
                return false;
            }

            // Store token in a cookie

            $cookie_value = $id . '.' . $token;            // In the format "ID.token"
            setcookie('token', $cookie_value, $token_expiration, '/', 'localhost', true, true);

            return true;

        }

        public static function isAccessTokenValid() {

            $db = Database::getInstance();

            if (!isset($_COOKIE['token'])) {
                return false;
            }

            // Return cookie parts

            $cookie_params = explode('.', $_COOKIE['token']);

            // A token cookie must contain two parts: User ID + token

            if (count($cookie_params) != 2) {
                return false;
            }

            // Check if the token is valid

            $parameters = [
                $cookie_params[0],
                $cookie_params[1]
            ];

            $result = $db -> select("SELECT * FROM users WHERE user_id = ? and token = ? and token_expiration > Current_timestamp", $parameters);

            if (!$result) {
                return false;
            }
            
            // Update Token

            self::createAccessToken((int) $cookie_params[0]);

            return $result;
        }

        public static function deleteAccessToken() : void {

            $db = Database::getInstance();

            // get user ID and Token

            if (!isset($_COOKIE['token'])) {
                return;
            }

            $cookie_params = explode('.', $_COOKIE['token']);

            if (count($cookie_params) != 2) {
                return;
            }

            // Remove token from database

            $columns = [
                'token',
                'token_expiration'
            ];

            $parameters = [
                '',
                null,
                $cookie_params[0],
                $cookie_params[1]
            ];

            if (!$db -> update('users', $columns, 'user_id = ? and token = ?', $parameters)) {
                return;
            }

            // Remove token cookie

            setcookie('token', '', time() - 0, '/', 'localhost', true, true);

        }

        public static function createCSRFToken() {
            if(!isset($_SESSION['CSRF_token'])){
                $csrf_token = bin2hex(random_bytes(32));
                $_SESSION['CSRF_token'] = $csrf_token;
            }
        }

        public static function isCSRFTokenValid(string $token) {
            if (isset($_SESSION['CSRF_token']) && trim($_SESSION["CSRF_token"]) == trim($token)) {
                return true;
            }

            return false;
        }

        public static function updateCSRFToken() {
            $csrf_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $csrf_token;
        }

        // ------------------------------------
        // Data Validation
        // ------------------------------------

        public static function validateName(string $name) : bool {
            if (strlen($name) < 2) {
                return false;
            }
            return true;
        }

        public static function validateEmail(string $email) : bool {
            if (preg_match('/^[a-z.A-Z-_0-9]{3,}@[a-zA-Z.]{2,}\.[a-zA-Z]{2,}$/', $email) == 0) {
                return false;
            }
            return true;
        }

        public static function validateId(string $id) : bool {
            if (preg_match('/^[1-9][0-9]*$/', $id) == 0) {
                return false;
            }
            return true;
        }

        public static function validateStatus(string $status) : bool {
            $available_status = ["active", "banned", "pending", "deleted"];
            if (!in_array($status, $available_status)) {
                return false;
            }
            return true;
        }

        public static function validatePassword(string $password) : bool {
            if (strlen($password) < 8) {
                return false;
            }
            return true;
        }

        public static function validateRole(string $role) : bool {
            $available_roles = ["student", "teacher"];
            if (!in_array($role, $available_roles)) {
                return false;
            }
            return true;
        }

        // ------------------------------------
        // authorised access
        // ------------------------------------

        public static function isAuthorized($role, $possible_roles) {
            if (!in_array($role, $possible_roles)) {
                return false;
            }
            
            return true;
        }

        // ------------------------------------
        // Log Errors
        // ------------------------------------

        public static function logError($error) : void {
            $file = fopen(__DIR__ . '/../logs/errors.txt', 'a');
            fwrite($file, "\n$error \n");
            fwrite($file, "-----------------------------------");
            fclose($file);
        }


    }

?>