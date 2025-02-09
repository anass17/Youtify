<?php

    class Artist extends User {

        private array $albums = [];
        private array $playlists = [];


        // ------------------------------------
        // Methods
        // ------------------------------------

        public function register() {

            $db = Database::getInstance();

            // Validate Data

            !Security::validateName($this -> username) ? ($this -> errors[] = "Username is too short") : '';
            !Security::validateEmail($this -> email) ? ($this -> errors[] = "Email Address is invalid") : '';
            !Security::validatePassword($this -> password) ? ($this -> errors[] = "Password must contain at least 8 characters") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // check if email already exists

            if ($this -> isEmailExists()) {
                $this -> errors[] = "This email already Exists";
                return false;
            }

            // If not, insert new row in users table

            $this -> role = 'artist';

            $columns = [
                'username',
                'email',
                'password',
                'role'
            ];

            $data = [
                $this -> username,
                $this -> email,
                password_hash($this -> password, PASSWORD_BCRYPT),
                $this -> role
            ];

            $insert_id = $db -> insert('users', $columns, $data);        // The id of inserted row, or False

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            // Create access token

            $this -> user_id = $insert_id;

            if (!Security::createAccessToken($this -> user_id)) {
                return false;
            }

            return true;
        }
    }