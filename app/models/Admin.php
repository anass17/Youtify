<?php

    class Admin extends User {

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function activateUser(int $user_id) : bool {
            return true;
            // $db = Database::getInstance();

            // if (!$db -> update('users', ['status'], 'user_id = ?', ['active', $user_id])) {
            //     $this -> errors[] = "Could not activate this user's account";
            //     return false;
            // }

            // return true;
        }

        public function banUser(int $user_id) : bool {
            return true;
            // $db = Database::getInstance();

            // if (!$db -> update('users', ['status'], 'user_id = ?', ['banned', $user_id])) {
            //     $this -> errors[] = "Could not ban this user's account";
            //     return false;
            // }

            // return true;
        }
        
    }